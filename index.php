<?php
class H{
    static function __callStatic($name, $arguments)
    {
        echo $name;
    }
    // function __construct()
    // {
        
    // }
}

    $x = new H();
    
    // use C\B\X;
    // spl_autoload_register('load');
    // function load($class)
    // {
    //     H::asdas();
    // }
    // X::test();
  
   // session_start();
    // session_regenerate_id();
    // require_once("function.php");
    // MyFunction::loadModule('config');
    // MyFunction::loadModule('define');
    // MyFunction::loadModule('auth');



    // $support_controllers = array(
    //    'user' => array(
    //         'page' => array('error'),
    //        'dashboard' => array('index'),
    //         'bill' => array('index'),
    //         'user' => array('index'),
    //    ),
    //    'admin' => array(
    //         'page' => array('error','err_404'),
    //         'dashboard' => array('index'),
    //         'bill' => array('index'),
    //         'user' => array('index','insert','delete','edit','update','delete'),
    //         'group' => array('index','create','insert','update','edit','delete' ,'error'),
    //         'report' => array('index','selectdate', 'search' , 'search_store'),
    //         'product' => array('index','insert','delete','edit','update'),
    //         'category' =>array('index' ,'create','insert','delete', 'edit','update'),
    //         'order' => array('index'),
    //         'company' => array('index','update','error'),
    //         'profile' => array('index'),
    //         'setting' => array('index','update'),
    //         'auth' =>array('index','login','logout'),

    //    ),
    // );

    // if(isset($_GET['type'])){
    //    $GLOBALS['TYPE']  =  $_GET['type'];
    // }
    // else
    // {
    //     $GLOBALS['TYPE'] = 'user';
    // }

    // if(isset($_GET['controller'])){
    //     $GLOBALS['CONTROLLER'] = $_GET['controller'];
    //     if(isset($_GET['action'])){
    //         $GLOBALS['ACTION'] = $_GET['action'];
    //     }
    //     else{
    //         $GLOBALS['ACTION'] = 'index';
    //     }

    // }
    // else
    // {
    //     if($GLOBALS['TYPE'] === "user")
    //     {
    //         $GLOBALS['CONTROLLER'] = 'home';
    //     }
    //    else
    //    {
    //     $GLOBALS['CONTROLLER'] = 'dashboard';
    //    }
    //     $GLOBALS['ACTION'] = 'index';
    // }

    // if(!array_key_exists($GLOBALS['TYPE'] , $support_controllers) ||
    //    !array_key_exists($GLOBALS['CONTROLLER'] , $support_controllers[$GLOBALS['TYPE']])|| 
    //    !in_array($GLOBALS['ACTION'] , $support_controllers[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']])){

    //     if(array_key_exists($GLOBALS['TYPE'], $support_controllers) and $GLOBALS['TYPE'] === "admin" )
    //         $GLOBALS['TYPE'] = 'admin';
    //     else   
    //         $GLOBALS['TYPE'] = 'user';

    //     $GLOBALS['CONTROLLER'] = 'page';
    //     $GLOBALS['ACTION'] = 'error_404';
    // }
    // require_once("controllers/".$GLOBALS['TYPE']."/".$GLOBALS['CONTROLLER']."_controller.php");
    // $classname = ucfirst($GLOBALS['CONTROLLER'])."Controller";
    // $obj = new $classname();
    // $action=$GLOBALS['ACTION'];
    // $obj->$action();


?>