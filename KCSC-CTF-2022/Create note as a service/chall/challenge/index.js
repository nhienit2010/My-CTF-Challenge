var express = require('express');
var app = express();
const Database = require('./database');
const cookieParser = require("cookie-parser");
const sessions = require('express-session');
const e = require('express');

const database = new Database('notes.db');
var flag = ""

app.use(express.static('public'));
app.use(express.urlencoded({ extended: true }));
app.use(sessions({
    secret: process.env.SECRET || "thisismysecrctekeyfhrgfgrfrty84fwir767",
    saveUninitialized:true,
    resave: false
}));
app.use(cookieParser());

app.get('/', function (req, res) {
   res.sendFile(__dirname + '/index.html');
})

app.get('/login', (req, res) => {
    res.sendFile(__dirname + "/public/login.html")
})

app.post('/login', async (req, res) => {
    let {username, password} = req.body;
    let stmt = await database.db.prepare("SELECT * FROM users WHERE username = ? and password = ?");
    let result = await stmt.all(username, password)

    if (result.length > 0 ) {
        req.session.userId = result[0].id
        res.redirect('/note')
    } else {
        res.json({"Error": "User not exists"})
    }

})

app.get('/note', async(req, res) => {
    res.sendFile(__dirname + '/public/note.html')
})

app.post('/note', async(req, res) => {
    let userId = req.session.userId;
    let note = req.body.note;

    try {
        let stmt = await database.db.prepare("INSERT INTO notes(note, userId) VALUES (? , ?)");
        let result = await stmt.all(note, userId)

        res.json({"Success": "Your note was created"})
    } catch(e) {
        res.json({"Error": "Something went wrong"})
    }
})

app.get('/view', async(req, res) => {
    let id = req.query.id;
    let userId = req.session.userId;
    let stmt = await database.db.prepare("SELECT * FROM notes WHERE userId = ? and id = ?");
    let result = await stmt.all(userId, id);

    if (result.length > 0)
        res.send(result[0].note)
    else
        res.json({"Error": "Not found"})
})

app.get('/view-all', async(req, res) => {
    let userId = req.session.userId;
    let stmt = await database.db.prepare("SELECT * FROM notes WHERE userId = ?");
    let result = await stmt.all(userId);
    res.json(result)
})

app.get('/register', (req, res) => {
    res.sendFile(__dirname + "/public/register.html")
})

app.post('/register', async (req, res) => {
    let {username, password} = req.body;
    let stmt = await database.db.prepare("SELECT * FROM users WHERE username = ?");
    let result = await stmt.all(username)

    if (result.length == 0 ) {
        let stmt = await database.db.prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        await stmt.all(username, password)
        res.json({"Success": "User was created"})
    } else {
        res.json({"Error": "User exists"})
    }
})

app.get("/flag", async (req, res) => {
    let user_flag = req.query.flag;
    let checkMatch = flag.match(user_flag);
    // res.send(checkMatch); I think it is not necessary
    res.send("Checked");
})

;(async () => {
    await database.connect();
    await database.init();

    let stmt = await database.db.prepare("SELECT flag FROM flag");
    let result = await stmt.all()
    flag = result[0].flag
        
    app.listen(80, '0.0.0.0', () => console.log('Listening on port 80'));
})()