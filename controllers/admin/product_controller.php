<?php
MyFunction::loadModule('controllers.base_controller');

class ProductController extends BaseController
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
        MyFunction::loadModule("models.Product");
        MyFunction::loadModule("models.Category");

        $this->ProductModal = new Product();
        $this->CategoryModal = new Category();

        $this->folder = 'admin';
    }

    public function index()
    {
       
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



        $data = $this->ProductModal->selectAllData();
        $this->render('Product.index', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']),'access' => ['insert' => $insert , 'update'=>$update, 'delete' => $delete , "td_action" => $td_action], 'userGroup' => $this->userGroup, 'data' => $data
        ), 'layouts.application');
    }

    public function create()
    {

   
        $data = $this->ProductModal->selectAllData();
        $list_category = $this->CategoryModal->selectAllData();

        $this->render('Product.create', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']), 'userGroup' => $this->userGroup , 'list_category'=>$list_category
        ), 'layouts.application');
    }
    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        if (!Myfunction::validateRegrex([$id])) {
            MyFunction::redirect("?controller=group&type=admin&action=error", array('name' => 'message-fail-access', 'value' => 'url kh??ng t???n t???i , vui l??ng ki???m tra l???i'));
            exit();
        }

        $result = $this->ProductModal->edit($id);
        $list_category = $this->CategoryModal->selectAllData();

        if (count($result) > 0) {
            
            $this->render('Product.create', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $result, 'title' => '', 'action' => '', 'userGroup' => $this->userGroup, 'list_category'=>$list_category), 'layouts.application');
            exit();
        }
    }
    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'L???i ph????ng th???c'));
            exit();
        }
        $name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $category_id = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
       
        if (Myfunction::validateRegrex([$name, $price, $category_id, $active])) {
            if (!isset($_FILES["product_image"])) {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'B???n ch??a g???i ???nh l??n'));
                exit();
            }
            if ($_FILES["product_image"]['error'] != 0) {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload ???nh l???i'));
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
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload ???nh l???i'));
                    exit();
                }
            }
            if (file_exists($target_file)) {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload t??n ???? t???n t???i'));
                $allowUpload = false;
                exit();
            }
            if ($_FILES["product_image"]["size"] > $maxfilesize) {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'K??ch c??? File qu?? l???n'));
                $allowUpload = false;
                exit();
            }
            if (!in_array($imageFileType, $allowtypes)) {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Sai ?????nh d???ng'));
                $allowUpload = false;
                exit();
            }
            if ($allowUpload) {
                try {
                    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                        $data = $this->ProductModal->insert($name, $price, $category_id, $active, $target_file, $description);
                        if ($data)
                            MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Th??m d??? li???u th??nh c??ng'));
                        else {
                            unlink($target_dir, $target_file);
                            MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Th??m d??? li???u kh??ng th??nh c??ng'));
                        }
                    } else {
                        MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => '???? x???y ra l???i khi upload'));
                        exit();
                    }
                } catch (customException $e) {
                    echo $e->errorMessage();
                }
            } else {
                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => '???? x???y ra l???i'));
                exit();
            }
        }
        else

        {
            MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'L???i nh???p Form'));
            exit();
        }
      
    }
    public function delete()
    {
        $id = filter_input(INPUT_POST, 'remove_id_product', FILTER_SANITIZE_STRING);
        $result = $this->ProductModal->delete($id);
        if ($result) {
            MyFunction::redirect("?controller=product&type=admin&action=index", array('name' => 'message-success-uid', 'value' => 'X??a d??? li???u th??nh c??ng'));
            exit();
        }
        MyFunction::redirect("?controller=product&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'X??a d??? li???u kh??ng th??nh c??ng'));
    }

    public function error()
    {
        $this->render('company.error', array(
            'title_content' => "ERROR", 'userGroup' => $this->userGroup,
        ), 'layouts.application');
    }
    public function update()
    {

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

        $name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $category_id = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);

        if (Myfunction::validateRegrex([$name, $price, $category_id, $active])) {
            if (isset($_FILES["product_image"]) and $_FILES["product_image"]['error'] == 0) {
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
                        MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload ???nh l???i'));
                        exit();
                    }
                }
                if (file_exists($target_file)) {
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Upload t??n ???? t???n t???i'));
                    $allowUpload = false;
                    exit();
                }
                if ($_FILES["product_image"]["size"] > $maxfilesize) {
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'K??ch c??? File qu?? l???n'));
                    $allowUpload = false;
                    exit();
                }
                if (!in_array($imageFileType, $allowtypes)) {
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Sai ?????nh d???ng'));
                    $allowUpload = false;
                    exit();
                }

                if ($allowUpload) {
                    try {
                        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                            $data = $this->ProductModal->update($id, $name, $price, $category_id, $active, $target_file, $description);
                            if ($data)
                                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'Th??m d??? li???u th??nh c??ng'));
                            else {
                                unlink($target_dir, $target_file);
                                MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'Th??m d??? li???u kh??ng th??nh c??ng'));
                            }
                        } else {
                            MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => '???? x???y ra l???i khi upload'));
                            exit();
                        }
                    } catch (customException $e) {
                        echo $e->errorMessage();
                    }
                } else {
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => '???? x???y ra l???i'));
                    exit();
                }
            } else {
                $data = $this->ProductModal->update($id, $name, $price, $category_id,  $active, null, $description);

                if ($data)
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-success-uid', 'value' => 'C???p nh???t d??? li???u th??nh c??ng'));
                else
                    MyFunction::redirect("?controller=product&action=index&type=admin", array('name' => 'message-fail-uid', 'value' => 'C???p nh???t d??? li???u kh??ng th??nh c??ng'));
                exit();
            }
        }

        MyFunction::redirect("?controller=product&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'C???p nh???t d??? li???u kh??ng th??nh c??ng'));
    }
}
