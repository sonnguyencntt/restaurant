<?php
class Order extends DB
{

    public $id;
    public $date_time;
    public $total;
    // public $vat_charge_value;
    // public $address;
    // public $phone;
    // public $country;
    // public $message;
    // public $currency;

    public function __construct($id = null , $date_time = null , $total = null , $id_store = null , $name_store = null, $active_store = null )
    {
        
        $this->id = $id;
        $this->$date_time = $date_time;
        $this->$total = $total;
        // $this->company_name = $company_name;
        // $this->service_charge_value = $service_charge_value;
        // $this->vat_charge_value = $vat_charge_value;
        // $this->address = $address;
        // $this->phone = $phone;
        // $this->country = $country;
        // $this->message = $message;
        // $this->currency = $currency;
        MyFunction::loadModule("models.Product");
        $this->store = new Product($id_store, $name_store, $active_store);


        Order::$getDB =  $this->connect();
    }

    public function count()
    {
        $count = 0;
        $result =Order::$getDB->query("SELECT COUNT(*) as `count` FROM orders");
        if($result){
            while ($row=mysqli_fetch_assoc($result)) {
                $count = $row['count'];  
            }   
            return $count; 
        }
        return $count;
    }
    public function sumTotalForDateTime($start, $end)
    {
        
        $list = array();
        $result =self::$getDB->query("SELECT SUM(total) as sum , date_time FROM `orders` where date_time between '$start' and '$end' GROUP BY date_time");
         if(!self::$getDB->error)
        {
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,['date_time' => $row['date_time'] , 'sum' => $row['sum']]);
                }
                return $list;
            }
            return $list;
        }
        return $list;
    }

    public function selectIdStore(){
        $list = array();
        $result =self::$getDB->query("SELECT distinct(store_id) , stores.name FROM orders,stores where store_id = stores.id");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self(null,null,null,$row['store_id'] , $row['name'] , null));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function selectDateForStore($id = 128){
        $list = array();
        $result =self::$getDB->query("SELECT distinct(YEAR(date_time)) as date_time FROM orders where store_id = $id");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list , $row['date_time']);
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function selectDataFromYear($year = 2021 , $store_id = 128)
    {
        
        $list = array();
        // $date = date('Y' , strtotime($year));
        $result =self::$getDB->query("SELECT date_time , SUM(total) as sum FROM `orders` WHERE YEAR(date_time) = '$year' and store_id = $store_id GROUP BY YEAR(date_time), MONTH(date_time) ");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,['date_time' => date('Y-m', strtotime($row['date_time'])) , "sum" => $row['sum']]);
                }
                return $list;
            }
            return $list;
            
    }
}
}

