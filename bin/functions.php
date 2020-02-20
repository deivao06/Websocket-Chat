<?php
use MyApp\UserCommands;

/**
 * @param $username
 * @return bool|mixed
 */
function verifyIfUsernameExists($username)
{
    $userCommands = new UserCommands;
    $verify = $userCommands->searchByUsername($username);

    return $verify;
}

/**
 * @param $username
 * @param $password
 * @return mixed
 */
function login($username, $password)
{
    $userCommands = new UserCommands;
    $login = $userCommands->searchByUsernameAndPassword($username, $password);

    return $login;
}