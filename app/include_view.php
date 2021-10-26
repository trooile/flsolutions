<?php
  include '../includes/include.php';
  include __DIR__."/controller.php";
  $controller = new Controller(); 
  if(!isset($_SESSION['language'])){
    $_SESSION['language'] = 'en-us.php';
    include '../languages/en-us.php';
    }else if(isset($_GET['language'])){
    include '../languages/'.$_GET['language'];
    $_SESSION['language'] = $_GET['language'];
    }
        
?>