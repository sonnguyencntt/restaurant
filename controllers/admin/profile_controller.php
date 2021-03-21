<?php
    MyFunction::loadModule('controllers.base_controller');

    class ProfileController extends BaseController {

        
        function __construct($actionId=1)
        {

            MyFunction::loadModule("models.User");
            $this->userModal = new User();


            $this->userGroup = Auth::isLogin(
                function($idUser){
                return $this->userModal->getUserGroup($idUser);
            },
                function($permission) {
                return $this->userModal->getPermission($permission);
            });            $this->folder = 'admin';
            $this->pageId = 1;
            $this->actionId = $actionId;
        }

        public function index(){
            $getUserId = json_decode($_SESSION['user'], true);
            $data = $this->userModal->getUserGroup($getUserId[0]['id_user']);
            $this->render('profile.index',array('title_content'=>ucfirst($GLOBALS['CONTROLLER']),'data'=>$data,'userGroup' => $this->userGroup,
        ),'layouts.application');
        }

        public function error(){
            echo "error admin";
        }
    }

?>