<?php


MyFunction::loadModule('controllers.base_controller');

class GroupController extends BaseController
{

    function __construct()
    {

        MyFunction::loadModule("models.User");
        MyFunction::loadModule("models.Permission");
        MyFunction::loadModule("models.Group");


        $this->userModal = new User();
        $this->permissionModal = new Permission();
        $this->groupModal = new Group();



       $this->userGroup =  Auth::isLogin(
            function($idUser){
            return $this->userModal->getUserGroup($idUser);
        },
            function($permission) {
            return $this->userModal->getPermission($permission);
        });

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
        $data = $this->groupModal->selectAllData();

        $this->render('group.index', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $data,'access' => ['insert' => $insert , 'update'=>$update, 'delete' => $delete , "td_action" => $td_action],'userGroup' => $this->userGroup , ), 'layouts.application');
    }
    public function create()
    {
        $data = json_decode($this->permissionModal->selectAllData()[0]->value, true);
        $this->render('group.insert', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $data,'userGroup' => $this->userGroup), 'layouts.application');
    }
    public function insert()
    {

        $name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_STRING);
        if (Myfunction::validateRegrex([$name])) {
            $data = json_decode($this->permissionModal->selectAllData()[0]->value, true);

            $permission = $data;
            foreach ($data as $key_type => $val_type) {
                foreach ($val_type as $key_controller => $val_controller) {
                    foreach ($val_controller as $key_action => $val_action) {
                        $tring_Data = $key_type . "_" .  $key_controller . "_" . $key_action . "_" . "isLogin";
                        if (isset($_POST[$tring_Data])) {
                            if (isset($permission[$key_type][$key_controller][$key_action]["isLogin"])) {
                                if ($key_action === "update") {
                                    if (isset($permission[$key_type][$key_controller]['edit']["isLogin"]))
                                        $permission[$key_type][$key_controller]['edit']["isLogin"] = true;
                                }

                                if ($key_controller === "report" and $key_action === "index")
                                    $permission[$key_type][$key_controller]['report_store']["isLogin"] = true;

                                $permission[$key_type][$key_controller][$key_action]["isLogin"] = true;
                            }
                        } else {
                            if (isset($permission[$key_type][$key_controller][$key_action]["isLogin"])) {
                                if ($key_action === "edit" || ($key_controller === "report" and $key_action === "report_store"))
                                    continue;

                                if ($key_action === "update")
                                    $permission[$key_type][$key_controller]['edit']["isLogin"] = false;

                                if ($key_controller === "report" and $key_action === "index")
                                    $permission[$key_type][$key_controller]['report_store']["isLogin"] = false;

                                $permission[$key_type][$key_controller][$key_action]["isLogin"] = false;
                            }
                        }
                    }
                }
            }
            $permission = json_encode($permission);
            $result = $this->groupModal->insert($name, $permission);
            if ($result)
                MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-success-uid', 'value' => 'Thêm mới dữ liệu thành công'));
            else
                MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'Thêm mới dữ liệu không thành công'));
        }
    }
    public function edit()
    {
        $id_group = filter_input(INPUT_GET, 'id_group', FILTER_SANITIZE_STRING);
        if (!Myfunction::validateRegrex([$id_group])) {
            MyFunction::redirect("?controller=group&type=admin&action=error" , array('name' => 'message-fail-access', 'value' => 'url không tồn tại , vui lòng kiểm tra lại'));
            exit();
        }

        $result = $this->groupModal->edit($id_group);
        if (count($result) > 0) {
            $data = json_decode($result[0]->permission, true);
            $name_group = $result[0]->group_name;

            $this->render('group.insert', array('title_content' => ucfirst($GLOBALS['CONTROLLER']), 'data' => $data, 'title' => '', 'action' => '', 'name_group' => $name_group, 'id_group' => $id_group,'userGroup' => $this->userGroup), 'layouts.application');
            exit();
        }
        MyFunction::redirect("?controller=group&type=admin&action=error" , array('name' => 'message-fail-access', 'value' => 'url không tồn tại , vui lòng kiểm tra lại'));
    }

    public function error()
    {
        $this->render('group.error', array('title_content' => ucfirst($GLOBALS['CONTROLLER']),'userGroup' => $this->userGroup), 'layouts.application');
    }

    public function update()
    {

        $name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_STRING);
        $id_group = filter_input(INPUT_POST, 'id_group', FILTER_SANITIZE_STRING);

        if (Myfunction::validateRegrex([$name, $id_group])) {
            $data = json_decode($this->permissionModal->selectAllData()[0]->value, true);

            $permission = $data;
            foreach ($data as $key_type => $val_type) {
                foreach ($val_type as $key_controller => $val_controller) {
                    foreach ($val_controller as $key_action => $val_action) {
                        $tring_Data = $key_type . "_" .  $key_controller . "_" . $key_action . "_" . "isLogin";
                        if (isset($_POST[$tring_Data])) {
                            if (isset($permission[$key_type][$key_controller][$key_action]["isLogin"])) {
                                if ($key_action === "update") {
                                    if (isset($permission[$key_type][$key_controller]['edit']["isLogin"]))
                                        $permission[$key_type][$key_controller]['edit']["isLogin"] = true;
                                }

                                if ($key_controller === "report" and $key_action === "index")
                                    $permission[$key_type][$key_controller]['report_store']["isLogin"] = true;

                                $permission[$key_type][$key_controller][$key_action]["isLogin"] = true;
                            }
                        } else {
                            if (isset($permission[$key_type][$key_controller][$key_action]["isLogin"])) {
                                if ($key_action === "edit" || ($key_controller === "report" and $key_action === "report_store"))
                                    continue;

                                if ($key_action === "update")
                                    $permission[$key_type][$key_controller]['edit']["isLogin"] = false;

                                if ($key_controller === "report" and $key_action === "index")
                                    $permission[$key_type][$key_controller]['report_store']["isLogin"] = false;

                                $permission[$key_type][$key_controller][$key_action]["isLogin"] = false;
                            }
                        }
                    }
                }
            }

            $permission = json_encode($permission);
            $result = $this->groupModal->update($name, $permission, $id_group);
            if ($result)
                MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-success-uid', 'value' => 'Cập nhật dữ liệu thành công'));
            else
                MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'Cập nhật dữ liệu không thành công'));
        }
    }
    public function delete()
    {
        $id_group = filter_input(INPUT_POST, 'remove_id_group', FILTER_SANITIZE_STRING);
        $result = $this->groupModal->delete($id_group);
        if ($result) {
            MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-success-uid', 'value' => 'Xóa dữ liệu thành công'));
            exit();
        }
        MyFunction::redirect("?controller=group&type=admin&action=index", array('name' => 'message-fail-uid', 'value' => 'Xóa dữ liệu không thành công'));
    }
}
