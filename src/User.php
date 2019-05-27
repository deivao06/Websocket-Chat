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

    public function registerUser($name,$pass,$admin = 0){
        $query = "INSERT INTO user (name,pass,admin) values (?,?,?)";
        $prepare = $this->db->prepare($query);
        $execute = $this->db->execute($prepare);

        $fetch = $this->db->fetch($prepare);

    }
}