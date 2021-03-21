<?php
    MyFunction::loadModule('controllers.base_controller');

    class CompanyController extends BaseController {

        
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
            MyFunction::loadModule("models.Company");

            $this->companyModal = new Company();


        }

        public function index(){
            $type_permission = $this->userGroup[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']];
          
            if(isset($type_permission['update']['isLogin']) and $type_permission['update']['isLogin'])
            $update = null;
            else  $update = "hide-elm";
           

            $data = $this->companyModal->selectAllData();
            $this->render('company.index',array('title_content'=>ucfirst($GLOBALS['CONTROLLER']),'data'=>$data,'userGroup' => $this->userGroup,
            'access' => ['update'=>$update]),'layouts.application');
        }
    

        public function error(){
            $this->render('company.error',array('title_content'=>"ERROR",'userGroup' => $this->userGroup,
        ),'layouts.application');        }
        public function update()
        {
            $id = filter_input(INPUT_POST, 'id_company', FILTER_SANITIZE_STRING);

            $company_name = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
            $service_charge_value = filter_input(INPUT_POST, 'service_charge_value', FILTER_SANITIZE_STRING);
            $vat_charge_value = filter_input(INPUT_POST, 'vat_charge_value', FILTER_SANITIZE_STRING);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
            $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
            $currency = filter_input(INPUT_POST, 'currency', FILTER_SANITIZE_STRING);
    
            if (Myfunction::validateRegrex([$id,$company_name, $service_charge_value, $vat_charge_value, $address,$phone,$country,$message,$currency])) {
                $data = $this->companyModal->update($id,$company_name, $service_charge_value, $vat_charge_value, $address,$phone,$country,$message,$currency);
          
                if ($data)
                    MyFunction::redirect("?controller=company&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Cập nhật dữ liệu thành công'));
                else
                    MyFunction::redirect("?controller=company&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
                    exit();
            }
            MyFunction::redirect("?controller=company&type=admin&action=index" , array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));

        }
    }

?>