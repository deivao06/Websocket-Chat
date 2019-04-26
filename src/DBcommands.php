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
        $query = "INSERT INTO users (name,pass) VALUES (?,?)";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$name,$pass]);
    }

    public function update($name, $pass, $id){
        $query = "UPDATE users SET name = ?, pass = ? WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$name,$pass,$id]);
    }

    public function delete($id){
        $query = "DELETE FROM users WHERE id = ?";
        $prepare = $this->database->connection->prepare($query);

        return $prepare->execute([$id]);
    }
}