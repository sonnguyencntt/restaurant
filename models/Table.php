<?php
class Table extends DB
{

    public $id;
    public $id_table;
    public $table_name;
    public $active;
    public $store_id;
 
    public function __construct($id = null, $id_table = null, $table_name = null, $active = null,$store_id = null)
    {
        $this->id = $id;
        $this->id_table = $id_table;
        $this->table_name = $table_name;
        $this->active = $active;
        $this->store_id = $store_id;
       
        
        self::$getDB =  $this->connect();

    }
  
    
    public function selectAllData()
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT * FROM tables");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['id_table'],$row['table_name'], $row['active'], $row['store_id']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function delete($id)
    {
        $result = Table::$getDB->query("DELETE FROM tables WHERE `id_table` = '$id'");
        if($result){
           if(mysqli_affected_rows(Table::$getDB) > 0){
               return true;
           }
        }
        return false;
    }

    public function insert($name, $active, $datenow, $store_id)
    {
      
        $result = self::$getDB->query("INSERT INTO tables (`id`,`id_table`,`table_name`, `active` , `store_id`) VALUES 
        (null , '$datenow' , '$name' , '$active' , '$store_id' )");
        if($result){
           if(mysqli_affected_rows(self::$getDB) > 0){
               return true;
           }
        }
        return false;
    }

   
    public function edit($id)
    {
        $list = array();

        $result =self::$getDB->query("SELECT * FROM tables WHERE id_table = '$id'");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['id_table'], $row['table_name'], $row['active'],$row['store_id']));
                }
                return $list;
            }
            return $list;
        }
    }   
          
           
        
    public function update($id_table, $name, $active, $store_id)
    {
       
        $result = Table::$getDB->query("UPDATE `tables` SET `table_name` = '$name' , `active` = $active  , `store_id` = $store_id WHERE `tables`.`id_table` = '$id_table'");

        if($result){
           if(mysqli_affected_rows(Table::$getDB) >= 0){
               return true;
           }
        }
        return false;
    }
    public function count()
    {
        $count = 0;
        $result =User::$getDB->query("SELECT COUNT(*) as `count` FROM stores");
        if($result){
            while ($row=mysqli_fetch_assoc($result)) {
                $count = $row['count'];  
            }   
            return $count; 
        }
        return $count;
    }
}

