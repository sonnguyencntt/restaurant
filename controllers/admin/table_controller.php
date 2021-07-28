<?php
MyFunction::loadModule('controllers.base_controller');

class TableController extends BaseController
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
        MyFunction::loadModule("models.Table");
        $this->tableModal = new Table();
        MyFunction::loadModule("models.Store");
        $this->storeModal = new Store();

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


        $list_store = $this->storeModal->selectAllData();
        $data = $this->tableModal->selectAllData();
        $this->render('table.index', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']),'access' => ['insert' => $insert , 'update'=>$update, 'delete' => $delete , "td_action" => $td_action], 'userGroup' => $this->userGroup, 'data' => $data, 'list_store'=>$list_store
        ), 'layouts.application');
    }

    public function create()
    {


        $data = $this->tableModal->selectAllData();

        $this->render('table.create', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']), 'userGroup' => $this->userGroup
        ), 'layouts.application');
    }
    public function edit()
    {
        $id_table = filter_input(INPUT_POST, 'id_table', FILTER_SANITIZE_STRING);
        $result = $this->tableModal->edit($id_table);
        if (count($result) > 0) {
            MyFunction::send($result, true, null);
            return;
        }
        MyFunction::send($result, false, null);

    }
    public function insert()
    {
        $datenow = "T" . intval(microtime(true) * 1000);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);

        
        if (Myfunction::validateRegrex([$name, $active,$store_id])) {
            $result = $this->tableModal->insert($name, $active, $datenow, $store_id);
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
            MyFunction::send([null, $datenow, $name, $active,$store_id, $action], $result, "Thêm mới dữ liệu thành công");
            return;
        }
    }
    public function delete()
    {
        $id_table = filter_input(INPUT_POST, 'id_table', FILTER_SANITIZE_STRING);
        $result = $this->tableModal->delete($id_table);
        if (!$result) {
            MyFunction::send([], $result, "Xóa dữ liệu không thành công");
            return;
        }
        MyFunction::send(array(), $result, "Xóa dữ liệu thành công");

    }

    public function error()
    {
        $this->render('company.error', array(
            'title_content' => "ERROR", 'userGroup' => $this->userGroup,
        ), 'layouts.application');
    }
    public function update()
    {
        $id_table = trim(filter_input(INPUT_POST, 'id_table', FILTER_SANITIZE_STRING));
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);

        $action = '<button type="button" class="btn btn-default" 
        onclick="editFunc(' . $id_table . ')" 
        data-toggle="modal" data-target="#editModal">
        <i class="fa fa-pencil"></i>
        </button> <button type="button" class="btn btn-default" 
        onclick="removeFunc(\'' . $id_table . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

        $result = $this->tableModal->update($id_table, $name, $active, $store_id);
        $active = '<span class="label label-success">' . $active . '</span>';

        if (!$result) {
            MyFunction::send([], $result, "Cập nhật dữ liệu không thành công");
            return;
        }
        MyFunction::send(array(null, $id_table, $name, $active,$store_id, $action), $result, "Cập nhật dữ liệu thành công");   
    }
}
