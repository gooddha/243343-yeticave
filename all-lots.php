<?php

session_start();

include_once 'functions.php';
include_once 'db_link.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;

$results = [];

if (!empty($category)) {

    $sql = 'SELECT lots.id, title, img, price, dt_end, categories.name FROM lots JOIN categories ON lots.category = categories.id WHERE category = ' . $category;

    $results = getData($link, $sql);

    if (!empty($results)) {
        $main = includeTemplate('all-lots.php', ['categories' => $categories, 'category' => $category, 'results' => $results]);
    } else {
        $main = includeTemplate('empty-category.php', ['categories' => $categories, 'category' => $category, 'results' => $results]);
    }
} else {
    $main = includeTemplate('404.php', [ 'categories' => $categories ]);
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
