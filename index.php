<?php

session_start();

include 'functions.php';
include 'db_link.php';
include 'winner.php';

//$sql = "SELECT lots.* FROM lots";
//$lots = getData($link, $sql);

//$lots= [];
//
//foreach ($lots_list as $key => $value) {
//    $lots[]
//}

$sql = "SELECT * FROM lots JOIN categories ON lots.category = categories.id WHERE dt_end >= CURRENT_DATE ";
$lots = getData($link, $sql);

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
$footer = includeTemplate('footer.php', ['categories' => $categories]);

echo $header, $main, $footer;
?>

</body>
</html>
