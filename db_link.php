<?php

$link = mysqli_connect("localhost", "root", "", "yeticave");

//if ($link == false) {
//    print("Ошибка подключения: ". mysqli_connect_error());
//} else {
//    print("Соединение установлено");
//}
$sql = "SELECT id, name FROM categories ORDER BY `id` ASC";

$categories = getData($link, $sql);

