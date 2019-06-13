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

    /**
     * @return array
     */
    public function all(){
        $query = "SELECT * FROM user";
        $prepare = $this->db->connection->prepare($query);
        $prepare->execute();

        return $prepare->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function searchById($id){
        $query = "SELECT * FROM user WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $prepare->execute([$id]);

        return $prepare->fetch();
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

        return $execute;
    }

    /**
     * @param $id
     * @param $name
     * @param $pass
     * @param int $admin
     * @return bool
     */
    public function updateUser($id,$name,$pass,$admin = 0){
        $query = "UPDATE user SET name = ?, pass = ?, admin = ? WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$name,$pass,$admin,$id]);

        return $execute;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id){
        $query = "DELETE FROM user WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$id]);

        return $execute;
    }
}