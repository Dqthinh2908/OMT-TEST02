<?php

//class connection PDO MYSQL

namespace app\database;
use PDO;
use PDOException;

class Database
{
    protected $db;

    public function __construct(){
        $this->db = $this->connection();
    }

    protected function connection()
    {
        try {
            $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }
    public function disconnection()
    {
        $this->db = null;
    }
    public function __destruct(){
        $this->disconnection();
    }
}



