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
    <section class="lot-item container" style=" margin-bottom: 25%;">
        <h1 style="line-height: 1.5em; font-size: 3em; text-align: center;">404 – Запрошенная страница не существует<br> : (</h1>
    </section>
</main>
