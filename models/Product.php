<?php
class Product extends DB
{

    public $id;
    public $category_id;
    public $store_id;
    public $name;
    public $price;
    public $description;
    public $image;
    public $active;

    public function __construct($id = null, $category_id = null, $name = null, $price = null,$description = null, $image = null , $active = null)
    {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->active = $active;
        
        self::$getDB =  $this->connect();

    }
  
    
    public function selectAllData()
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT * FROM products");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['category_id'], $row['name'], $row['price'], $row['description'] , $row['image'] , $row['active']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function delete($id)
    {
        $result = self::$getDB->query("DELETE FROM products WHERE `id` = '$id'");
        if($result){
           if(mysqli_affected_rows(self::$getDB) > 0){
               return true;
           }
        }
        return false;
    }

    public function insert($name, $price, $category_id, $active,$image,$description = '')
    {
      
        $result = self::$getDB->query("INSERT INTO products (`id`,`category_id`, `name` , `price` , `description` , `image` , `active`) VALUES 
        (null , '$category_id'  , '$name' , '$price' , '$description', '$image' ,'$active')");
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

        $result =self::$getDB->query("SELECT * FROM products WHERE id = '$id'");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['category_id'], $row['name'], $row['price'], $row['description'] , $row['image'] , $row['active']));
                }
                return $list;
            }
            return $list;
        }
    }   
           
        
    public function update($id,$name, $price, $category_id, $active,$image,$description = '')
    {
        if(isset($image))
        $result = self::$getDB->query("UPDATE `products` SET `name` = '$name' , `price` = '$price' , `category_id` = '$category_id' , `image` = '$image' , `active` = '$active' , `description` = '$description' WHERE `id` = $id");
        else
        $result = self::$getDB->query("UPDATE `products` SET `name` = '$name' , `price` = '$price' , `category_id` = '$category_id' , `active` = '$active' , `description` = '$description' WHERE `id` = $id");

        if($result){
           if(mysqli_affected_rows(self::$getDB) >= 0){
               return true;
           }
        }
        return false;
    }
    public function count()
    {
        $count = 0;
        $result =User::$getDB->query("SELECT COUNT(*) as `count` FROM products");
        if($result){
            while ($row=mysqli_fetch_assoc($result)) {
                $count = $row['count'];  
            }   
            return $count; 
        }
        return $count;
    }
}

