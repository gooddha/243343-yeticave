<?php

session_start();

include 'functions.php';
include 'data/data.php';

if (!empty($_COOKIE['bets_info'])) {
    $bets_info = json_decode($_COOKIE['bets_info'], true);
}
//else {
//    $bets_info = [];
//}

$header = includeTemplate('header.php');

if ($bets_info) {
    $main = includeTemplate('my-lots.php', ['bets_info' => $bets_info, 'lots' => $lots]);
} else {
    $main = includeTemplate('404.php');
}
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
