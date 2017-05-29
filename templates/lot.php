<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $value): ?>
                <li class="nav__item">
                    <a href="all-lots.html"><?= $value ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="lot-item container">
        <h2><?= $current_lot['title'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= $current_lot['img'] ?>" width="730" height="548" alt="Изображение лота">
                </div>
                <p class="lot-item__category">Категория: <span><?= $categories[$current_lot['category']-1] ?></span></p>
                <p class="lot-item__description">
                    <?= ($current_lot['message']) ?? "
                    Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    снег
                    мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                    снаряд
                    отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер
                    позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                    просто
                    посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.
                    " ?>
                </p>
            </div>
            <div class="lot-item__right">
                <?php if (isset($_SESSION['user'])): ?>
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        10:54:12
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?= $current_lot['price'] ?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span>12 000 р</span>
                        </div>
                    </div>
                    <?php if (!in_array($lot_id, $user_lots)): ?>
                    <form class="lot-item__form" action="lot.php?id=<?= $lot_id ?>" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost" placeholder="12 000">
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                    <?php endif ?>
                </div>
                <?php endif ?>
                <div class="history">

                    <h3>История ставок (<span><?= count($bets) ?></span>)</h3>
                    <!-- заполните эту таблицу данными из массива $bets-->
                    <table class="history__list">
                    <?php foreach ($bets as $bet): ?>
                        <tr class="history__item">
                            <td class="history__name"><?= $bet['user_name'] ?></td>
                            <td class="history__price"><?= $bet['value'] ?> р</td>
                            <td class="history__time"><?= betTime(strtotime($bet['dt_add'])) ?></td>
                        </tr>
                    <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>