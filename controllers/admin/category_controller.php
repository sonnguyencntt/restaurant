<?php
MyFunction::loadModule('controllers.base_controller');

class CategoryController extends BaseController
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
        MyFunction::loadModule("models.Category");
        $this->categoryModal = new Category();
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



        $data = $this->categoryModal->selectAllData();
        $this->render('category.index', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']),'access' => ['insert' => $insert , 'update'=>$update, 'delete' => $delete , "td_action" => $td_action], 'userGroup' => $this->userGroup, 'data' => $data
        ), 'layouts.application');
    }

    public function create()
    {


        $data = $this->categoryModal->selectAllData();

        $this->render('category.create', array(
            'title_content' => ucfirst($GLOBALS['CONTROLLER']), 'userGroup' => $this->userGroup
        ), 'layouts.application');
    }
    public function edit()
    {
        $id_category = filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_STRING);
        $result = $this->categoryModal->edit($id_category);
        if (count($result) > 0) {
            MyFunction::send($result, true, null);
            return;
        }
        MyFunction::send($result, false, null);

    }
    public function insert()
    {
        $datenow = "DM" . intval(microtime(true) * 1000);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        
        if (Myfunction::validateRegrex([$name, $active])) {
            $result = $this->categoryModal->insert($name, $active, $datenow);
            if (!$result) {
                MyFunction::send([], $result, "Th??m m???i d??? li???u kh??ng th??nh c??ng");
                return;
            }
            $action = '<button type="button" class="btn btn-default" 
                        onclick="editFunc(\'' . $datenow . '\', this)" 
                        data-toggle="modal" data-target="#editModal">
                        <i class="fa fa-pencil"></i>
                        </button> <button type="button" class="btn btn-default" 
                        onclick="removeFunc(\'' . $datenow . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            $active = '<span class="label label-success">' . $active . '</span>';
            MyFunction::send([null, $datenow, $name, $active, $action], $result, "Th??m m???i d??? li???u th??nh c??ng");
            return;
        }
    }
    public function delete()
    {
        $id_category = filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_STRING);
        $result = $this->categoryModal->delete($id_category);
        if (!$result) {
            MyFunction::send([], $result, "X??a d??? li???u kh??ng th??nh c??ng");
            return;
        }
        MyFunction::send(array(), $result, "X??a d??? li???u th??nh c??ng");

    }

    public function error()
    {
        $this->render('company.error', array(
            'title_content' => "ERROR", 'userGroup' => $this->userGroup,
        ), 'layouts.application');
    }
    public function update()
    {
        $id_category = trim(filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_STRING));
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
        $action = '<button type="button" class="btn btn-default" 
        onclick="editFunc(' . $id_category . ')" 
        data-toggle="modal" data-target="#editModal">
        <i class="fa fa-pencil"></i>
        </button> <button type="button" class="btn btn-default" 
        onclick="removeFunc(\'' . $id_category . '\', this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

        $result = $this->categoryModal->update($id_category, $name, $active);
        $active = '<span class="label label-success">' . $active . '</span>';

        if (!$result) {
            MyFunction::send([], $result, "C???p nh???t d??? li???u kh??ng th??nh c??ng");
            return;
        }
        MyFunction::send(array(null, $id_category, $name, $active, $action), $result, "C???p nh???t d??? li???u th??nh c??ng");   
    }
}
