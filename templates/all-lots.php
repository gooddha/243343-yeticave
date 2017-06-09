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
    <div class="container">
        <section class="lots">
            <h2>Все лоты в категории <span>«<?= $results['0']['name'] ?>»</span></h2>
            <ul class="lots__list">
                <?php foreach ($results as $result): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?= $result['img'] ?>" width="350" height="260" alt="Изображение лота">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category">Доски и лыжи</span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $result['id'] ?>"><?= $result['title'] ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?= $result['price'] ?><b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                16:54:12
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </section>
        <?php if ($pages > 1): ?>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
        <?php endif ?>
    </div>
</main>