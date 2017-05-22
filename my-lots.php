<?php

session_start();

include 'functions.php';
include 'data/data.php';

if (!empty($_COOKIE['bets_info'])) {
    $bets_info = json_decode($_COOKIE['bets_info']);
}

$header = includeTemplate('header.php');
$main = includeTemplate('my-lots.php');
$footer = includeTemplate('footer.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мои ставки</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
echo $header, $main, $footer;
?>

</body>
</html>
