<?php
include "include_view.php";
$nome = $_REQUEST["name"];
$email = $_REQUEST["email"];
if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
  }
$controller->toUsers->update(["name"=>"$nome","email"=>"$email"],"id_users=".$_SESSION['userLogged']);
?>
<meta http-equiv="Refresh" content="0; /user/profile.php">" />
