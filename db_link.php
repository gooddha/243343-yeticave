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


//Заполнение массива лотов
$sql = "SELECT lots.* FROM lots";
$lots = getData($link, $sql);
