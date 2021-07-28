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
        if (!$conn->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $conn->error);
        }
        return DB::$getDB = $conn;
    }
}
