<?php

session_start();

include_once 'functions.php';
include_once 'db_link.php';

$lot_id = isset($_GET['id']) ? $_GET['id'] : null;
$current_lot = [];
$bet = [];

//Заполнение массива ставок
$sql = 'SELECT bets.*, users.name AS user_name, lots.price, lots.price_step FROM bets '
    . 'JOIN users ON bets.user = users.id '
    . 'JOIN lots ON bets.lot = lots.id '
    . 'WHERE lot = ' . $lot_id
    . ' ORDER BY dt_add DESC';

$bets = getData($link, $sql);
$max_bet = 0;

if (!empty($bets)) {
    $max_bet = array_search(max(array_column($bets, 'value')), (array_column($bets, 'value')));
    $min_price = $bets[$max_bet]['value'] + $bets[$max_bet]['price_step'];
} else {
    $sql = "SELECT price FROM lots WHERE id = {$lot_id}";
    $max_bet = getData($link, $sql);
    $min_price = $max_bet['0']['price'];
}

$current_bet = [];

if (!empty($_POST)) {
    $form =  addbetformValidation(postFilter($_POST), $min_price);

    if (empty($form['error']) && !empty($form['value'])) {

        $current_bet = [
            'value' => $form['value'],
            'user' => $_SESSION['user']['id'],
            'lot' => $lot_id
        ];
        $sql = "INSERT INTO bets (`value`, `user`, `lot`) VALUES (?, ?, ?)";
        putData($link, $sql, $current_bet);

        $price['price'] = $form['value'];
        $where['id'] = $lot_id;
        updateData($link, lots, $price, $where);

        header("Location: /my-lots.php");
    }
}

if ($bets_info) {
    $user_lots = array_column($bets_info, 'lot_id');
} else {
    $user_lots = [];
}

$lots_ids = array_column($lots, 'id');
$current_lot_id = array_search($lot_id, $lots_ids);

if ($lot_id !== null && isset($lots[$current_lot_id])) {
    $current_lot = $lots[$current_lot_id];
    $main = includeTemplate('lot.php', [
        'categories' => $categories,
        'current_lot' => $current_lot,
        'form' => $form,
        'bets' => $bets,
        'min_price' => $min_price,
        'lot_id' => $lot_id,
        'user_lots' => $user_lots
    ]);
} else {
    header("HTTP/1.1 404 Not Found");
    $main = includeTemplate('404.php', ['categories' => $categories]);
}

$header = includeTemplate('header.php');
$footer = includeTemplate('footer.php', ['categories' => $categories]);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= isset($current_lot["title"]) ? $current_lot["title"] : "404 - Page not found" ?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
echo $header, $main, $footer;
?>

</body>
</html>
