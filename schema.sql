CREATE DATABASE yeticave;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(255)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME,
  name char(255),
  description TEXT,
  img CHAR(255),
  price INT UNSIGNED,
  dt_end DATETIME,
  price_step INT UNSIGNED,
  bits_count INT UNSIGNED,
  seller INT UNSIGNED,
  winner INT UNSIGNED,
  category INT UNSIGNED
);

CREATE TABLE bits (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add DATETIME,
	value INT UNSIGNED,
	user INT UNSIGNED,
	lot INT UNSIGNED
);

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add DATETIME,
	email CHAR(255),
	name CHAR(255),
	password CHAR(64),
	avatar CHAR(255),
	contacts TEXT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX name ON lots(name);
CREATE INDEX description ON lots(desription);