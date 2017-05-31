<?php
session_start();

include_once 'functions.php';
include_once 'db_link.php';

if (!empty($_COOKIE['bets_info'])) {
    $bets_info = json_decode($_COOKIE['bets_info'], true);
}

if ($bets_info) {
    $user_lots = array_column($bets_info, 'lot_id');
} else {
    $user_lots = [];
}

if (!isset($_SESSION['user'])) {
    header("HTTP/1.0 403 Forbidden");
    $main = includeTemplate('403.php');

} else {
    $form = [];
    $current_lot = [];

    if (!empty($_POST)) {
        $form = addlotformValidation(postFilter($_POST));
    }

    $main = includeTemplate('add.php', ['categories' => $categories, 'form' => $form]);

    if (!empty($_FILES['file']['name'])) {
        $uploaddir = 'img/uploads/lots/';
        $uploadfile = $uploaddir . 'img-' . rand(10000, 99999) . '.jpg';
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        $current_lot['img'] = $uploadfile;
    } else {
        $current_lot['img'] = '';
    }

    if (!empty($form['values']) && empty($form['errors'])) {
        foreach ($form['values'] as $key => $value) {
            $current_lot[$key] = $form['values'][$key];
        }
        $current_lot['lot-date'] = date('Y.m.d', strtotime($current_lot['lot-date']));
        $current_lot ['id']= strval(findUser($_SESSION['user']['email'], $users)['id']+1);

        $sql = "INSERT INTO lots (`img`, `title`, `category`, `description`, `price`, `price_step`, `dt_end`, `seller`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        putData($link, $sql, $current_lot);

        $main = includeTemplate('lot.php', [
            'user_lots' => $user_lots,
            'categories' => $categories,
            'current_lot' => $current_lot,
            'bets' => $bets
        ]);
    }
}
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление лота</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php
$header = includeTemplate('header.php');

$footer = includeTemplate('footer.php', ['categories' => $categories]);

echo $header, $main, $footer;
?>

</body>
</html>
