DROP DATABASE IF EXISTS cake3enkai;
CREATE DATABASE cake3enkai DEFAULT CHARACTER SET utf8;

USE cake3enkai;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id int(11) not null AUTO_INCREMENT,
    email varchar(255) not null,
    password varchar(255) not null,
    created datetime default null,
    modified datetime default null,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
);

DROP TABLE IF EXISTS events;
CREATE TABLE events (
    id int(11) not null AUTO_INCREMENT,
    name varchar(255) not null,
    detail varchar(255) not null,
    max_participant int(11) not null,
    category_id int(11) not null,
    user_id int(11) not null,
    created datetime default null,
    modified datetime default null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS event_users;
CREATE TABLE event_users (
    id int(11) not null AUTO_INCREMENT,
    event_id int(11) not null,
    user_id int(11) not null,
    created datetime default null,
    modified datetime default null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id int(11) not null AUTO_INCREMENT,
    name varchar(255) not null,
    created datetime default null,
    modified datetime default null,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS chats;
CREATE TABLE chats (
    id int(11) not null AUTO_INCREMENT,
    user_id int(11) not null,
    event_id int(11) not null,
    body varchar(255) not null,
    created datetime default null,
    modified datetime default null,
    PRIMARY KEY (id)
);