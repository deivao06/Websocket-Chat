<?php


namespace MyApp;
use MyApp\Connection;

class UserCommands
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    public function all(){
        $query = "SELECT * FROM user";
        $prepare = $this->db->connection->prepare($query);
        $prepare->execute();

        return $prepare->fetchAll();
    }
    /**
     * @param $username
     * @return mixed
     */
    public function searchByUsername($username){
        $query = "SELECT * FROM user WHERE name = ?";
        $prepare = $this->db->connection->prepare($query);

        $prepare->execute([$username]);
        $result = $prepare->fetch();

        return $result;
    }

    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function searchByUsernameAndPassword($username, $password){
        $query = "SELECT * FROM user WHERE name = ? AND pass = ?";
        $prepare = $this->db->connection->prepare($query);

        $prepare->execute([$username, $password]);
        $result = $prepare->fetch();

        return $result;
    }

    /**
     * @param $name
     * @param $pass
     * @param int $admin
     * @return bool
     */
    public function registerUser($name,$pass,$admin = 0){
        $query = "INSERT INTO user (name,pass,admin) values (?,?,?)";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$name,$pass,$admin]);

        if ($execute){
            return true;
        }else{
            return false;
        }
    }
}