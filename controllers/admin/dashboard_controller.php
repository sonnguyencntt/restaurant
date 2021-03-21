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
        MyFunction::loadModule("models.Product");
        MyFunction::loadModule("models.Company");
        MyFunction::loadModule("models.Order");

        $this->productModal = new Product();
        $this->companyModal = new Company();
        $this->orderModal = new Order();
    }

    public function index()
    {
        $count_User = $this->userModal->count();
        $count_Product = $this->productModal->count();
        $count_Company = $this->companyModal->count();
        $count_Order = $this->orderModal->count();



        $this->render(
            'dashboard.index',
            array(
                'title_content' => ucfirst($GLOBALS['CONTROLLER']),
                'count_user' => $count_User,
                'count_product' => $count_Product,
                'count_company' => $count_Company,
                'count_order' => $count_Order,
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
