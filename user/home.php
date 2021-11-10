<?php
session_start();
include "include_view.php";
?>

<body class="home" id="settings">
    <div class="container" id="home">
        <a class="offset-sm-2" id="home" href="/user/profile.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['profile'] ?></button></a>
        <a class="offset-sm-2" id="home" href="../app/new_app_board.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['studyplan'] ?></button></a>
        <a class="offset-sm-2" id="home" href="../app/app_board.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['board'] ?></button></a>
        <a class="offset-sm-2" id="home" href="https://scholar.google.com.br" target="_blank"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['Google Scholar'] ?></button></a>
    </div>
</body>