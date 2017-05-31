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
    <section class="rates container">

        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php foreach ($bets_info as $bets) :?>
                <?php $lot_id = $bets['lot_id'] ?>
            <tr class="rates__item">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="<?= $lots[$lot_id]['img'] ?>" width="54" height="40" alt="Сноуборд">
                    </div>
                    <h3 class="rates__title"><a href="lot.php?id=<?= $lot_id ?>"><?= $lots[$lot_id]['title'] ?></a></h3>
                </td>
                <td class="rates__category">
                    <?= $lots[$lot_id]['category'] ?>
                </td>
                <td class="rates__timer">
                    <div class="timer timer--finishing">07:13:34</div>
                </td>
                <td class="rates__price">
                    <?= $bets['bet'] ?><span> р.</span>
                </td>
                <td class="rates__time">
                    <?= betTime($bets['bet_time']) ?>
                </td>
            </tr>

            <?php endforeach; ?>
        </table>
    </section>
</main>