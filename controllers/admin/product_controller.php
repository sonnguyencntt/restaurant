<?php
MyFunction::loadModule('controllers.base_controller');

class ProductController extends BaseController
{

    public $productModal;

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
        MyFunction::loadModule("models.Product");
        $this->productModal = new Product();
        $this->folder = 'admin';
    }

    public function index()
    {
        $data = $this->productModal->selectAllData();
        $this->render('product.index', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $data,'userGroup' => $this->userGroup), 'layouts.application');
    }
    public function formInsert()
    {
        $this->render('group.insert', array(), 'layouts.application');
    }
    public function insert()
    {
        $datenow = "CH" . intval(microtime(true) * 1000);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        
        if (Myfunction::validateRegrex([$name, $active])) {
            $result = $this->productModal->insert($name, $active, $datenow);
            if (!$result) {
                MyFunction::send([], $result, "Thêm mới dữ liệu không thành công");
                return;
            }
            $action = '<button type="button" class="btn btn-default" 
                        onclick="editFunc(\'' . $datenow . '\', this)" 
                        data-toggle="modal" data-target="#editModal">
                        <i class="fa fa-pencil"></i>
                        </button> <button type="button" class="btn btn-default" 
                        onclick="removeFunc(\'' . $datenow . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            $active = '<span class="label label-success">' . $active . '</span>';
            MyFunction::send([null, $datenow, $name, $active, $action], $result, "Thêm mới dữ liệu thành công");
            return;
        }

        MyFunction::send([], false, "Thêm mới dữ liệu không thành công");
    }

    public function error()
    {
        echo "error admin";
    }
    public function delete()
    {
        $id_store = filter_input(INPUT_POST, 'id_store', FILTER_SANITIZE_STRING);
        $result = $this->productModal->delete($id_store);
        if (!$result) {
            MyFunction::send([], $result, "Xóa dữ liệu không thành công");
            return;
        }
        MyFunction::send(array(), $result, "Xóa dữ liệu thành công");

    }
    public function edit()
    {
        $id_store = filter_input(INPUT_POST, 'id_store', FILTER_SANITIZE_STRING);
        $result = $this->productModal->edit($id_store);
        if (count($result) > 0) {
            MyFunction::send($result, true, null);
            return;
        }
        MyFunction::send($result, false, null);

    }
    public function update()
    {
        $id_store = trim(filter_input(INPUT_POST, 'id_store', FILTER_SANITIZE_STRING));
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        $action = '<button type="button" class="btn btn-default" 
        onclick="editFunc(' . $id_store . ')" 
        data-toggle="modal" data-target="#editModal">
        <i class="fa fa-pencil"></i>
        </button> <button type="button" class="btn btn-default" 
        onclick="removeFunc(\'' . $id_store . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

        $result = $this->productModal->update($id_store, $name, $active);
        $active = '<span class="label label-success">' . $active . '</span>';

        if (!$result) {
            MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");
            return;
        }
        MyFunction::send(array(null, $id_store, $name, $active, $action), $result, "Cập nhật dữ liệu thành công");   
    }
}
