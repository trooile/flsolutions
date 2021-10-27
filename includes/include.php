<!doctype html>
<html lang="en">
  <head>
  <title>College Tool</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../includes/java/jquery/jquery-ui.css">
	<link href="../includes/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js'></script>
	<script type='text/javascript' src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
	<script	src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js"></script>
	<script src="../includes/java/jquery/jquery-ui.js"></script>
	<?php
	if($_SERVER['REQUEST_URI'] == '/user/profile.php' ||  $_SERVER['REQUEST_URI'] == '/user/profile_cadastro.php'){
		include "../includes/menu.php";
	} 
	?>  
	<a href="?language=en-us.php"><img src="../images/us.svg" width="25" height="20"></a>
	<a href="?language=pt-br.php"><img src="../images/br.svg" width="30" height="20"></a>
</head>

<body>