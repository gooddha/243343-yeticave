<?php

session_start();

include 'functions.php';
include 'db_link.php';

$form = [];
$current_user = [];

if (!empty($_POST)) {
    $form = signupformValidation($_POST, $users);
}

$main = includeTemplate('sign-up.php', [
    'categories' => $categories,
    'form' => $form,
    'users' => $users
]);

if (!empty($_FILES['file']['name'])) {
    $uploaddir = 'img/';
    $uploadfile = $uploaddir . 'img-' . rand(10000, 99999) . '.jpg';
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    $current_user['img'] = $uploadfile;
} else {
    $current_user['img'] = '';
}


if (!empty($form['values']) && empty($form['errors'])) {
    $signup = true;
    $main = includeTemplate('login.php', [
        'categories' => $categories,
        'signup' => $signup
    ]);

    $form['values']['password'] = password_hash($form['values']['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (`email`, `password`, `name`, `contacts`) VALUES (?, ?, ?, ?)";
    putData($link, $sql, $form['values']);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php

$header = includeTemplate('header.php');
$footer = includeTemplate('footer.php', ['categories' => $categories]);

echo $header, $main, $footer;

?>

</body>
</html>
