<?php
    include __DIR__."/controller.php";   
    $controller = new Controller();
    $action = $_GET['action']; 
    if(is_callable([$controller, $action])){
        unset($_REQUEST['action']);
        $controller->$action($_REQUEST);
    }
?>
