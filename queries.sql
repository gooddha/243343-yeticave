-- получить список из всех категорий;
SELECT * from categories;

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории;
SELECT title, start_price, img, price, bits_count, category FROM lots WHERE dt_end > CURRENT_DATE ;

-- найти лот по его названию или описанию;
SELECT * FROM lots WHERE title LIKE "%?%" OR description LIKE "%?%" ;

-- добавить новый лот (все данные из формы добавления);
INSERT INTO lots (`title`, `category`, `description`, `img`, `start_price`, `price_step`, `dt_end`) VALUES (?, ?, ?, ?, ?, ?, ?, );

-- обновить название лота по его идентификатору;
UPDATE lots SET title=<title> WHERE id=<id>;

-- добавить новую ставку для лота;
INSERT INTO bets SET dt_add = CURRENT_DATE, value = <bet>, user = <user>, lot = <lot>;

-- получить список ставок для лота по его идентификатору.
SELECT * FROM bets WHERE lot = <id>;