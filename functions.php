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
    $result = [];

    foreach ($array as $key => $value) {
        $result[$key] =  strip_tags($value);
    }
    return $result;
}

function addFormValidation($input_array) {
    $result = [];

    if (!empty($input_array['lot-name'])) {
        $result['values']['lot-name'] = $input_array['lot-name'];
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

    if (!empty($input_array['message'])) {
        $result['values']['message'] = $input_array['message'];
    } else {
        $result['errors']['message'] = 'Заполните описание лота';
    }

    if (!empty($input_array['lot-rate'])) {
        if (is_numeric($input_array['lot-rate'])) {
            $result['values']['lot-rate'] = $input_array['lot-rate'];
        } else {
            $result['values']['lot-rate'] = $input_array['lot-rate'];
            $result['errors']['lot-rate'] = 'Введите числовое значение';
        }
    } else {
            $result['errors']['lot-rate'] = 'Укажите начальную цену';
    }

    if (!empty($input_array['lot-step'])) {
        if (is_numeric($input_array['lot-step'])) {
            $result['values']['lot-step'] = $input_array['lot-step'];
        } else {
            $result['values']['lot-step'] = $input_array['lot-step'];
            $result['errors']['lot-step'] = 'Введите числовое значение';
        }
    } else {
        $result['errors']['lot-step'] = 'Укажите шаг ставки';
    }


    if (!empty($input_array['lot-date'])) {
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

function loginFormValidation($input_array, $users) {
    $result = [];
    $user_key = '';
    $result['values']['email'] = $input_array['email'];
    $result['values']['password'] = $input_array['password'];

    if (empty($input_array['email'])) {
        $result['errors']['email'] = 'Введите email';
    } else  {
        if (filter_var($input_array['email'], FILTER_VALIDATE_EMAIL)) {

            if ($user_key = findUser($input_array['email'], $users)) {

                if ($user = checkPassword($input_array['password'], $user_key, $users)) {
                    $_SESSION['user'] = $user;
                    header("Location: /index.php");

                } else {
                    $result['errors']['password'] = 'Неверный пароль';
                }
            } else {
                $result['errors']['email'] = 'Логин не существует';
            }

        } else {
            $result['values']['email'] = $input_array['email'];
            $result['errors']['email'] = 'Введите корректный email';
        }
    }

    if (empty($input_array['password'])) {
        $result['errors']['password'] = 'Введите пароль';
    }

    return $result;
}

function findUser($email, $users) {
    if(in_array($email, array_column($users, 'email'))) {
        $emails = array_column($users, 'email');
        $key = array_search($email, $emails);
        return $key;
    }
}

function checkPassword($password, $key, $users) {
    if (password_verify($password, $users[$key]['password'])) {
        return $users[$key];
    } else {
        return false;
    }
}

?>
