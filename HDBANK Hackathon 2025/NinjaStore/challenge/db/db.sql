USE ninjashop;

CREATE TABLE users(uid int AUTO_INCREMENT PRIMARY KEY, username VARCHAR(32), password VARCHAR(32), fullname VARCHAR(255));
CREATE TABLE coins(id int AUTO_INCREMENT PRIMARY KEY, coin INT, uid INT, update_count INT);
CREATE TABLE ninja(id int AUTO_INCREMENT PRIMARY KEY, ninja_name VARCHAR(32), slug_name VARCHAR(32), price INT);

INSERT INTO ninja VALUES (1, "Uzumaki Naruto", "naruto", 10);
INSERT INTO ninja VALUES (2, "Uchiha Sasuke", "sasuke", 30);
INSERT INTO ninja VALUES (3, "Hatake Kakashi","kakashi", 70);
INSERT INTO ninja VALUES (4, "Flag - My Secret", "flag", 1337);
INSERT INTO ninja VALUES (5, "Uchiha Itachi","itachi", 90);