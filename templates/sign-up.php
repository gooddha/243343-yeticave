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
    <form class="form container <?= !empty($form['errors']) ? "form--invalid" : '' ?>" action="sign-up.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
        <h2>Регистрация нового аккаунта</h2
<!--Поле email -->
        <div class="form__item <?= !empty($form['errors']['email']) ? "form__item--invalid" : '' ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= ($form['values']['email'] ?? '' ) ?>" required>
            <span class="form__error"><?= ($form['errors']['email'] ?? '') ?></span>
        </div>

<!--Поле password -->
        <div class="form__item <?= !empty($form['errors']['password']) ? "form__item--invalid" : '' ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= ($form['values']['password'] ?? '' ) ?>" required>
            <span class="form__error"><?= ($form['errors']['password'] ?? '') ?></span>
        </div>

<!--Поле name -->
        <div class="form__item <?= !empty($form['errors']['name']) ? "form__item--invalid" : '' ?>">
            <label for="name">Имя*</label>
            <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= ($form['values']['name'] ?? '' ) ?>" required>
            <span class="form__error"><?= ($form['errors']['name'] ?? '') ?></span>
        </div>

<!--Поле message -->
        <div class="form__item <?= !empty($form['errors']['message']) ? "form__item--invalid" : '' ?>">
            <label for="message">Контактные данные*</label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required><?= ($form['values']['message'] ?? '') ?></textarea>
            <span class="form__error"><?= ($form['errors']['message'] ?? '') ?></span>
        </div>
        <div class="form__item <?= !empty($form['errors']['img']) ? "form__item--invalid" : '' ?> form__item--file form__item--last">
            <label>Изображение</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" name="file" type="file" id="photo2" value="">
                <label for="photo2">
                    <span>+ Добавить</span>
                </label>
                <span class="form__error"><?= ($form['errors']['img'] ?? '') ?></span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="login.php">Уже есть аккаунт</a>
    </form>
</main>