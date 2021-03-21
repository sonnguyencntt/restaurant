<?php
class Company extends DB
{
    
    public $id;
    public $company_name;
    public $service_charge_value;
    public $vat_charge_value;
    public $address;
    public $phone;
    public $country;
    public $message;
    public $currency;



    public function __construct($id = null, $company_name = null, $service_charge_value  = null , $vat_charge_value = null, $address = null , $phone = null , $country = null, $message = null , $currency = null)
    {
        $this->id = $id;
        $this->company_name = $company_name;
        $this->service_charge_value = $service_charge_value;
        $this->vat_charge_value = $vat_charge_value;
        $this->address = $address;
        $this->phone = $phone;
        $this->country = $country;
        $this->message = $message;
        $this->currency = $currency;

        Company::$getDB =  $this->connect();
    }

    public function count()
    {
        $count = 0;
        $result =Company::$getDB->query("SELECT COUNT(*) as `count` FROM company");
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
        $result =self::$getDB->query("SELECT * FROM company");
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while ($row=mysqli_fetch_assoc($result)) {
                  
                    array_push($list,new self($row["id"],$row['company_name'],$row['service_charge_value'] ,$row['vat_charge_value'],$row['address'],$row['phone'],$row['country'],$row['message'],$row['currency']));
                }
                return $list;
            }
            return $list;
            
           
        }
    }
    public function update($id,$company_name, $service_charge_value, $vat_charge_value, $address,$phone,$country,$message,$currency)
    {
        $result = self::$getDB->query("UPDATE `company` SET `company_name` = '$company_name' , `service_charge_value` = '$service_charge_value' , `vat_charge_value` = '$vat_charge_value' , `address` = '$address' , `phone` = '$phone' , `country` = '$country', `message` ='$message' , `currency` = '$currency'  WHERE `company`.`id` = $id");
        if(!self::$getDB->error)
        {
            if(mysqli_affected_rows(self::$getDB) >= 0){
                return true;
            }
        }
        return false;
    }
}

