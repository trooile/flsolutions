<?php
session_start();
include "include_view.php";
$nome = $_REQUEST["name"];
$email = $_REQUEST["email"];
$course = $_REQUEST["course"];
$school = $_REQUEST["school"];

if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
  }
$data = [ "name"          => $nome,
          "email"         => $email,
          "id_school_unit"=> $school];
if($course != 0){
  $data['id_courses'] = $course;
}
$controller->toUsers->update($data,"id_users=".$_SESSION['userLogged']);

?>
<meta http-equiv="Refresh" content="0; /user/profile.php">" />
