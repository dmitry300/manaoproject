<?php

namespace app\models\repository;

use app\models\entity\User;

interface UserRepository
{
    function create(User $user);

    function findAll();

    function findUserByLogin($login);
}