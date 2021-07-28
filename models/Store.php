<?php
class Store extends DB
{
    public $id;
    public $id_store;
    public $name;
    public $active;

    public function __construct($primarykey=null, $id = null, $name = null, $active = null)
    {
        $this->id = $primarykey;
        $this->id_store = $id;
        $this->name = $name;
        $this->active = $active;
        
        Store::$getDB =  $this->connect();

    }
  
    
    public function selectAllData()
    {
        
        $list = array();
        $result =Store::$getDB->query("SELECT * FROM stores");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new Store($row['id'],$row["id_store"],$row['name'],$row['active']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }

    public function insert($name,$active,$datenow)
    {
      
        $result = Store::$getDB->query("INSERT INTO stores (`id`,`id_store`,`name`, `active`) VALUES 
        (null , '$datenow' , '$name' , $active)");
        if($result){
           if(mysqli_affected_rows(Store::$getDB) > 0){
               return true;
           }
        }
        return false;
    }

    public function edit($id)
    {
        $list = array();

        $result =Store::$getDB->query("SELECT * FROM stores WHERE id_store = '$id'");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new Store($row['id'],$row["id_store"],$row['name'],$row['active']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function delete($id)
    {
        $result = Store::$getDB->query("DELETE FROM stores WHERE `id_store` = '$id'");
        if($result){
           if(mysqli_affected_rows(Store::$getDB) > 0){
               return true;
           }
        }
        return false;
    }
    public function update($id_store , $name , $active)
    {
        $result = Store::$getDB->query("UPDATE `stores` SET `name` = '$name' , `active` = $active WHERE `stores`.`id_store` = '$id_store'");
        if($result){
           if(mysqli_affected_rows(Store::$getDB) >= 0){
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

