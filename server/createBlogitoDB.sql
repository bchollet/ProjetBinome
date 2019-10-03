CREATE TABLE IF NOT EXISTS users(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	username VARCHAR(45) NOT NULL,
	password VARCHAR(45) NOT NULL,
	email VARCHAR(100) NOT NULL,
	admin TINYINT(1) NOT NULL,
	pages_id INTEGER,
	FOREIGN KEY (pages_id) REFERENCES pages(id)
);
CREATE TABLE IF NOT EXISTS pages(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	color VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS publications(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	pictureSrc VARCHAR(150),
	pages_id INTEGER,
	FOREIGN KEY(pages_id) REFERENCES pages(id)
);
CREATE TABLE IF NOT EXISTS comments(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	comment LONGTEXT NOT NULL,
	users_id INTEGER NOT NULL,
	publications_id INTEGER NOT NULL,
	FOREIGN KEY(users_id) REFERENCES users(id),
	FOREIGN KEY(publications_id) REFERENCES publications(id)
);


-- Ajout des Administrateurs au moment de la création de la DB
INSERT INTO users (id, username, password, email, admin)
VALUES (null, 'Milos', 'Pa$$w0rd', 'milos.cerovic@cpnv.ch', 1); 

INSERT INTO users (id, username, password, email, admin)
VALUES (null, 'Bastian', 'Pa$$w0rd', 'bastian.chollet@cpnv.ch', 1);


