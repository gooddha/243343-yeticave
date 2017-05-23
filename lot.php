<?php

session_start();

include 'functions.php';
include 'data/data.php';

$lot_id = isset($_GET['id']) ? $_GET['id'] : null;
$current_lot = [];

if (!empty($_COOKIE['bets_info'])) {
    $bets_info = json_decode($_COOKIE['bets_info'], true);
}

if (!empty($_POST['cost']) && is_numeric($_POST['cost'])) {
    $bet = $_POST['cost'];
    $bet_time = time();
    $bets_info [] = ['bet' => $bet, 'bet_time' => $bet_time, 'lot_id' => $lot_id];

    setcookie("bets_info", json_encode($bets_info));
    header("Location: /my-lots.php");
}

if ($bets_info) {
    $user_lots = array_column($bets_info, 'lot_id');
} else {
    $user_lots = [];
}

if ($lot_id !== null && isset($lots[$lot_id])) {
    $current_lot = $lots[$lot_id];
    $main = includeTemplate('lot.php', [
        'current_lot' => $current_lot,
        'lots' => $lots,
        'bets' => $bets,
        'lot_id' => $lot_id,
        'user_lots' => $user_lots
    ]);
} else {
    header("HTTP/1.1 404 Not Found");
    $main = includeTemplate('404.php');
}

$header = includeTemplate('header.php');
$footer = includeTemplate('footer.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= isset($current_lot["lot-name"]) ? $current_lot["lot-name"] : "404 - Page not found" ?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
echo $header, $main, $footer;
?>

</body>
</html>
