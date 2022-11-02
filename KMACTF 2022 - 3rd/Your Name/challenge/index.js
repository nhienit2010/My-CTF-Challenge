const express       = require('express');
const app           = express();
const path          = require('path');
const routes        = require('./routes');

app.use(express.json())
app.set('views', './views');
app.use(express.urlencoded({ extended: true }));
app.engine('html', require('ejs').renderFile);
app.set('view engine', 'ejs');
app.use(routes());
app.use(express.static('public'))
app.disable('etag');

app.all('*', (req, res) => {
    return res.status(404).send({
        message: '404 page not found'
    });
});

(async () => {
    app.listen(13337, '0.0.0.0', () => console.log('Listening on port 13337'));
})();