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

    
}