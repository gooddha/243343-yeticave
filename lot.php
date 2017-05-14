<?php

include 'functions.php';
include 'lots.php';
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

if (isset($_GET)) {
    $lot_id = $_GET['id'];
}

if (array_key_exists($lot_id, $lots)) {
    $current_lot = $lots["$lot_id"];
    $main = includeTemplate('lot.php', [
        'current_lot' => $current_lot,
        'lots' => $lots,
        'bets' => $bets
    ]);
} else {
    header("HTTP/1.1 404 Not Found");
    $main = includeTemplate('404.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $current_lot['name'] ?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
$header = includeTemplate('header.php');

$footer = includeTemplate('footer.php');

echo $header, $main, $footer;
?>

</body>
</html>
