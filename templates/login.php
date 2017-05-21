<main>
  <nav class="nav">
    <ul class="nav__list container">
      <li class="nav__item">
        <a href="all-lots.html">Доски и лыжи</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Крепления</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Ботинки</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Одежда</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Инструменты</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Разное</a>
      </li>
    </ul>
  </nav>

  <form class="form container <?= !empty($form['errors']) ? "form--invalid" : '' ?>" action="login.php" method="post"> <!-- form--invalid -->


    <div class="form__item <?= !empty($form['errors']['email']) ? "form__item--invalid" : '' ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= ($form['values']['email'] ?? '' ) ?>">
      <span class="form__error"><?= ($form['errors']['email'] ?? '') ?></span>
    </div>

    <div class="form__item form__item--last <?= !empty($form['errors']['password']) ? "form__item--invalid" : '' ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?= ($form['values']['password'] ?? '' ) ?>">
      <span class="form__error"><?= ($form['errors']['password'] ?? '') ?></span>
    </div>

    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Войти</button>

  </form>
</main>
