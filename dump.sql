create database if not exists wforge;

create table if not exists wforge.user (
  id int(6) unsigned auto_increment primary key,
  nickmame varchar(30) not null,
  password_hash char(60) not null,
  registered timestamp default current_timestamp()
);

create table if not exists wforge.user_detail (
  user_id int(6) unsigned primary key,
  name varchar(100),
  email varchar(50) not null,
  image_content longblob default null,
  image_name varchar(50) default null,
  image_size varchar(50) default null,
  image_type varchar(50) default null
);