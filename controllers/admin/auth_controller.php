<?php
    MyFunction::loadModule('controllers.base_controller');

    class AuthController extends BaseController {

        
        function __construct($actionId=1)
        {
            $this->folder = 'admin';
            $this->pageId = 1;
            $this->actionId = $actionId;
            MyFunction::loadModule("models.User");
            $this->userModal = new User();
        }

        public function index(){
            $this->render(null,array(),'layouts.login');
        }

        public function error(){
            echo "error admin";
        }

        
        
        public function login()
        {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            
           
            $result = $this->userModal->selectId($email,$password);
            if(count($result) > 0)
            {
                $_SESSION['user'] = json_encode($result);
               MyFunction::redirect("?controller=dashboard&action=index&type=admin");
                exit();
            }
            MyFunction::redirect("?controller=auth&type=admin&action=index", array('name'=>'message-fail-login' , 'value'=>'Email or Password is invalid'));
            exit();
        }

        public function logout()
        {
            unset($_SESSION['user']);
            MyFunction::redirect("?controller=auth&type=admin&action=index");
            exit();

        }
    }

?>