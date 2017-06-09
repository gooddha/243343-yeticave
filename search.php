<?php

session_start();

include_once 'functions.php';
include_once 'db_link.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : null;

$results = [];
$pages = 1;

if (count($results) > 9) {
    $pages = ceil(count($results) / 9);
}

if (!empty($search)) {

    $sql = 'SELECT id, title, img, price, dt_end FROM lots '
        . 'WHERE title LIKE ? '
        . 'OR description LIKE ?';
    $sql_data = ["%$search%", "%$search%"];
    $results = getData($link, $sql, $sql_data);
    if (!empty($results)) {
        $main = includeTemplate('search.php', ['categories' => $categories, 'search' => $search, 'results' => $results]);
    } else {
        $main = includeTemplate('zero-search.php', ['categories' => $categories, 'search' => $search, 'results' => $results]);
    }
} else {
    $main = includeTemplate('empty-search.php', [ 'categories' => $categories, 'search' => $search, 'results' => $results ]);
}


$header = includeTemplate('header.php');
$footer = includeTemplate('footer.php', ['categories' => $categories]);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
echo $header, $main, $footer;
?>

</body>
</html>
