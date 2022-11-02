use kmactf;
drop table if EXISTS users;
create table users(id int PRIMARY key AUTO_INCREMENT, username varchar(255), password varchar(32), avatar varchar(255));


drop table if EXISTS shop;
create table shop(id int, name varchar(255), price int, url varchar(255));
insert into shop values(1, "Exodia" ,20000,"https://publish.one37pm.net/wp-content/uploads/2021/02/5-1.jpg?fit=600%2C875");
insert into shop values(2, "Dark Armed Dragon" ,30000,"https://publish.one37pm.net/wp-content/uploads/2021/02/3-1.jpg?fit=813%2C1185");
insert into shop values(3, "Obelisk" ,40000,"https://publish.one37pm.net/wp-content/uploads/2021/02/7.png?fit=549%2C800");
insert into shop values(4, "Slifer The Sky Dragon",50000,"https://publish.one37pm.net/wp-content/uploads/2021/02/8.jpg?fit=600%2C875");
insert into shop values(5, "Super Quantal Mech King Great Magnus" ,60000,"https://publish.one37pm.net/wp-content/uploads/2021/02/super-quantal.jpg?fit=800%2C1167");
insert into shop values(6, "The Winged Dragon Of Ra" ,70000,"https://publish.one37pm.net/wp-content/uploads/2021/02/10.jpg?fit=600%2C875");
insert into shop values(7, "Victory Dragon" ,80000,"https://publish.one37pm.net/wp-content/uploads/2021/02/victory-dragon.jpg?fit=1096%2C1600");
insert into shop values(8, "The Tyrant Neptune",9000,"https://publish.one37pm.net/wp-content/uploads/2021/02/9.jpg?fit=813%2C1185");