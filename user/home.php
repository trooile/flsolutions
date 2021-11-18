<?php
session_start();
include "include_view.php";
$user_boards = $controller->toUserXBoard->getAll('id_users ='.$_SESSION['userLogged']);
$boards = [];
foreach($user_boards as $value){
    $boards[] = $controller->toAppBoard->getAll('id_app_board ='.$value['id_app_board'])[0];
}
?>

<body class="home" id="settings">
    <div class="container" id="home">
        <a class="offset-sm-2" id="home" href="/user/profile.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['profile'] ?></button></a>
        <a class="offset-sm-2" id="home" href="../app/new_app_board.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['studyplan'] ?></button></a>
        <a class="offset-sm-2" data-toggle="modal" data-target="#modalBoards"><button type="button" class="btn btn-default btn-orange"><?= $_SESSION['board']?></button></a>
        <a class="offset-sm-2" id="home" href="https://scholar.google.com.br" target="_blank"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['Google Scholar'] ?></button></a>
    </div>
</body> 

<div class="modal fade" id="modalBoards" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php foreach($boards as $value){?>
                    <a class="offset-sm-2" href="/app/app_board.php?id_app_board=<?=$value['id_app_board']?>"><button type="button" class="btn btn-default btn-block btn-orange"><?=$value['name']?> ►</button></a><br>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
