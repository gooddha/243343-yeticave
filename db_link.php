<?php

$link = mysqli_connect("localhost", "root", "", "yeticave");

//if ($link == false) {
//    print("Ошибка подключения: ". mysqli_connect_error());
//} else {
//    print("Соединение установлено");
//}

//Заполнение массива категорий
$sql = "SELECT name FROM categories ORDER BY `id` ASC";

$data = getData($link, $sql);
$categories = [];
foreach ($data as $value) {
    $categories [] = $value['name'];
}

//Заполнение массива пользователей
$sql = "SELECT email, name, password FROM users";
$users = getData($link, $sql);

//Заполнение массива лотовname AS category  JOIN categories ON lots.category = categories.id
$sql = "SELECT lots.* FROM lots";
$lots = getData($link, $sql);


//Заполнение массива ставок
$sql = "SELECT bets.*, users.name AS user_name FROM bets JOIN users ON bets.user = users.id";
$bets = getData($link, $sql);

?>