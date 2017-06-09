<?php

include 'db_link.php';

$sql = "SELECT id, title FROM lots WHERE winner IS NULL AND dt_end <= CURRENT_DATE ";
$lots_without_winner = getData($link, $sql);


foreach ($lots_without_winner as $lot_without_winner) {
    $lot_bets = [];

    $sql = "SELECT value, user FROM bets WHERE lot = ?";
    $sql_data []= $lot_without_winner['id'];
    $lot_bets = getData($link, $sql, $sql_data);
    $max_bet = max($lot_bets);

    $winner['winner'] = $max_bet['user'];
    $where['id'] = $lot_without_winner['id'];
    updateData($link,  'lots', $winner, $where);


    $sql = "SELECT email, name FROM users WHERE id = ?";
    $user_info = getData($link, $sql, $winner);
    $message = "Уважаемый {$user_info['0']['name']}! Вы выиграли аукцион на сайте yeticave.com по лоту {$lot_without_winner['title']} за {$max_bet['value']}р. Поздравляем!";
    $email = $user_info['0']['email'];
    mail($email, 'Вы выиграли аукцион!', $message);
}
