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

  <form class="form container <?= !empty($form['errors']) ? "form--invalid" : '' ?>" action="login.php" method="post">
      <h3><?= $signup ? "Теперь вы можете войти, используя свой email и пароль:" : '' ?></h3>
    <div class="form__item <?= !empty($form['errors']['email']) ? "form__item--invalid" : '' ?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= ($form['values']['email'] ?? '' ) ?>" >
      <span class="form__error"><?= ($form['errors']['email'] ?? '') ?></span>
    </div>

    <div class="form__item form__item--last <?= !empty($form['errors']['password']) ? "form__item--invalid" : '' ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= ($form['values']['password'] ?? '' ) ?>" >
      <span class="form__error"><?= ($form['errors']['password'] ?? '') ?></span>
    </div>

    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Войти</button>

  </form>
</main>
