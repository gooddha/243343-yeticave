<?php

include 'functions.php';
include 'data/data.php';

$form = [];
$current_lot = [];


if (!empty($_POST)) {
    // foreach ($_POST as $key => $value) {
    //     $_POST[$key] = strip_tags($value);
    // }
    $form = addformValidation($_POST);
}

$main = includeTemplate('add.php', ['form' => $form]);

if (!empty($form['values']) && empty($form['errors'])) {
    foreach ($form['values'] as $key => $value) {
        $current_lot[$key] = $form['values'][$key];
    }
    $main = includeTemplate('lot.php', [
        'current_lot' => $current_lot,
        'bets' => $bets,
        '_FILES' => $_FILES
]);
}

//проверка массива на валидность и замена шаблона на lot.php
// $main = includeTemplate('lot.php', ['current_lot' => $form]);

// $form_valid = true;
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление лота</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php
$header = includeTemplate('header.php');

$footer = includeTemplate('footer.php');

echo $header, $main, $footer;
?>

</body>
</html>
