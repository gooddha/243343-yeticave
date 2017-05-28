<?php

session_start();

include 'functions.php';
include 'db_link.php';

$form = [];

if (!empty($_POST)) {
    $form = loginformValidation($_POST, $users);
}

$main = includeTemplate('login.php', [
    'form' => $form,
    'users' => $users
]);

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
