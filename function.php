<?php
class MyFunction
{
    public static function loadModule($module)
    {
        $module = str_replace(".", "/", $module);
        require_once($module . '.php');
    }
    public static function redirect($href, $message = null)
    {
        if ($message) {
            self::set_message($message);
        }
        header('Location: ' . $href);
    }
    public static function set_message($message)
    {
        $_SESSION[$message['name']] = $message['value'];
    }
    public static function get_message($message)
    {
        if (isset($_SESSION[$message])) {
            $value = $_SESSION[$message];
            unset($_SESSION[$message]);
            return $value;
        }
        return null;
    }
    public static function listMenu()
    {
        return array(
            0 => array('name' => 'dashboard', 'href' => '?controller=dashboard&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-dashboard'),
            1 => array('name' => 'user', 'href' => '?controller=user&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),
            2 => array(
                'name' => 'group',
                'page' => array(
                    array('name' => 'manage', 'href' => '?controller=group&action=index&type=admin', 'id' => PAGE_ID, 'action' => 'index'),
                    array('name' => 'create', 'href' => '?controller=group&action=create&type=admin', 'id' => PAGE_ID, 'action' => 'create')
                ),
                'level' => 2,
                'icon' =>  'fa fa-files-o',
                'href' => '?controller=group&action=index&type=admin'

            ),
            3 => array('name' => 'product', 'href' => '?controller=product&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),
            4 => array('name' => 'order', 'href' => '?controller=order&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),

            5 => array(
                'name' => 'category',
                'page' => array(
                    array('name' => 'manage', 'href' => '?controller=category&action=index&type=admin', 'id' => PAGE_ID, 'action' => 'index'),
                    array('name' => 'create', 'href' => '?controller=category&action=create&type=admin', 'id' => PAGE_ID, 'action' => 'create')
                ),
                'level' => 2,
                'icon' =>  'fa fa-files-o',
                'href' => '?controller=category&action=index&type=admin'

            ),

            6 => array('name' => 'report', 'href' => '?controller=report&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),

            7 => array('name' => 'company', 'href' => '?controller=company&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),
            8 => array('name' => 'profile', 'href' => '?controller=profile&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-files-o'),
            9 => array('name' => 'setting', 'href' => '?controller=setting&action=index&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'fa fa-wrench'),
            10 => array('name' => 'logout', 'href' => '?controller=auth&action=logout&type=admin', 'id' => PAGE_ID, 'level' => 1, 'icon' =>  'glyphicon glyphicon-log-out'),
        );
    }
    public static function validateRegrex($list)
    {
        foreach ($list as $value) {
            if (!isset($value) or empty(trim($value))) {
                return false;
            }
        }
        return true;
    }
    public static function send($data, $status, $message)
    {
        echo json_encode(['data' => $data, 'status' => $status, 'message' => $message]);
    }

    public static function permission()
    {
        $support_controllers = array(
            'user' => array(
                'page' => array('error'),
                'dashboard' => array('index' => array('isLogin' => true)),
                'bill' => array('index' => array('isLogin' => true)),
                'user' => array('index' => array('isLogin' => true)),
            ),
            'admin' => array(
                'page' => array('error'),
                'dashboard' => array('index' => array('isLogin' => true)),
                'bill' => array('index'),
                'user' => array('index' => array('isLogin' => false), 'insert' => array('isLogin' => false), 'delete' => array('isLogin' => false), 'edit' => array('isLogin' => false), 'update' => array('isLogin' => false), 'delete' => array('isLogin' => false)),
                'group' => array('index' => array('isLogin' => true), 'create', 'insert' => array('isLogin' => true), 'update' => array('isLogin' => true), 'edit' => array('isLogin' => true), 'delete' => array('isLogin' => true)),
                'report' => array('index' => array('isLogin' => false), 'report_store', 'search', 'search_store'),
                'product' => array('index' => array('isLogin' => false), 'insert' => array('isLogin' => false), 'delete' => array('isLogin' => false), 'edit' => array('isLogin' => false), 'update' => array('isLogin' => false)),
                'order' => array('index' => array('isLogin' => false)),
                'company' => array('index' => array('isLogin' => false)),
                'profile' => array('index' => array('isLogin' => false)),
                'setting' => array('index' => array('isLogin' => false)),
                'auth' => array('index', 'login', 'logout'),
            ),
        );
    }
    public static function getDateOfWeek()
    {
        $date =  date("Y-m-d");
        $weekday = date("l");
        $weekday = strtolower($weekday);
        switch ($weekday) {
            case 'monday':
                $weekday = 0;
                break;
            case 'tuesday':
                $weekday = 1;
                break;
            case 'wednesday':
                $weekday = 2;
                break;
            case 'thursday':
                $weekday = 3;
                break;
            case 'friday':
                $weekday = 4;
                break;
            case 'saturday':
                $weekday = 5;
                break;
            default:
                $weekday = 6;
                break;
        }
        $listday = array();
        for ($i = 0; $i < 7; $i++) {
            if ($i <= $weekday)
                array_push($listday,  date('Y-m-d', strtotime($date . " - " . ($weekday - $i) . " day")));
            else
                array_push($listday,  date('Y-m-d', strtotime($date . " + " . ($i - $weekday) . " day")));
        }
        return $listday;
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
