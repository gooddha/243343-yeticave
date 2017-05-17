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

function postFilter($array) {
    foreach ($array as $key => $value) {
        $array[$key] =  strip_tags($value);
    }
    return $array;
}

function addFormValidation($input_array) {
    $result = [];

    if ($input_array['lot-name']) {
        if (strlen($input_array['lot-name']) > 0) {
            $result['values']['lot-name'] = $input_array['lot-name'];
        }
    } else {
        $result['errors']['lot-name'] = 'Заполните наименование';
    }

    if ($input_array['category']) {
        if ($input_array['category'] !== 'Выберите категорию') {
            $result['values']['category'] = $input_array['category'];
        } else {
            $result['errors']['category'] = 'Выберите категорию';
        }
    }

    if ($input_array['message']) {
        if (strlen($input_array['message']) > 0) {
            $result['values']['message'] = $input_array['message'];
        }
    } else {
        $result['errors']['message'] = 'Заполните описание лота';
    }

    if ($input_array['lot-rate']) {
        if (is_numeric($input_array['lot-rate'])) {
            $result['values']['lot-rate'] = $input_array['lot-rate'];
        } else {
            $result['values']['lot-rate'] = $input_array['lot-rate'];
            $result['errors']['lot-rate'] = 'Введите числовое значение';
          }
        } else {
            $result['errors']['lot-rate'] = 'Укажите начальную цену';
        }

    if ($input_array['lot-step']) {
        if (is_numeric($input_array['lot-step'])) {
            $result['values']['lot-step'] = $input_array['lot-step'];
        } else {
            $result['values']['lot-step'] = $input_array['lot-step'];
            $result['errors']['lot-step'] = 'Введите числовое значение';
        }
    } else {
        $result['errors']['lot-step'] = 'Укажите шаг ставки';
    }


    if ($input_array['lot-date']) {
        if (($timestamp = strtotime($input_array['lot-date'])) === false) {
            $result['errors']['lot-date'] = 'Введите корректное значение даты';
            $result['values']['lot-date'] = $input_array['lot-date'];
        } else {
            $result['values']['lot-date'] = date('d.m.Y', $timestamp);
        }
    } else {
        $result['errors']['lot-date'] = 'Укажите дату завершения';
        $result['values']['lot-date'] = $input_array['lot-date'];
    }

    return $result;
    }

?>
