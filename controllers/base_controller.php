<?php

        class BaseController {
        protected $folder;
        protected $pageId;
        protected $actionId;

       
        public function render($view = 'dashboard.index',$data=array(),$main_template = 'layout.index'){

            $view = str_replace(".","/",$view);
            $main_template = str_replace(".","/",$main_template);

            extract($data);
            ob_start();
            if( $GLOBALS['TYPE'] === 'admin')
            {
                if($GLOBALS['CONTROLLER'] === 'auth'){}
                else{
                    require_once('views/'. $this->folder . '/' . $view . '.php');

                }
               
            }
            if($GLOBALS['TYPE'] === 'user')
            {
            }
            $content = ob_get_clean();

            require_once('views/'. $this->folder . '/' . $main_template . '.php');

            
        }
        }
?>