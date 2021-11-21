<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js'></script>
	<script type='text/javascript' src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js"></script>
	<!-- <link rel="stylesheet" href="../includes/java/jquery/jquery-ui.css"> -->
	<script src="../includes/java/jquery/jquery-ui.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.typekit.net/eda6dmy.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link href="../includes/style.css" rel="stylesheet">
	<script src="../includes/java/loadingoverlay.min.js"></script>
	<title>College Tool</title>
	<link rel="stylesheet" href="../includes/java/jqwidgets/styles/jqx.base.css" type="text/css" />
	<script type="text/javascript" src="../includes/java/scripts/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../includes/java/jqwidgets/jqxcore.js"></script>
	<script type="text/javascript" src="../includes/java/jqwidgets/jqxsortable.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript" src="../includes/java/jqwidgets/jqxkanban.js"></script>
	<script type="text/javascript" src="../includes/java/jqwidgets/jqxdata.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700,800,900" rel="stylesheet">
	<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
</head>
<?php 
$app = isset($_REQUEST['id_app_board']) ? $_REQUEST['id_app_board']: 0;
if($_SERVER['REQUEST_URI'] != '/app/app_board.php?id_app_board='.$app){?>
	<a href="?language=en-us.php"><img src="../images/us.svg" width="25" height="20"></a>
	<a href="?language=pt-br.php"><img src="../images/br.svg" width="30" height="20"></a>
<?php
}
if ($_SERVER['REQUEST_URI'] == '/user/profile.php?language=pt-br.php' ||
	$_SERVER['REQUEST_URI'] == '/user/profile_cadastro.php?language=pt-br.php' ||
	$_SERVER['REQUEST_URI'] == '/user/profile.php?language=en-us.php' ||
	$_SERVER['REQUEST_URI'] == '/user/profile_cadastro.php?language=en-us.php' ||
	$_SERVER['REQUEST_URI'] == '/user/profile.php' ||
	$_SERVER['REQUEST_URI'] == '/user/profile_cadastro.php'||
	$_SERVER['REQUEST_URI'] == '/user/settings.php?language=en-us.php'||
	$_SERVER['REQUEST_URI'] == '/user/settings.php?language=pt-br.php'||
	$_SERVER['REQUEST_URI'] == '/user/settings.php' ||
	$_SERVER['REQUEST_URI'] == '/user/changepassword.php' ||
	$_SERVER['REQUEST_URI'] == '/user/changepassword.php?language=en-us.php'||
	$_SERVER['REQUEST_URI'] == '/user/changepassword.php?language=pt-br.php'||
	$_SERVER['REQUEST_URI'] == '/user/home.php' ||
	$_SERVER['REQUEST_URI'] == '/user/home.php?language=en-us.php' ||
	$_SERVER['REQUEST_URI'] == '/user/home.php?language=pt-br.php'

) {
	include "menu.php";
}

include_once "footer.php"; ?>