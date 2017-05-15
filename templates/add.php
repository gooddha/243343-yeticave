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
  <form class="form form--add-lot container" action="add.php" method="post"> <!-- form--invalid -->
    <h2>Добавление лота <br></h2>
     <?= var_dump ($_POST); ?> <br>
     <?= var_dump ($form); ?>
    <div class="form__container-two">
      <div class="form__item <?php if ($form['lot-name'] == 'error') { print "form__item--invalid"; } ?>">
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
          <?php if ($form['lot-name'] != 'error') { print("value=\"" . $form['lot-name'] . "\"" ); } ?>
        >
        <span class="form__error"><?php if ($form['lot-name'] == 'error') { print "Заполните наименование"; } ?></span>
      </div>
      <div class="form__item <?php if ($form['category'] == 'error') { print "form__item--invalid"; } ?>">
        <label for="category">Категория</label>
        <select id="category" name="category">
          <option <?php if (!$form['category'] || $form['category'] == 'error') { print "selected"; } ?>>Выберите категорию</option>
          <option <?php if ($form['category'] == 'Доски и лыжи') { print "selected"; } ?>>Доски и лыжи</option>
          <option <?php if ($form['category'] == 'Крепления') { print "selected"; } ?>>Крепления</option>
          <option <?php if ($form['category'] == 'Ботинки') { print "selected"; } ?>>Ботинки</option>
          <option <?php if ($form['category'] == 'Одежда') { print "selected"; } ?>>Одежда</option>
          <option <?php if ($form['category'] == 'Инструменты') { print "selected"; } ?>>Инструменты</option>
          <option <?php if ($form['category'] == 'Разное') { print "selected"; } ?>>Разное</option>
        </select>
        <span class="form__error"><?php if ($form['category'] == 'error') { print "Выберите категорию"; } ?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?php if ($form['message'] == 'error') { print "form__item--invalid"; } ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?php if ($form['message'] != 'error') { print $form['message'];} ?></textarea>
      <span class="form__error"><?php if ($form['message'] == 'error') { print "Заполните описание лота"; } ?></span>
    </div>
    <div class="form__item form__item--file  <?php if (($form['file']) && ($form['file'] !== 'error')) { print "form__item--uploaded"; } ?>"> <!-- form__item--uploaded -->
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
    <div class="form__container-three">
      <div class="form__item form__item--small <?php if ($form['lot-rate'] == 'error') { print "form__item--invalid"; } ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0"
            <?php if (isset($form['lot-rate'])) { print("value=\"" . $form['lot-rate'] . "\"" ); } ?>
        >
        <span class="form__error"><?php if ($form['lot-rate'] == 'error') { print "Укажите начальную цену"; } ?></span>
      </div>
      <div class="form__item form__item--small <?php if ($form['lot-step'] == 'error') { print "form__item--invalid"; } ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0"
            <?php if (isset($form['lot-step'])) { print("value=\"" . $form['lot-step'] . "\"" ); } ?>
        >
        <span class="form__error"><?php if ($form['lot-step'] == 'error') { print "Укажите шаг ставки"; } ?></span>
      </div>
      <div class="form__item <?php if ($form['lot-date'] == 'error') { print "form__item--invalid"; } ?>">
        <label for="lot-date">Дата завершения</label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017"
            <?php if ($form['lot-date'] !== 'error') { print("value=\"" . $form['lot-date'] . "\"" ); } ?>>
        <span class="form__error"><?php if ($form['lot-date'] == 'error') { print "Укажите дату"; } ?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
