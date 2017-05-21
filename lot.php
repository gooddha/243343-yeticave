<?php
session_start();

include 'functions.php';
include 'data/data.php';

// ставки пользователей, которыми надо заполнить таблицу


$lot_id = isset($_GET['id']) ? $_GET['id'] : null;
$current_lot = [];


if ($lot_id !== null && isset($lots[$lot_id])) {
    $current_lot = $lots[$lot_id];
    $main = includeTemplate('lot.php', [
        'current_lot' => $current_lot,
        'lots' => $lots,
        'bets' => $bets
    ]);
} else {
    header("HTTP/1.1 404 Not Found");
    $main = includeTemplate('404.php');
}

//перенес подключение шаблонов страницы сюда, чтобы подключения шаблонов были в одном месте.
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
