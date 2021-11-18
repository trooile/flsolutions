<?php
include './includes/include.php';
if(!isset($_SESSION['language'])){
	$_SESSION['language'] = 'en-us.php';
	include './languages/en-us.php';
}else if(isset($_GET['language'])){
	include './languages/'.$_GET['language'];
	$_SESSION['language'] = $_GET['language'];
}

if(isset($_SESSION['userLogged']) && !empty($_SESSION['userLogged'])){
	echo "<script>window.location='/user/home.php'</script>";
}
?>
