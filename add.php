<?php

include 'functions.php';






$form_inputs = [];

if (isset($_POST) {
    $form_inputs = addformValidation($_POST);


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
$main = includeTemplate('add.php');
$footer = includeTemplate('footer.php');

echo $header, $main, $footer;
?>

</body>
</html>
