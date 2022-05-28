const bot             = require('../bot');
const path            = require('path');
const express         = require('express');
const router          = express.Router();

const response = data => ({ message: data });
const isAdmin = req => ((req.ip == '127.0.0.1') ? 1 : 0);
let db;

router.get('/', (req, res) => {
	return res.sendFile(path.resolve('views/index.html'));
});

router.get('/notes', (req, res) => {
	return res.sendFile(path.resolve('views/notes.html'));
});

router.get('/api/notes', (req, res) => {
	return db.listNotes(isAdmin(req))
		.then(notes => {
			res.json(notes);
		})
		.catch(() => res.send(response('Something went wrong!')));
});

router.post("/create", (req, res) => {
    const { note, author } = req.body;
    if (note.length !== 0 || author.length !== 0) {
        return db.createNote(note, author, 0)
                .then(() =>  res.send(response("Your note has been created")))
                .catch(() => res.send(response("Something went wrong when creating note")))
    }
})

router.get('/report', (req, res) => {
	return res.sendFile(path.resolve('views/report.html'));
})

router.post('/report', (req, res) => {
	const { url } = req.body;
	if (url) {
		uregex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/
		if (url.match(uregex)) {
			return bot.visitPage(url)
				.then(() => res.send(response('Your submission is now pending review!')))
				.catch(() => res.send(response('Something went wrong! Please try again!')))
		}
		return res.status(403).json(response('Please submit a valid URL!'));
	}
	return res.status(403).json(response('Missing required parameters!'));
});

router.get('/notes/search', (req, res) => {
	if(req.query.note) {
		const query = `${req.query.note}%`;
		return db.findNote(query, isAdmin(req))
			.then(notes => {
				if(notes.length == 0) return res.status(404).send(response('No  results!'));
				res.json(notes);
			})
			.catch(() => res.send(response('Something went wrong! Please try again!')));
	}
	return res.status(403).json(response('Missing "note" parameters!'));
});

module.exports = database => {
	db = database;
	return router;
};