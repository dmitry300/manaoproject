<?php

namespace app\models;

interface UserRepository
{
    function create(User $user);

    function findAll();

    function findUserByLogin($login);
}