<?php
namespace MyApp;
use MyApp\UserCommands;

class Auth
{
    public $user;
    public $password;

    public function Authorize()
    {
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            $auth = $_SERVER["HTTP_AUTHORIZATION"];
            $auth_array = explode(" ", $auth);
            $un_pw = explode(":", base64_decode($auth_array[1]));
            $this->user = $un_pw[0];
            $this->password = $un_pw[1];

            $login = $this->Login($this->user, $this->password);
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
        $user = [
            "username" => $this->user,
            "password" => $this->password
        ];
        return $user;
    }

    private function Login($username, $password)
    {
        $userCommands = new UserCommands;
        $login = $userCommands->searchByUsernameAndPassword($username, $password);

        return $login;
    }
}