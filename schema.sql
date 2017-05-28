CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(255) NOT NULL,
  UNIQUE INDEX (name)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  email CHAR(255) NOT NULL,
  name CHAR(255) NOT NULL,
  password CHAR(64) NOT NULL,
  avatar CHAR(255),
  contacts TEXT,
  UNIQUE INDEX (email)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title char(255) NOT NULL,
  description TEXT,
  img CHAR(255),
  price INT NOT NULL,
  price_step INT NOT NULL,
  dt_end DATETIME NOT NULL,
  bets_count INT,
  seller INT NOT NULL,
  winner INT,
  category INT NOT NULL,
  INDEX (title),
  INDEX (category),
  FOREIGN KEY (seller) REFERENCES users(id),
  FOREIGN KEY (winner) REFERENCES users(id),
  FOREIGN KEY (category) REFERENCES categories(id)
);

CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  value INT NOT NULL,
  user INT NOT NULL,
  lot INT NOT NULL,
  FOREIGN KEY (user) REFERENCES users(id),
  FOREIGN KEY (lot) REFERENCES lots(id)
);