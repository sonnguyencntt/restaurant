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
            MyFunction::loadModule("models.Group");
            MyFunction::loadModule("models.Store");

            $this->groupModal = new Group();
            $this->storeModal = new Store();



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

                if (!isset($_FILES["product_image"])) {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Bạn chưa gửi ảnh lên'));
                    exit();
                }
                if ($_FILES["product_image"]['error'] != 0) {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload ảnh lỗi'));
                    exit();
                }
                $target_dir    = "assets/uploads/";
                $target_file   = $target_dir . MyFunction::generateRandomString() . "." . pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
                $allowUpload   = true;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $maxfilesize   = 900000;
                $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                    if ($check !== false) {
                        $allowUpload = true;
                    } else {
                        MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload ảnh lỗi'));
                        exit();
                    }
                }
                if (file_exists($target_file)) {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload tên đã tồn tại'));
                    $allowUpload = false;
                    exit();
                }
                if ($_FILES["product_image"]["size"] > $maxfilesize) {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Kích cỡ File quá lớn'));
                    $allowUpload = false;
                    exit();
                }
                if (!in_array($imageFileType, $allowtypes)) {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Sai định dạng'));
                    $allowUpload = false;
                    exit();
                }
                if ($allowUpload) {
                    try {
                        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                            $data = $this->userModal->insert($datenow,$username,$password,$email,$fname,$lname,$phone,$gender, $target_file,'2',$groups);
                            if ($data)
                                MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Thêm dữ liệu thành công'));
                            else {
                                unlink($target_dir, $target_file);
                                MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Thêm dữ liệu không thành công'));
                            }
                        } else {
                            MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Đã xảy ra lỗi khi upload'));
                            exit();
                        }
                    } catch (customException $e) {
                        echo $e->errorMessage();
                    }
                } else {
                    MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Đã xảy ra lỗi'));
                    exit();
                }


                // $result = $this->userModal->insert($datenow,$username,$password,$email,$fname,$lname,$phone,$gender,'2',$groups);
                // if (!$result) {
                //     MyFunction::send([], $result, "Thêm mới dữ liệu không thành công");
                //     return;
                // }
                // if ($cpassword != $password) {
                //     MyFunction::send([], $result, "Thêm mới dữ liệu không thành công");
                //     return;
                // }
                // $action = '<button type="button" class="btn btn-default" 
                //             onclick="editFunc(\'' . $datenow . '\', this)" 
                //             data-toggle="modal" data-target="#editModal">
                //             <i class="fa fa-pencil"></i>
                //             </button> <button type="button" class="btn btn-default" 
                //             onclick="removeFunc(\'' . $datenow . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                // MyFunction::send([null, $datenow, $username, $email, $fname,$lname,$phone,$gender,$groups,$action], $result, "Thêm mới dữ liệu thành công");
                // return;
            }
            else
            {
                MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Đã xảy ra lỗi valdiate'));
            }
    
            // MyFunction::send([], false, "Thêm mới dữ liệu không thành công");
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

            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
            if (!Myfunction::validateRegrex([$id])) {
                MyFunction::redirect("?controller=group&type=admin&action=error", array('name' => 'message-fail-access', 'value' => 'url không tồn tại , vui lòng kiểm tra lại'));
                exit();
            }
    
            $result = $this->userModal->edit($id);
            $list_group = $this->groupModal->selectAllData();
            $list_store = $this->storeModal->selectAllData();
            if (count($result) > 0) {
                
                $this->render('User.edit', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $result, 'title' => '', 'action' => '', 'userGroup' => $this->userGroup , 'list_group' => $list_group , 'list_store' =>$list_store), 'layouts.application');
                exit();
            }
            // $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
            // $result = $this->userModal->edit($id_user);
            // if (count($result) > 0) {
            //     MyFunction::send($result, true, null);
            //     return;
            // }
            // MyFunction::send($result, false, null);
    
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
                        $result = $this->userModal->update($id_user,$username,$password,$email,$fname,$lname,$phone,$gender,$store,$groups);
                    }
                    else
                    {
                        
                        MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Cập nhật thành công'));
                        exit();
                    }
                }
                else
                {
                    if($password === $cpassword)
                    {
                   
                        $result = $this->userModal->update($id_user,$username,null,$email,$fname,$lname,$phone,$gender,$store,$groups);
                      
                    }
                    else
                    {
                        MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
                        exit();
                    }
                }
            }
            else
            {
                MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
                        exit();
            }
            if (!$result) {
                MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
                        exit();
            }
       
            MyFunction::redirect("?controller=user&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Cập nhật thành công'));
            exit();
        }

        
    public function create()
    {


        $list_group = $this->groupModal->selectAllData();
        $list_store = $this->storeModal->selectAllData();


        $this->render('user.create', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']), 'userGroup' => $this->userGroup , 'list_group' => $list_group , 'list_store' =>$list_store
        ), 'layouts.application');
    }
    }

?>