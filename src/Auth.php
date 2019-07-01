<?php
namespace MyApp;
use MyApp\UserCommands;

class Auth
{
    public $username;
    public $password;
    public $auth_token;

    public function Authorize()
    {
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            $auth = $_SERVER["HTTP_AUTHORIZATION"];
            $auth_array = explode(" ", $auth);
            $un_pw = explode(":", base64_decode($auth_array[1]));
            $this->usename = $un_pw[0];
            $this->password = $un_pw[1];

            $login = $this->Login($this->username, $this->password);
            if ($login){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function User()
    {
        $userCommands = new UserCommands;
        $login = $userCommands->searchByUsernameAndPassword($this->username, $this->password);
        return $login;
    }

    public function Login($username, $password)
    {
        $userCommands = new UserCommands;
        $login = $userCommands->searchByUsernameAndPassword($username, $password);

        if ($login){
            $this->username = $login['name'];
            $this->password = $login['pass'];

            $this->auth_token = base64_encode($this->username .":". $this->password);
            return $this->auth_token;
        }

        return false;
    }
}