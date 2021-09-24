<?php
include './includes/include.php';
if(!isset($_SESSION['language'])){
  $_SESSION['language'] = 'en-us.php';
}else if(isset($_GET['language'])){
  include './languages/'.$_GET['language'];
  $_SESSION['language'] = $_GET['language'];
}?>
