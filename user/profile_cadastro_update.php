<?php
include "include_view.php";
$nome = $_REQUEST["name"];
$email = $_REQUEST["email"];
$controller->toUsers->update(["name"=>"$nome","email"=>"$email"],"id_users=4");


?>
<meta http-equiv="Refresh" content="0; /user/profile.php">" />
