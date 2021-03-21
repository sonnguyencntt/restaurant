<?php
    MyFunction::loadModule('controllers.base_controller');

    class ReportController extends BaseController {

        
        function __construct($actionId=1)
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
            MyFunction::loadModule("models.Order");
            $this->orderModal = new Order();
            $this->folder = 'admin';
            $this->pageId = 1;
            $this->actionId = $actionId;

        }

        public function index(){

            $id_store_search= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
            $date_search= filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);


            $resultForChart = array();
            $resultForSelectStore = array();
            $resultForDateTime = array();
            $resultForDataFromYear = array();
            $getDateOfWeek = MyFunction::getDateOfWeek();
            $sumTotalForDateTime = $this->orderModal->sumTotalForDateTime($getDateOfWeek[0] , $getDateOfWeek[6]);
            foreach($getDateOfWeek as $key => $value)
            {
                foreach($sumTotalForDateTime as $_value)
                {
                    if($value == $_value['date_time'])
                    {
                        $resultForChart[$key] = $_value['sum'];
                        break;
                    }
                    $resultForChart[$key] = null;
                }
                
            }
            $selectIdStore = $this->orderModal->selectIdStore();
            if(isset($id_store_search) and isset($date_search))
            {
                $id_store = $id_store_search;
                $date = $date_search;
            }
            else
            {
                // if(isset($selectIdStore[0]->store->id_store))
                // $id_store = $selectIdStore[0]->store->id_store;
                // else 
                // $id_store = null;
                // if(isset($selectIdStore[0]->store->id_store))

            }
            if(isset($selectIdStore[0]->store->id_store))
            $selectDateForStore = $this->orderModal->selectDateForStore($selectIdStore[0]->store->id_store);
            else
            $selectDateForStore = null;

            if(isset($selectDateForStore[0]) and isset($selectIdStore[0]->store->id_store))
            $selectDataFromYear = $this->orderModal->selectDataFromYear($selectDateForStore[0] ,$selectIdStore[0]->store->id_store );
            else
            $selectDataFromYear = null;


            $resultForSelectStore = $selectIdStore;
            $resultForDateTime = $selectDateForStore;
            // $resultForDataFromYear = $selectDataFromYear;
            $count = 1;
            while($count < 13)
            {
                if($selectDataFromYear == null)
                {
                    $resultForDataFromYear  = $selectDataFromYear;
                    break;
                }
              
                foreach($selectDataFromYear as $value){
                    if($count == intval(date("m" , strtotime($value['date_time']))))
                    {
                       $resultForDataFromYear[$count] = ['date_time' =>date("m-Y" , strtotime($value['date_time'])) , 'sum' => $value['sum']];
                        break;
                    }
                    if($count < 10)
                    $datetime = "0".$count;
                    $resultForDataFromYear[$count] = ['date_time' =>$datetime."-".$selectDateForStore[0] , 'sum' => 0];

                }
                $count += 1;
            }

            
            $this->render('report.index',array('title_content'=>ucfirst($GLOBALS['ACTION']),'userGroup' => $this->userGroup , 
            'resultForChart' => $resultForChart,
            'resultForSelectStore' => $resultForSelectStore,
            'resultForDateTime' => $resultForDateTime,
            'resultForDataFromYear' => $resultForDataFromYear


        ),'layouts.application');
        }
        public function selectdate()
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $result =  $this->orderModal->selectDateForStore($id);
            if(count($result) <= 0)
            MyFunction::send($result, false, "Không có dữ liệu");
            else
            MyFunction::send($result, true, "Thành công");

        }
        public function search()
        {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
            $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);

        }
        public function error(){
            echo "error admin";
        }
    }
