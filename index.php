<?php

include 'functions.php';
include 'lots.php';

//объявление массива со списком категорий
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
$header = includeTemplate('header.php');
$main = includeTemplate('main.php', [
    'lots' => $lots,
    'categories' => $categories
]);
$footer = includeTemplate('footer.php');

echo $header, $main, $footer;
?>

</body>
</html>
