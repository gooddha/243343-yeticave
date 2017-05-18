<?php

include 'functions.php';
include 'data/data.php';

$form = [];
$current_lot = [];

if (!empty($_POST)) {
    $form = addformValidation(postFilter($_POST));
}

if (!empty($_FILES['file']['name'])) {
    $uploaddir = 'img/';
    $uploadfile = $uploaddir . basename('img-' . rand(10000, 99999) . '.jpg');
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    $current_lot['img'] = $uploadfile;
}

$main = includeTemplate('add.php', ['form' => $form]);

if (!empty($form['values']) && empty($form['errors'])) {
    foreach ($form['values'] as $key => $value) {
        $current_lot[$key] = $form['values'][$key];
    }
    $main = includeTemplate('lot.php', [
        'current_lot' => $current_lot,
        'bets' => $bets
]);
}

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