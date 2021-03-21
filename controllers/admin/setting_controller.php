<?php
MyFunction::loadModule('controllers.base_controller');

class SettingController extends BaseController
{


    function __construct($actionId = 1)
    {

        MyFunction::loadModule("models.User");
        $this->userModal = new User();


        $this->userGroup = Auth::isLogin(
            function ($idUser) {
                return $this->userModal->getUserGroup($idUser);
            },
            function ($permission) {
                return $this->userModal->getPermission($permission);
            }
        );

        $this->folder = 'admin';
        $this->pageId = 1;
        $this->actionId = $actionId;
    }

    public function index()
    {
        $type_permission = $this->userGroup[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']];
          
        if(isset($type_permission['update']['isLogin']) and $type_permission['update']['isLogin'])
        $update = null;
        else  $update = "hide-elm";
        $getUserId = json_decode($_SESSION['user'], true);
        $data = $this->userModal->getUserGroup($getUserId[0]['id_user']);
        $this->render('setting.index', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $data, 'userGroup' => $this->userGroup,'access'=>['update' =>$update]
        ), 'layouts.application');
    }
    public function update()
    {
        var_dump($_POST);
        $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $fristname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

        if (Myfunction::validateRegrex([$id_user, $username, $email, $fristname, $lastname, $gender, $phone])) {
            if (Myfunction::validateRegrex([$password, $cpassword]) and $password === $cpassword)
                $data = $this->userModal->settingUser($id_user, $username, $password, $email, $fristname, $lastname, $gender, $phone);
            else if (!Myfunction::validateRegrex([$password, $cpassword]) and $password === $cpassword)
                $data = $this->userModal->settingUser($id_user, $username, null, $email, $fristname, $lastname, $gender, $phone);
            else
                MyFunction::redirect("?controller=setting&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
            if ($data)
                MyFunction::redirect("?controller=setting&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Cập nhật dữ liệu thành công'));
            else
                MyFunction::redirect("?controller=setting&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
                exit();

        }
        MyFunction::redirect("?controller=setting&type=admin&action=index" , array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));

    }
    public function error()
    {
        echo "error admin";
    }
}
