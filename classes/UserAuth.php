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
    private $guest = true;


    public function login($email, $password)
    {
        if ($user = $this->findUser($email)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $this->email = $user['email'];
                $this->name = $user['name'];
                $this->avatar = $user['avatar'];
                $this->guest = false;
                $result = true;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function about()
    {
        if (!$this->isGuest()) {
            return ($this->email, $this->name, $this->avatar);
        } else {
            return false;
        }
    }

    public function isGuest()
    {
        return $this->guest == true;
    }

    private function findUser($email)
    {
        $sql = "SELECT `email`, `name`, `avatar` FROM `users` WHERE `email` = {$email}";
        if ($user = $db->getData($sql)) {
            return $user;
        } else {
        return false;
        }
    }

}