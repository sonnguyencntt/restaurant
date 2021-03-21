<div style=" 
    color: red;
    display: flex;
    margin: auto;">
<h1 style="color : red ; margin : auto;text-transform: uppercase;"><strong><?php 
    if(isset($_SESSION['message-fail-access'])){
       echo  ucfirst(MyFunction::get_message('message-fail-access'));
    }
    ?></strong></h1>
</div>