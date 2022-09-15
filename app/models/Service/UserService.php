<?php

namespace app\models;

interface UserService
{
    function createUser(User $user);
    function findUserByLogin($login);
}