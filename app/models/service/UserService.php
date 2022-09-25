<?php

namespace app\models\service;

use app\models\entity\User;

interface UserService
{
    function createUser(User $user);
    function findUserByLogin($login);
}