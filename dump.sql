create database if not exists wforge;

create table if not exists wforge.user (
  id int(6) unsigned auto_increment primary key,
  nickname varchar(30) unique not null,
  password_hash char(60) not null,
  registered timestamp default current_timestamp()
);
create index user_nickname on wforge.user (nickname);

create table if not exists wforge.user_detail (
  user_id int(6) unsigned primary key,
  name varchar(100),
  email varchar(50) not null,
  image longblob default null
);