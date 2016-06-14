create database region;
use region;
-- 省
create table provinces (
   id int not null primary key,
   name varchar(20) not null
);
-- 市
create table cities (
   id int not null primary key,
   name varchar(20) not null,
   provinceID int not null,
   foreign key(provinceID) references provinces(id) ON DELETE CASCADE ON UPDATE NO ACTION
);
-- 县
create table countries (
   id int not null primary key,
   name varchar(30) not null,-- 最长的11个字
   cityID int not null,
   foreign key(cityID) references Cities(id) ON DELETE CASCADE ON UPDATE NO ACTION
);