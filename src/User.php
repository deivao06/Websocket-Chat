<?php
namespace MyApp;

use MyApp\Connection;

class User {

    private $id;
    private $name;
    private $pass;
    private $loginHash;
    private $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getLoginHash()
    {
        return $this->loginHash;
    }

    /**
     * @param mixed $loginHash
     */
    public function setLoginHash($loginHash)
    {
        $this->loginHash = $loginHash;
    }

    public function registerUser($name,$pass,$admin = 0){
        $query = "INSERT INTO user (name,pass,admin) values (?,?,?)";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$name,$pass,$admin]);

        return $execute;
    }

    public function alterUser($id,$name,$pass,$admin = 0){
        $query = "UPDATE user SET name = ?, pass = ?, admin = ? WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$name,$pass,$admin,$id]);

        return $execute;
    }

    public function deleteUser($id){
        $query = "DELETE FROM user WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$id]);

        return $execute;
    }

    public function selectWhereId($id){
        $query = "SELECT * FROM user WHERE id = ?";
        $prepare = $this->db->connection->prepare($query);
        $execute = $prepare->execute([$id]);
        $fetch = $prepare->fetch();

        if($execute){
            return $fetch;
        }else{
            return 'error';
        }
    }
}