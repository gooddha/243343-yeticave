<?php

function includeTemplate($template, $template_data = []) {
    $template = "templates/" . $template;
    $result='';

    if (!file_exists($template)) {
        return $result;
    }

    ob_start();

    if ($template_data) {
        array_walk_recursive($template_data, function (&$value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value);
            }
        });
    }

    extract($template_data);
    require_once $template;
    $result = ob_get_clean();

    return $result;
}


function lotTimeRemaining() {
  // устанавливаем часовой пояс в Московское время
  date_default_timezone_set('Europe/Moscow');

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

function addFormValidation($input_array) {
    $result = [];
    $result['lot-name'] = strlen($input_array['lot-name']) > 0 ? $input_array['lot-name'] : false;
    $result['category'] = $input_array['category'] ?? false;
    $result['message'] = $input_array['message'] ?? false;
    $result['lot-date'] = $input_array['lot-date'] ?? false;

    if (isset($input_array['lot-rate'])) {
        if (is_numeric($input_array['lot-rate'])) {
            $result['price'] = $input_array['lot-rate'];
        } else {
            $result['price'] = 'not_num';
          }
        } else {
            $result['price'] = false;
        }

    if (isset($input_array['lot-step'])) {
        if (is_numeric($input_array['lot-step'])) {
            $result['lot-step'] = $input_array['lot-step'];
        } else {
            $result['lot-step'] = 'not_num';
        }
    } else {
        $result['lot-step'] = false;
    }





    return $result;
    }

?>
