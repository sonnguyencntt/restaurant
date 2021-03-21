<?php
class Permission extends DB
{

    public $id;
    public $value;
  

    

    public function __construct($id = null , $value  = null)
    {
        $this->id = $id;
        $this->value = $value;
    
        self::$getDB =  $this->connect();

    }

    public function selectAllData()
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT * FROM permission");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['value']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
}

