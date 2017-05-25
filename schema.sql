CREATE DATABASE yeticave;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(255)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME,
  email CHAR(255),
  name CHAR(255),
  password CHAR(64),
  avatar CHAR(255),
  contacts TEXT,
  UNIQUE INDEX (email)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME,
  title char(255),
  description TEXT,
  img CHAR(255),
  start_price INT UNSIGNED,
  current_price INT UNSIGNED,
  price_step INT UNSIGNED,
  dt_end DATETIME,
  bits_count INT UNSIGNED,
  seller INT,
  winner INT,
  category INT,
  INDEX (title),
  INDEX (category),
  FOREIGN KEY (seller) REFERENCES users(id),
  FOREIGN KEY (winner) REFERENCES users(id),
  FOREIGN KEY (category) REFERENCES categories(id)
);

CREATE TABLE bits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME,
  value INT UNSIGNED,
  user INT,
  lot INT,
  FOREIGN KEY (user) REFERENCES users(id),
  FOREIGN KEY (lot) REFERENCES lots(id)
);