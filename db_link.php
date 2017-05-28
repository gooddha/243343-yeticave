<?php

$link = mysqli_connect("localhost", "root", "", "yeticave");

//if ($link == false) {
//    print("Ошибка подключения: ". mysqli_connect_error());
//} else {
//    print("Соединение установлено");
//}

//Заполнение массива категорий
$sql = "SELECT name FROM categories";

$data = getData($link, $sql);
$categories = [];
foreach ($data as $value) {
    $categories [] = $value['name'];
}

//Заполнение массива пользователей
$sql = "SELECT email, name, password FROM users";
$users = getData($link, $sql);

//Заполнение массива лотов
$sql = "SELECT *, name AS category FROM lots JOIN categories ON lots.category = categories.id";
$lots = getData($link, $sql);


//Заполнение массива ставок
$sql = "SELECT *, name AS user FROM bets JOIN users ON bets.user = users.id";
$bets = getData($link, $sql);

?>