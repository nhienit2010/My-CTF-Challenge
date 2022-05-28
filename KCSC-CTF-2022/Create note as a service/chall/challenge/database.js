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

            DROP TABLE IF EXISTS users;
            CREATE TABLE IF NOT EXISTS users (
                id          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                username    VARCHAR(255) NOT NULL,
                password    VARCHAR(255) NOT NULL
            );

            DROP TABLE IF EXISTS notes;
            CREATE TABLE IF NOT EXISTS notes (
                id          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                note        VARCHAR(255) NOT NULL,
                userId      INTEGER NOT NULL
            );

            DROP TABLE IF EXISTS flag;
            CREATE TABLE IF NOT EXISTS flag (
                flag    VARCHAR(255) NOT NULL
            );

            INSERT INTO flag (flag) VALUES ('${process.env.FLAG || "KCSC{flag_for_testing}"}');
        `);
    }

}

module.exports = Database;