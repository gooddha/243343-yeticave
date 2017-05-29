<?php

include 'mysql_helper.php';

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
          return (floor($time_elapsed/60) . " мин. назад");
        } else {
          // прошло больше часа
          return (floor($time_elapsed/3600) . " час. назад");
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

function addformValidation($input_array) {
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
        $result['values']['lot-date'] = $input_array['lot-date'];
        if (($timestamp = strtotime($input_array['lot-date'])) === false) {
            $result['errors']['lot-date'] = 'Введите корректное значение даты';
        } else {
            if ($timestamp-date(d.m.Y, time()) >= 86400) {
                $result['values']['lot-date'] = date('d.m.Y', $timestamp);
            } else {
                $result['errors']['lot-date'] = 'Дата завершения должны быть больше текущей';
            }
        }
    } else {
        $result['errors']['lot-date'] = 'Укажите дату завершения';
    }

    if (!empty($_FILES['file']['name'])) {
        $mime_types = [
            'png' => 'image/png',
            'jpg' => 'image/jpg',
            'jpeg' => 'image/jpeg'
        ];
        $uploaded_file_type = mime_content_type($_FILES['file']['tmp_name']);
        if (!in_array($uploaded_file_type, $mime_types)) {
            $result['errors']['img'] = 'Тип загруженного файла не jpg, jpeg или png';
        }
    }

    return $result;
}

function loginformValidation($input_array, $users) {
    $result = [];
    $result['values']['email'] = $input_array['email'];
    $result['values']['password'] = $input_array['password'];

    if (empty($input_array['email'])) {
        $result['errors']['email'] = 'Введите email';
    } else  {
        if (filter_var($input_array['email'], FILTER_VALIDATE_EMAIL)) {

            if ($user = findUser($input_array['email'], $users)) {

                if (password_verify($input_array['password'], $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: /index.php");

                } else {
                    $result['errors']['password'] = 'Неверный пароль';
                }
            } else {
                $result['errors']['email'] = 'Логин не существует';
            }

        } else {
            $result['errors']['email'] = 'Введите корректный email';
        }
    }

    if (empty($input_array['password'])) {
        $result['errors']['password'] = 'Введите пароль';
    }

    return $result;
}

function signupformValidation($input_array, $users) {
    $result = [];
    $result['values']['email'] = $input_array['email'];
    $result['values']['password'] = $input_array['password'];
    $result['values']['name'] = $input_array['name'];
    $result['values']['img'] = $input_array['img'];
    $result['values']['message'] = $input_array['message'];

    if (empty($input_array['email'])) {
        $result['errors']['email'] = 'Введите email';
    } else  {
        if (filter_var($input_array['email'], FILTER_VALIDATE_EMAIL)) {

            if ($user = findUser($input_array['email'], $users)) {
                $result['errors']['email'] = 'Логин уже зарегистрирован';
            }
        } else {
            $result['errors']['email'] = 'Введите корректный email';
        }
    }

    if (empty($input_array['password'])) {
        $result['errors']['password'] = 'Введите пароль';
    }

    if (empty($input_array['name'])) {
        $result['errors']['name'] = 'Введите имя';
    }

    if (empty($input_array['message'])) {
        $result['errors']['message'] = 'Введите контактные данные';
    }

    if (!empty($_FILES['file']['name'])) {
    $mime_types = [
        'png' => 'image/png',
        'jpg' => 'image/jpg',
        'jpeg' => 'image/jpeg'
    ];
        $uploaded_file_type = mime_content_type($_FILES['file']['tmp_name']);
        if (!in_array($uploaded_file_type, $mime_types)) {
            $result['errors']['img'] = 'Тип загруженного файла не jpg, jpeg или png';
        }
    }


    return $result;
}

function findUser($email, $users) {
    $emails = array_column($users, 'email');
    if(in_array($email, $emails)) {
        $key = array_search($email, $emails);
        $users [$key]['id'] = $key;
        return $users[$key];
    } else {
        return null;
    }
}

function getData($link, $sql, $sql_data = []) {

    $result = [];

    $stmt = db_get_prepare_stmt($link, $sql, $sql_data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (empty($res)) {
        return [];
    } else {
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $result [] = $row;
        }
        return $result;
    }
}

function putData($link, $sql, $sql_data = []) {

    $stmt = db_get_prepare_stmt($link, $sql, $sql_data);
    mysqli_stmt_execute($stmt);

    $result = mysqli_insert_id($link);

    if (!$result) {
        return false;
    } else {
        return $result;
    }
}

function updateData($link, $table, $sql_data = [], $where = []) {

    $placeholders = [];


    foreach ($sql_data as $key => $value) {
        $placeholders []= "`{$key}` = ?";
    }

    $placeholders = implode(', ', $placeholders);
    $key_where = key($where);
    $sql = "UPDATE `{$table}` SET " . $placeholders . " WHERE {$key_where} = ?";
    $data = array_merge($sql_data, $where);
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_affected_rows($link);

    if (!$result) {
        return false;
    } else {
        return $result;
    }
}

?>
