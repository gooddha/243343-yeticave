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

  <form class="form form--add-lot container <?= !empty($form['errors']) ? "form--invalid" : '' ?> " action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота <br></h2>

<!--Наименование-->
    <div class="form__container-two">
      <div class="form__item <?= !empty($form['errors']['lot-name']) ? "form__item--invalid" : '' ?>">
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?= ($form['values']['lot-name'] ?? '' ) ?>" required>
        <span class="form__error"><?= ($form['errors']['lot-name'] ?? '') ?></span>
      </div>

<!--Категория-->
      <div class="form__item <?= !empty($form['errors']['category']) ? "form__item--invalid" : '' ?>">
        <label for="category">Категория</label>
        <select id="category" name="category">
          <option <?= empty($form['values']['category']) ? "selected" : '' ?>>Выберите категорию</option>
          <option <?= $form['values']['category'] == 'Доски и лыжи' ? "selected" : '' ?>>Доски и лыжи</option>
          <option <?= $form['values']['category'] == 'Крепления' ? "selected" : '' ?>>Крепления</option>
          <option <?= $form['values']['category'] == 'Ботинки' ? "selected" : '' ?>>Ботинки</option>
          <option <?= $form['values']['category'] == 'Одежда' ? "selected" : '' ?>>Одежда</option>
          <option <?= $form['values']['category'] == 'Инструменты' ? "selected" : '' ?>>Инструменты</option>
          <option <?= $form['values']['category'] == 'Разное' ? "selected" : '' ?>>Разное</option>
        </select>
        <span class="form__error"><?= ($form['errors']['category'] ?? '') ?></span>
      </div>
    </div>

<!--Описание-->
    <div class="form__item form__item--wide <?= !empty($form['errors']['message']) ? "form__item--invalid" : '' ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?= ($form['values']['message'] ?? '') ?></textarea>
      <span class="form__error"><?= ($form['errors']['message'] ?? '') ?></span>
    </div>

<!--Изображение-->
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name="file" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>

<!--Начальная цена -->
    <div class="form__container-three">
      <div class="form__item form__item--small <?= !empty($form['errors']['lot-rate']) ? "form__item--invalid" : '' ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?= ($form['values']['lot-rate'] ?? '' ) ?>" required>
        <span class="form__error"><?= ($form['errors']['lot-rate'] ?? '') ?></span>
      </div>

<!--Шаг ставки -->
      <div class="form__item form__item--small <?= !empty($form['errors']['lot-step']) ? "form__item--invalid" : '' ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= ($form['values']['lot-step'] ?? '') ?>" required>
        <span class="form__error"><?= ($form['errors']['lot-step'] ?? '') ?></span>
      </div>

<!--Дата -->
      <div class="form__item <?= !empty($form['errors']['lot-date']) ? "form__item--invalid" : '' ?>">
        <label for="lot-date">Дата завершения</label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?= ($form['values']['lot-date'] ?? '') ?>" required>
        <span class="form__error"><?= ($form['errors']['lot-date'] ?? '') ?></span>
      </div>
    </div>

    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
