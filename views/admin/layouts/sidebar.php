<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <?php 
        // var_dump($userGroup);
        $list = MyFunction::listMenu();
        foreach($list as $data)
        {
            $arr = array("?controller=" => "", "&action=" => "_","&type=" => "_");
            
            $stringUrl = explode("_",strtr($data['href'] , $arr));
            if((isset($userGroup[$stringUrl[2]][$stringUrl[0]][$stringUrl[1]]['isLogin']) and $userGroup[$stringUrl[2]][$stringUrl[0]][$stringUrl[1]]['isLogin']) or $data['name'] == "logout" or !isset($userGroup[$stringUrl[2]][$stringUrl[0]][$stringUrl[1]]['isLogin']))
            {
                $name = ucfirst($data['name']);
               
                $active = null;
                if($stringUrl[0] == $GLOBALS['CONTROLLER'])
                {
                    $active = 'active';
                }
                if($data['level'] == 1)
                {
                    
                    echo '
                    <li id="'.$data['id'].'" class = "'.$active.'">
                    <a href="'.$data['href'].'">
                         <i class="'.$data['icon'].'"></i> <span>'.$name.'</span>
                    </a>
                </li>
                    ';
                }
                else
                {
    
                    echo '<li class="treeview '.$active.'" id="userMainNav" >
                    <a href="#">
                        <i class="'.$data['icon'].'"></i>
                        <span>'.$name.'</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">';
                       foreach((array)$data['page'] as  $page)
                       {
                           $active = null;
                           $insert = null;
                        if(isset($userGroup[$stringUrl[2]][$stringUrl[0]]['insert'])
                        and $page['name'] == 'create' and !$userGroup[$stringUrl[2]][$stringUrl[0]]['insert']['isLogin']){
                            $insert = 'hide-elm';
                        }
                        if($page['action'] == $GLOBALS['ACTION'] and $stringUrl[0] == $GLOBALS['CONTROLLER'])
                        {
                            $active = 'active';
                        }
                        $pageName = ucfirst($page['name']);
    
                        echo '<li id="createUserSubNav" class = "'.$active.' '.$insert.'"><a href="'.$page['href'].'"><i class="fa fa-circle-o"></i>'.$pageName.'</a></li>';
                       }
                   echo '</ul>
                </li>';
                } 
            }
        
        }
        
        ?>

           

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>