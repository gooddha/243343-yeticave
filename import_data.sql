USE yeticave;
-- Заполнение категорий
INSERT INTO categories SET `name` = 'Доски и лыжи';
INSERT INTO categories SET `name` = 'Крепления';
INSERT INTO categories SET `name` = 'Ботинки';
INSERT INTO categories SET `name` = 'Одежда';
INSERT INTO categories SET `name` = 'Инструменты';
INSERT INTO categories SET `name` = 'Разное';

-- Заполнение пользователей
INSERT INTO users SET
  `email` = 'ignat.v@gmail.com',
  `name` = 'Игнат',
  `password` = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';

INSERT INTO users SET
  `email` = 'kitty_93@li.ru',
  `name` = 'Леночка',
  `password` = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa';

INSERT INTO users SET
  `email` = 'warrior07@mail.ru',
  `name` = 'Руслан',
  `password` = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';


-- Заполнение лотов
INSERT INTO lots SET
  `title` = '2014 Rossignol District Snowboard',
  `category` = '1',
  `price` = '10999',
  `price_step` = '500',
  `dt_end` = '2017-06-11',
  `img` = 'img/lot-1.jpg',
  `seller` = '1';

INSERT INTO lots SET
  `title` = 'DC Ply Mens 2016/2017 Snowboard',
  `category` = '1',
  `price` = '159999',
  `price_step` = '150',
  `dt_end` = '2017-06-21',
  `img` = 'img/lot-2.jpg',
  `seller` = '2';

INSERT INTO lots SET
  `title` = 'Крепления Union Contact Pro 2015 года размер L/XL',
  `category` = '2',
  `price` = '8000',
  `price_step` = '200',
  `dt_end` = '2017-07-01',
  `img` = 'img/lot-3.jpg',
  `seller` = '3';

INSERT INTO lots SET
  `title` = 'Ботинки для сноуборда DC Mutiny Charocal',
  `category` = '3',
  `price` = '10999',
  `price_step` = '250',
  `dt_end` = '2017-07-03',
  `img` = 'img/lot-4.jpg',
  `seller` = '1';

INSERT INTO lots SET
  `title` = 'Куртка для сноуборда DC Mutiny Charocal',
  `category` = '4',
  `price` = '7500',
  `price_step` = '250',
  `dt_end` = '2017-08-01',
  `img` = 'img/lot-5.jpg',
  `seller` = '2';

INSERT INTO lots SET
  `title` = 'Маска Oakley Canopy',
  `category` = '6',
  `price` = '5400',
  `price_step` = '50',
  `dt_end` = '2017-06-09',
  `img` = 'img/lot-6.jpg',
  `seller` = '3';


INSERT INTO bets SET
  `dt_add` = '2017-05-24',
  `value` = '11500',
  `user` = '1',
  `lot` = '1';

INSERT INTO bets SET
  `dt_add` = '2017-05-23',
  `value` = '11000',
  `user` = '2',
  `lot` = '1';

INSERT INTO bets SET
  `dt_add` = '2017-05-22',
  `value` = '10500',
  `user` = '3',
  `lot` = '1';

INSERT INTO bets SET
  `dt_add` = '2017-05-21',
  `value` = '10000',
  `user` = '3',
  `lot` = '1';