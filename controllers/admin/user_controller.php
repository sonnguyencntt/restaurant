<?php
    MyFunction::loadModule('controllers.base_controller');

    class UserController extends BaseController {
        
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
            $type_permission = $this->userGroup[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']];
            if(isset($type_permission['insert']['isLogin']) and $type_permission['insert']['isLogin'])
            $insert = null; 
            else $insert = "hide-elm";
            if(isset($type_permission['update']['isLogin']) and $type_permission['update']['isLogin'])
            $update = null;
            else  $update = "hide-elm";
            if(isset($type_permission['delete']['isLogin']) and $type_permission['delete']['isLogin'])
            $delete = null; 
            else $delete = "hide-elm";
            if($update === 'hide-elm' and $delete === 'hide-elm')
            $td_action = "hide-elm";
            else
            $td_action = null;
            $data = $this->userModal->selectAllData();
            $this->render('user.index',array('title_content'=>ucfirst($GLOBALS['CONTROLLER']) , 'data'=>$data, 'userGroup' => $this->userGroup , 
            'access' => ['insert' => $insert , 'update'=>$update, 'delete' => $delete , "td_action" => $td_action])
            ,'layouts.application');
     }

        public function insert()
        {
            $datenow = "QL" . intval(microtime(true) * 1000);

            $groups = filter_input(INPUT_POST, 'groups', FILTER_SANITIZE_STRING);
            $store = filter_input(INPUT_POST, 'store', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_STRING);
            $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
            $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

          
            if (Myfunction::validateRegrex([$username,$password,$email,$fname,$lname,$phone,$gender,$cpassword,$groups])) {
                $result = $this->userModal->insert($datenow,$username,$password,$email,$fname,$lname,$phone,$gender,'2',$groups);
                if (!$result) {
                    MyFunction::send([], $result, "Thêm mới dữ liệu không thành công");
                    return;
                }
                if ($cpassword != $password) {
                    MyFunction::send([], $result, "Thêm mới dữ liệu không thành công");
                    return;
                }
                $action = '<button type="button" class="btn btn-default" 
                            onclick="editFunc(\'' . $datenow . '\', this)" 
                            data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-pencil"></i>
                            </button> <button type="button" class="btn btn-default" 
                            onclick="removeFunc(\'' . $datenow . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                MyFunction::send([null, $datenow, $username, $email, $fname,$lname,$phone,$gender,$groups,$action], $result, "Thêm mới dữ liệu thành công");
                return;
            }
    
            MyFunction::send([], false, "Thêm mới dữ liệu không thành công");
        }
        public function delete()
        {
            $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
            $result = $this->userModal->delete($id_user);
            if (!$result) {
                MyFunction::send([], $result, "Xóa dữ liệu không thành công");
                return;
            }
            MyFunction::send(array(), $result, "Xóa dữ liệu thành công");
    
        }
        public function edit()
        {
            $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
            $result = $this->userModal->edit($id_user);
            if (count($result) > 0) {
                MyFunction::send($result, true, null);
                return;
            }
            MyFunction::send($result, false, null);
    
        }
        public function update()
        {
            $id_user = filter_input(INPUT_POST, 'edit_id_user', FILTER_SANITIZE_STRING);
            $groups = filter_input(INPUT_POST, 'edit_groups', FILTER_SANITIZE_STRING);
            $store = filter_input(INPUT_POST, 'edit_store', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'edit_username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'edit_email', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'edit_password', FILTER_SANITIZE_STRING);
            $cpassword = filter_input(INPUT_POST, 'edit_cpassword', FILTER_SANITIZE_STRING);
            $fname = filter_input(INPUT_POST, 'edit_fname', FILTER_SANITIZE_STRING);
            $lname = filter_input(INPUT_POST, 'edit_lname', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'edit_phone', FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, 'edit_gender', FILTER_SANITIZE_STRING);


            if (Myfunction::validateRegrex([$username,$email,$fname,$lname,$phone,$gender,$groups])) {
                if(MyFunction::validateRegrex([$password,$cpassword]))
                {
                    if($password === $cpassword)
                    {
                        $result = $this->userModal->update($id_user,$username,$password,$email,$fname,$lname,$phone,$gender,'2',$groups);
                    }
                    else
                    {
                        MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");

                        exit();
                    }
                }
                else
                {
                    if($password === $cpassword)
                    {
                        $result = $this->userModal->update($id_user,$username,null,$email,$fname,$lname,$phone,$gender,'2',$groups);
                    }
                    else
                    {
                        MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");

                        exit();
                    }
                }
            }
            else
            {
                MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");

                exit();
            }
            if (!$result) {
                MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");
                exit();
            }
            $action = '<button type="button" class="btn btn-default" 
            onclick="editFunc(\'' . $id_user . '\', this)" 
            data-toggle="modal" data-target="#editModal">
            <i class="fa fa-pencil"></i>
            </button> <button type="button" class="btn btn-default" 
            onclick="removeFunc(\'' . $id_user . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            MyFunction::send([null, $id_user, $username, $email, $fname,$lname,$phone,$gender,$groups,$action], $result, "Thêm mới dữ liệu thành công");
            return;
        }
    }

?>