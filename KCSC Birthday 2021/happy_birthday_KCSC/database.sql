create database if not exists kcsc;
use kcsc;
create table users(id int auto_increment, username varchar(20) not null, password varchar(256), primary key (id));
insert into users values (1, 'admin', 'admin_password_for_testing');