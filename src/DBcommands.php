<?php
namespace MyApp;

use MyApp\Connection;

class DBcommands{
    private $database;

    public function __construct()
    {
        $this->database = new Connection;
    }

    public function selectAll(){
        $query = "SELECT * FROM users";
        $prepare = $this->database->connection->prepare($query);
        $execute = $prepare->execute();
        $fetchAll = $prepare->fetchAll();
        return $fetchAll;
    }

    public function insert($name, $pass){
        $query = "INSERT INTO users (name,pass,admin) VALUES (?,?,?)";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$name,$pass,0]);
    }

    public function update($name, $pass, $id){
        $query = "UPDATE users SET name = ?, pass = ? WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$name,$pass,$id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$id]);
    }

    public function verifyLogin()
    {
        if (empty($_COOKIE['loginHash'])) {
            return false;
        }

        if (empty($_SESSION['userId'])) {
            return false;
        }
        
        $user = $this->selectWhereId($_SESSION['userId']);

        if (!is_array($user)) {
            return false;
        }

        if ($user['loginHash'] != $_COOKIE['loginHash']) {
            return false;
        }

        return true;
    }

    public function login($name, $pass){
        $query = "SELECT * FROM users WHERE name = ? and pass = ?";
        $prepare = $this->database->connection->prepare($query);
        $execute = $prepare->execute([$name, $pass]);
        $fetchAll = $prepare->fetch();

        if(!empty($fetchAll)){
            $hash = bin2hex(random_bytes(16));
            $queryUpdate = "UPDATE users set loginHash = '$hash' WHERE name = '$name'";
            $prepareUpdate = $this->database->connection->prepare($queryUpdate);
            $prepareUpdate->execute();
            
            setcookie('loginHash', $hash, 0 ,"/");
            return $fetchAll;
        }else{
            return false;
        }
        
    }

    public function verifyRegister($name){
        $query = "SELECT * FROM users WHERE name = ?";
        $prepare = $this->database->connection->prepare($query);
        $execute = $prepare->execute([$name]);
        $fetch = $prepare->fetch();

        if(!empty($fetch)){
            return false;
        }else{
            return true;
        }
    }

    public function selectWhereId($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);
        $execute = $prepare->execute([$id]);
        $fetchAll = $prepare->fetch();

        return $fetchAll;
    }

    public function selectWhereUsername($name){
        $query = "SELECT * FROM users WHERE name = ?";
        $prepare = $this->database->connection->prepare($query);
        $execute = $prepare->execute([$name]);
        $fetchAll = $prepare->fetch();

        return $fetchAll;
    }

    public function updateUser($name, $pass, $admin = 0, $id){
        $query = "UPDATE users SET name = ?, pass = ?, admin = ? WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$name,$pass,$admin,$id]);
    }
}