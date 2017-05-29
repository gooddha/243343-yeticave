<?php

/**
 * Created by PhpStorm.
 * User: Rezerv
 * Date: 29.05.2017
 * Time: 22:21
 */
class UserAuth
{
    private $email;
    private $name;
    private $avatar;


    public function login($email, $password)
    {
        $sql = "SELECT email, name, password FROM users";
        $users = getData($sql);

        if ($user = $this->findUser($email, $users)) {

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;             

            } else {
                $result['errors']['password'] = 'Неверный пароль';
            }
        } else {
            $result['errors']['email'] = 'Логин не существует';
        }

    }

    public function isGuest()
    {
        return $this->email = false;
    }

    private function findUser($email, $users)
    {
        $emails = array_column($users, 'email');
        if(in_array($email, $emails)) {
            $key = array_search($email, $emails);
            $users [$key]['id'] = $key;
            return $users[$key];
        } else {
        return null;
    }
}

}