<?php

session_start();

include_once 'functions.php';
include_once 'db_link.php';

//if (!empty($_COOKIE['bets_info'])) {
//    $bets_info = json_decode($_COOKIE['bets_info'], true);
//}
$sql = "SELECT bets.dt_add, value, lot FROM bets "
    . "JOIN lots ON bets.lot = lots.id "
    . "WHERE user = " . $_SESSION['user']['id'];
$bets_info = getData($link, $sql);

$header = includeTemplate('header.php');

if (isset($bets_info) && isset($_SESSION['user'])) {
    $main = includeTemplate('my-lots.php', ['categories' => $categories, 'bets_info' => $bets_info, 'lots' => $lots]);
} else {
    $main = includeTemplate('404.php', ['categories' => $categories]);
}
$footer = includeTemplate('footer.php', ['categories' => $categories]);

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
