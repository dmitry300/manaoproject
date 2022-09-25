<?php

namespace app\models\service;

use app\models\entity\User;
use app\models\repository\UserRepositoryImpl;

class UserServiceImpl  implements UserService
{

    public function createUser(User $user)
    {
        $psw = $this->generateSaltHash($user->getPassword());
        $user->setPassword($psw['hashSaltPassword']);
        $user->setSalt($psw['salt']);
        (new UserRepositoryImpl())->create($user);
    }

    public function validateRegister($login, $password, $confirm_password, $email, $name): ?string
    {
        $input = [$email, $name, $password, $confirm_password, $login];
        foreach ($input as $val) {
            if (!isset($val)) {
                return 'One or more fields is empty!';
            }
        }
        if (!strlen($password) >= 6 || !strlen($login) >= 6
            || !preg_match('/^[а-яёa-z]{2}+$/i', $name)
            || !preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $email)
            || !preg_match('/(?=.*[0-9])(?=.*[a-zа-яё])/i', $password)) {
            return 'One or more fields are not valid!';
        }
        if (!$this->isPasswordEquals($password, $confirm_password)) {
            return 'Passwords mismatch!';
        }
        if (!$this->checkLoginExists($login)) {
            return 'This login already exists!';
        }
        if (!$this->checkEmailExists($email)) {
            return 'This email already exists!';
        }
        return null;
    }

    public function validateLogin($login, $password): ?string
    {
        if ($this->checkLoginExists($login)) {
            return 'This login not exists!';
        }
        if ($this->checkPasswordUser($password, $login)) {
            return 'Not correct password!';
        }
        return null;
    }

    private function isPasswordEquals($password, $confirm_password): bool
    {
        return $password == $confirm_password;
    }

    private function checkPasswordUser($password, $login): bool
    {
        $userArr = $this->findUserByLogin($login);
        if (strcasecmp($userArr['password'], $this->generateSaltHash($password, $userArr['salt'])['hashSaltPassword']) == 0) return false;
        return true;
    }

    private function checkEmailExists($email): bool
    {
        $data = (new UserRepositoryImpl())->findAll();
        foreach ($data as $item) {
            if (strcasecmp($item['email'], $email) == 0) return false;
        }
        return true;
    }

    private function checkLoginExists($login): bool
    {
        $data = (new UserRepositoryImpl())->findAll();
        foreach ($data as $item) {
            if (strcasecmp($item['login'], $login) == 0) return false;
        }
        return true;
    }

   private function generateSaltHash($password, $salt = null): array
    {
        define('SALT_LENGTH', 9);
        if ($salt === null) {
            $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);

        } else {
            $salt = substr($salt, 0, SALT_LENGTH);
        }
        $psw = [
            'salt' => $salt,
            'hashSaltPassword' => $salt . sha1($salt . $password)
        ];
        return $psw;
    }

    public function findUserByLogin($login)
    {
        return (new UserRepositoryImpl())->findUserByLogin($login);
    }

}