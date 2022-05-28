const sqlite = require('sqlite-async');

class Database {
    constructor(db_file) {
        this.db_file = db_file;
        this.db = undefined;
    }
    
    async connect() {
        this.db = await sqlite.open(this.db_file);
    }

    async init() {
        return this.db.exec(`
            PRAGMA case_sensitive_like=ON; 

            DROP TABLE IF EXISTS notes;

            CREATE TABLE IF NOT EXISTS notes (
                id          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                note        VARCHAR(255) NOT NULL,
                author       VARCHAR(255) NOT NULL,
                is_admin    BOOLEAN NOT NULL
            );

            INSERT INTO notes (id, note, author, is_admin) VALUES (0, "KCSC{W0W_H4v3_U_h3ard_4b0ut_XS_L34k?}", "nhienit", 1);
        `);
    }

    async listNotes(is_admin=0) {
        return new Promise(async (resolve, reject) => {
            try {
                let stmt = await this.db.prepare("SELECT * FROM notes WHERE is_admin = ?");
                resolve(await stmt.all(is_admin));
            } catch(e) {
                console.log(e);
                reject(e);
            }
        });
    }

    async findNote(query, is_admin=0) {
        return new Promise(async (resolve, reject) => {
            try {
                let stmt = await this.db.prepare("SELECT * FROM notes WHERE note like ? AND is_admin = ?");
                resolve(await stmt.all(query, is_admin));
            } catch(e) {
                console.log(e);
                reject(e);
            }
        });
    }

    async createNote(note, author, is_admin=0) {
        return new Promise(async (resolve, reject) => {
            try {
                let stmt = await this.db.prepare("INSERT INTO notes(note, author, is_admin) VALUES (?, ?, ?)");
                resolve(await stmt.all(note, author, is_admin));
            } catch(e) {
                console.log(e);
                reject(e);
            }
        });
    }
}

module.exports = Database;