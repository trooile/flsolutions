<?php 
session_start();
include "include_view.php";
?>

<body class="settings" id="settings">
    <div class="container" id="settings">
        <a class="offset-sm-2" id="settings" href="/user/profile_cadastro.php"><button type="button" id="btnsettings" class="btn btn-default btn-orange"><?= $_SESSION['changeprofile']?></button></a>
        <a class="offset-sm-2" id="settings" href="/user/changepassword.php"><button type="button" id="btnsettings" class="btn btn-default btn-orange"><?= $_SESSION['security']?></button></a>
    </div>
</body>