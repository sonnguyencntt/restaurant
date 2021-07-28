<?php
    MyFunction::loadModule('controllers.base_controller');

    class PageController extends BaseController {

        
        function __construct($actionId=1)
        {

            MyFunction::loadModule("models.User");
            $this->userModal = new User();


            // Auth::isLogin(function($permission){return $this->userModal->getPermission($permission);});
            $this->folder = 'admin';
            $this->pageId = 1;
            $this->actionId = $actionId;

        }

        public function error(){
            $this->render('page.error',array('title_content'=>ucfirst($GLOBALS['CONTROLLER']),'page_error' =>true),'layouts.application');
        }
        public function error_404(){
            $this->render('page.error_404',array('title_content'=>"ERROR" ,'error_404' => '' ),'layouts.application');
        }
        public function err_uid(){
            $this->render('page.err_406',array('title_content'=>ucfirst($GLOBALS['CONTROLLER'])),'layouts.application');
        }

     
    }

?>