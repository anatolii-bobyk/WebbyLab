CREATE TABLE users
(
    id       int auto_increment not null primary key,
    username     varchar(255)       not null,
    password     varchar(255)       not null
);

CREATE TABLE movies
(
    id           int auto_increment not null primary key,
    title        varchar(255) not null,
    release_year int          not null,
    format       varchar(255) not null,
    stars        varchar(255) not null
);


