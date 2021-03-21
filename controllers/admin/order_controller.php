<?php
    MyFunction::loadModule('controllers.base_controller');

    class OrderController extends BaseController {

        function __construct()
        {
            MyFunction::loadModule("models.User");
            $this->userModal = new User();
            $this->userGroup = Auth::isLogin(
                function($idUser){
                return $this->userModal->getUserGroup($idUser);
            },
                function($permission) {
                return $this->userModal->getPermission($permission);
            });

            $this->folder = 'admin';
        }

        public function index(){
            $this->render('order.index',array('title_content'=>ucfirst($GLOBALS['CONTROLLER']),'userGroup' => $this->userGroup),'layouts.application');
        }
        public function formInsert(){
            $this->render('group.insert',array(),'layouts.application');
        }
        public function error(){
            echo "error admin";
        }
    }

?>