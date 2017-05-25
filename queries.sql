-- получить список из всех категорий;
SELECT * from categories;

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории;
SELECT title, start_price, img, price, bits_count, category FROM lots WHERE dt_add = CURRENT_DATE ;

-- найти лот по его названию или описанию;
SELECT * FROM lots WHERE title LIKE "%?%" OR description LIKE "%?%" ;

-- добавить новый лот (все данные из формы добавления);
INSERT INTO lots (`title`, `category`, `description`, `img`, `start_price`, `price_step`, `dt_end`) VALUES (?, ?, ?, ?, ?, ?, ?, );


-- обновить название лота по его идентификатору;
UPDATE title FROM lots

-- добавить новую ставку для лота;


-- получить список ставок для лота по его идентификатору.
