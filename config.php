<?php
class DB
{  
    static $getDB;
    public function connect()
    {
      
        $conn = new mysqli(HOST,USER,PASS,DB);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return DB::$getDB = $conn;
    }
}
