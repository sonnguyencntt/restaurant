<?php
MyFunction::loadModule('controllers.base_controller');

class DashboardController extends BaseController
{

    function __construct($actionId = 1)
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
        $this->pageId = 1;
        $this->actionId = $actionId;
        MyFunction::loadModule("models.Store");
        MyFunction::loadModule("models.Company");
        MyFunction::loadModule("models.Category");
        MyFunction::loadModule("models.Product");



        $this->storeModal = new Store();
        $this->companyModal = new Company();
        $this->categoryModal = new Category();
        $this->ProductModal = new Product();


    }

    public function index()
    {
     
        $count_User = $this->userModal->count();
        $count_Store = $this->storeModal->count();
        $count_Product = $this->ProductModal->count();
        $count_Category = $this->categoryModal->count();



        $this->render(
            'dashboard.index',
            array(
                'title_content' => ucfirst($GLOBALS['CONTROLLER']),
                'count_user' => $count_User,
                'count_store' => $count_Store,
                'count_product' =>$count_Product,
                'count_order' => $count_Category,
                'userGroup' => $this->userGroup,
            ),
            'layouts.application'
        );
    }

    public function error()
    {
        echo "error admin";
    }
}
