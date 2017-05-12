<?php

include 'functions.php';

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = time();

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
//вычисление значений времени
$seconds_remaining = $tomorrow - $now;
$hours_remaining = floor($seconds_remaining / 3600);
$minutes_remaining = ceil(($seconds_remaining % 3600) / 60);

//добавление нулей для недостающих разрядов часов и минут
$hours_remaining = str_pad($hours_remaining, 2, "0", STR_PAD_LEFT);
$minutes_remaining = str_pad($minutes_remaining, 2, "0", STR_PAD_LEFT);

$lot_time_remaining =  $hours_remaining . ":" . $minutes_remaining;

//объявление массива со списком категорий
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

//объявление массива со списком лотов
$lots = [
    ['name' => '2014 Rossignol District Snowboard',
     'category' => 'Доски и лыжи',
     'price' => 10999,
     'img' => 'img/lot-1.jpg'
    ],

    ['name' => 'DC Ply Mens 2016/2017 Snowboard',
     'category' => 'Доски и лыжи',
     'price' => 159999,
     'img' => 'img/lot-2.jpg'
    ],

    ['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
     'category' => 'Крепления',
     'price' => 8000,
     'img' => 'img/lot-3.jpg'
    ],

    ['name' => 'Ботинки для сноуборда DC Mutiny Charocal',
     'category' => 'Ботинки',
     'price' => 10999,
     'img' => 'img/lot-4.jpg'
    ],

    ['name' => 'Куртка для сноуборда DC Mutiny Charocal',
     'category' => 'Одежда',
     'price' => 7500,
     'img' => 'img/lot-5.jpg'
    ],

    ['name' => 'Маска Oakley Canopy',
     'category' => 'Разное',
     'price' => 5400,
     'img' => 'img/lot-6.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
$header = include_template('header.php', []);
$main = include_template('main.php', ['lots' => $lots, 'categories' => $categories, 'lot_time_remaining' => $lot_time_remaining]);
$footer = include_template('footer.php', []);

echo $header, $main, $footer;
?>

</body>
</html>
