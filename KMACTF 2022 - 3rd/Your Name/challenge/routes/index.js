const bot             = require('../bot');
const path            = require('path');
const express         = require('express');
const router          = express.Router();

const response = data => ({ message: data });
const isAdmin = req => ((req.ip == '127.0.0.1') ? 1 : 0);

router.get('/', (req, res) => {
	let name = req.query.name;

	if (!name) {
		name = ""
	}
	
	if (name.match(/<(script|svg|iframe)/i)) {
		name = "Don't hack"
	}

	return res.render('index.html', {name: name});
});

router.get('/report', (req, res) => {
	res.render('report.html');
})

router.post('/report', (req, res) => {
	const { url } = req.body;
	if (url) {
		uregex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/
		if (url.match(uregex)) {
			return bot.visitPage(url)
				.then(() => res.send(response('Your submission is now pending review!')))
				.catch((e) => res.send(response('Something went wrong! Please try again!')))
				// .catch((e) => res.send(response(e)))

		}
		return res.status(403).json(response('Please submit a valid URL!'));
	}
	return res.status(403).json(response('Missing required parameters!'));
});


module.exports = database => {
	return router;
};