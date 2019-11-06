create table pages
(
  id    INTEGER     not null
    primary key
  autoincrement,
  color VARCHAR(45) not null
);

create table publications
(
  id         INTEGER not null
    primary key
  autoincrement,
  pictureSrc VARCHAR(300),
  thumbSrc   VARCHAR(300),
  pages_id   INTEGER
    references pages

);

create table users
(
  id                INTEGER      not null
    primary key
                               autoincrement,
  username          VARCHAR(45)  not null,
  password          VARCHAR(255) not null,
  email             VARCHAR(100) not null,
  admin             TINYINT(1)   not null,
  pages_id          INTEGER
    references pages,
  verification_code VARCHAR(32),
  user_verified     TINYINT(1) default 0
);

create table comments
(
  id              INTEGER  not null
    primary key
  autoincrement,
  comment         LONGTEXT not null,
  users_id        INTEGER  not null
    references users,
  publications_id INTEGER  not null
    references publications
);