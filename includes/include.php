<header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script type='text/javascript' src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script	src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js'></script>
<link rel="stylesheet" href="https://use.typekit.net/eda6dmy.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="../includes/style.css" rel="stylesheet">
<link rel="stylesheet" href="../includes/java/jquery/jquery-ui.css">
<script src="../includes/java/jquery/jquery-ui.js"></script>
<script src="../includes/java/loadingoverlay.min.js"></script>
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
<meta charset="utf-8">
<title><?=$_SESSION['header']?></title>
</header>
<a href="?language=en-us.php"><img src="../images/us.svg" width="25" height="20"></a>
<a href="?language=pt-br.php"><img src="../images/br.svg" width="30" height="20"></a>
<?php
if($_SERVER['REQUEST_URI'] == '/user/profile.php' ||  $_SERVER['REQUEST_URI'] == '/user/profile_cadastro.php'){
	include_once "menu.php";
} 
include_once "footer.php"; ?>


