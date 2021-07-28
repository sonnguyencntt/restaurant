<?php
class Category extends DB
{

    public $id;
    public $name;
    public $active;
    public $id_category;
  

    public function __construct($id = null,$id_category=null, $name = null, $active=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->active = $active;
        $this->id_category = $id_category;

        
        
        self::$getDB =  $this->connect();

    }
  
    
    public function selectAllData()
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT * FROM category");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['id_category'],$row['name'],$row['active']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function delete($id)
    {
        $result = Category::$getDB->query("DELETE FROM category WHERE `id_category` = '$id'");
        if($result){
           if(mysqli_affected_rows(Category::$getDB) > 0){
               return true;
           }
        }
        return false;
    }


    public function insert($name,$active,$datenow)
    {
      
        $result = Category::$getDB->query("INSERT INTO category (`id`,`id_category`,`name`, `active`) VALUES 
        (null , '$datenow' , '$name' , $active)");
        if($result){
           if(mysqli_affected_rows(Category::$getDB) > 0){
               return true;
           }
        }
        return false;
    }

   
    public function edit($id)
    {
        $list = array();

        $result =self::$getDB->query("SELECT * FROM category WHERE id_category = '$id'");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['id_category'], $row['name'], $row['active']));
                }
                return $list;
            }
            return $list;
        }
    }   
           
        
    public function update($id_category , $name , $active)
    {
        $result = Category::$getDB->query("UPDATE `category` SET `name` = '$name' , `active` = $active WHERE `category`.`id_category` = '$id_category'");
        if($result){
           if(mysqli_affected_rows(Category::$getDB) >= 0){
               return true;
           }
        }
        return false;
    }
    public function count()
    {
        $count = 0;
        $result =User::$getDB->query("SELECT COUNT(*) as `count` FROM category");
        if($result){
            while ($row=mysqli_fetch_assoc($result)) {
                $count = $row['count'];  
            }   
            return $count; 
        }
        return $count;
    }
}

