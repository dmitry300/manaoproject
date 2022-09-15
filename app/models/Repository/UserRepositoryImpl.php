<?php

namespace app\models\repository;

use app\models\entity\User;

class UserRepositoryImpl implements UserRepository
{
    private $file = 'app/lib/data.json';

    public function create(User $user)
    {
        $data = json_decode(file_get_contents($this->file), TRUE);
        $data[] = array('login' => $user->getLogin(), 'password' => $user->getPassword(),
            'email' => $user->getEmail(), 'name' => $user->getName(), 'salt' => $user->getSalt());
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function findAll()
    {
        return json_decode(file_get_contents($this->file), TRUE);
    }

    public function findUserByLogin($login)
    {
        $data = json_decode(file_get_contents($this->file), TRUE);
        foreach ($data as $item) {
            if (strcasecmp($item['login'], $login) == 0) return $item;
        }
        return null;
    }

}