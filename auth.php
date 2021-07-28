<?php
class Auth
{
    public $role;

    public static function isLogin($getUserGroup , $getPermission)
    {
        if(!isset($_SESSION['user']))
            $permission = 10;
        else   {     
            $permission = $getUserGroup(json_decode($_SESSION['user'], true)[0]['id_user'])[0]->table_group->id;  
            $getPermission1 = $getPermission($permission);
           
        }
        if(!$getPermission1)
        {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
                MyFunction::send([], false, "Bạn không có quyền truy cập");
                exit();          
              }
        if($GLOBALS['TYPE'] == 'user')
        MyFunction::redirect("?controller=page&type=user&action=index");
        else{
            if($permission == 10)
            {
            MyFunction::redirect("?controller=auth&type=admin&action=index");
            }           
            else
            {
            MyFunction::redirect("?controller=page&type=admin&action=error" , array('name' => 'message-fail-access', 'value' => 'Bạn không có quyền truy cập , vui lòng cấp quyền truy cập'));
            exit();
            }
        } 
        }
        return $getPermission1;
       
    }

    public static function isNeedLogin()
    {
        return true;
    }

    public static function authentication(){
        if(isset($_SESSION['user']))
        {
            return true;
        }
        return false;
    }

    public static function authorization(){
        return true;
    }
}
