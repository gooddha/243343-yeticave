<?php

session_start();

include 'functions.php';
include 'data/data.php';

$link = mysqli_connect("localhost", "root", "", "yeticave");

if ($link == false) {
    print("Ошибка подключения: ". mysqli_connect_error());
} else {
    print("Соединение установлено");
}


//$categories =

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
