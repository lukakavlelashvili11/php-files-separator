<?php

class User{

    private $table = 'users';

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * from' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}