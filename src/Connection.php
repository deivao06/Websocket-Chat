<?php
namespace MyApp;

class Connection {
    public $connection;

    public function __construct()
    {
        try{     
            $this->connection = new \PDO('sqlite:../../storage/chat.db');
        }catch (\PDOException $e){
             echo $e->getMessage();
        }
    }
};