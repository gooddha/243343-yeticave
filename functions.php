<?php
function includeTemplate($template, $template_data) {
    $template = "templates/" . $template;
    $result='';

    if (!file_exists($template)) {
        return $result;
    }

    ob_start();
    // $lots = $template_data['lots'];
    // $categories = $template_data['categories'];
    // $lot_time_remaining = $template_data['lot_time_remaining'];
    extract($template_data);

    // if ($lots) {
    //     foreach ($lots as &$lot) {
    //         foreach ($lot as $key => &$value) {
    //             $value = htmlspecialchars($value);
    //
    //             }
    //         }
    //   }

    if ($template_data) {
        foreach ($template_data as &$child) {

            if (is_array($child)) {
                foreach ($child as $key => &$value) {
                    if (is_string($value)) {
                        $value = htmlspecialchars($value);
                    }
                }
            }
        }
    }

    require_once $template;
    $result = ob_get_clean();

    return $result;
}


function lotTimeRemaining() {
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

  return $lot_time_remaining;
}

function betTime($bet_time) {
    $time_elapsed = time()-$bet_time;
    if ($time_elapsed > 86400) {
        //прошло больше 24 часов
        return (date("d.m.y в H:i", $bet_time));
    } else {
        //прошло меньше 24 часов
        if ($time_elapsed < 3600) {
          //прошло меньше часа
          return ($time_elapsed/60 . " мин. назад");
        } else {
          // прошло больше часа
          return ($time_elapsed/3600 . " час. назад");
        }
    }
}
?>
