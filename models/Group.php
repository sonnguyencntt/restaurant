<?php
class Group extends DB
{

    public $id;
    public $group_name;
    public $permission;
  

    

    public function __construct($id = null, $group_name = null, $permission  = null)
    {
        $this->id = $id;
        $this->group_name = $group_name;
        $this->permission = $permission;       
        self::$getDB =  $this->connect();

    }

    public function count()
    {
        $count = 0;
        $result =self::$getDB->query("SELECT COUNT(*) as `count` FROM self::$table_name");
        if($result){
            while ($row=mysqli_fetch_assoc($result)) {
                $count = $row['count'];  
            }   
            return $count; 
        }
        return $count;
    }
    public function selectAllData()
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT * FROM groups");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['group_name'],$row['permission']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function edit($id)
    {
        $list = array();

        $result =self::$getDB->query("SELECT * FROM groups WHERE id = '$id'");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['group_name'],$row['permission']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }

    public function insert($name,$permission)
    {
      
        $result = self::$getDB->query("INSERT INTO groups (`id`,`group_name`,`permission`) VALUES 
        (null , '$name' , '$permission')");
        if($result){
           if(mysqli_affected_rows(self::$getDB) > 0){
               return true;
           }
        }
        return false;
    }
    public function update($name , $permission , $id_group)
    {
        $result = self::$getDB->query("UPDATE `groups` SET `group_name` = '$name' , `permission` = '$permission' WHERE `groups`.`id` = $id_group");
        if($result){
           if(mysqli_affected_rows(self::$getDB) >= 0){
               return true;
           }
        }
        return false;
    }
    public function delete($id)
    {
        $result = self::$getDB->query("DELETE FROM groups WHERE `id` = $id");
        if($result){
           if(mysqli_affected_rows(self::$getDB) > 0){
               return true;
           }
        }
        return false;
    }
}

