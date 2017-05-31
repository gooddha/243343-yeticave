<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
                <li class="nav__item">
                    <a href="all-lots.php?category=<?= $category['id'] ?>"><?= $category['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="rates container">

        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php foreach ($bets_info as $bets) :?>
            <tr class="rates__item">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="<?= $bets['img'] ?>" width="54" height="40" alt="Сноуборд">
                    </div>
                    <h3 class="rates__title"><a href="lot.php?id=<?= $bets['lot'] ?>"><?= $bets['title'] ?></a></h3>
                </td>
                <td class="rates__category">
                    <?= $bets['category'] ?>
                </td>
                <td class="rates__timer">
                    <div class="timer timer--finishing">17:40:59<!--?= lotTimeRemaining($bets['dt_end']) ?--></div>
                </td>
                <td class="rates__price">
                    <?= $bets['value'] ?><span> р.</span>
                </td>
                <td class="rates__time">
                    <?= betTime(strtotime($bets['dt_add'])) ?>
                </td>
            </tr>

            <?php endforeach; ?>
        </table>
    </section>
</main>