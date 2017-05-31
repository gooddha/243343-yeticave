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
    <section class="lot-item container" style=" margin-bottom: 25%;">
        <h1 style="line-height: 1.5em; font-size: 3em; text-align: center;">По вашему запросу <?= $search ?> ничего не найдено.</h1>
    </section>
</main>