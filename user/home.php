<?php
session_start();
include "include_view.php";
$user_boards = $controller->toUserXBoard->getAll('id_users ='.$_SESSION['userLogged']);
$boards = [];
foreach($user_boards as $value){
    $data =  $controller->toAppBoard->getAll('id_app_board ='.$value['id_app_board']);
    if(!empty($data)){
        $boards[] = $data[0];
    }
}
?>

<body class="home" id="settings">
    <div class="container" id="home">
        <a class="offset-sm-2" id="home" href="/user/profile.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['profile'] ?></button></a>
        <a class="offset-sm-2" id="home" href="../app/new_app_board.php"><button type="button" id="btnhome" class="btn btn-default btn-orange"><?= $_SESSION['studyplan'] ?></button></a>
        <a class="offset-sm-2" data-toggle="modal" data-target="#modalBoards"><button type="button" id='openModal' class="btn btn-default btn-orange"><?= $_SESSION['board']?></button></a>
        <a class="offset-sm-2" data-toggle="modal" data-target="#modalGoogle"><button type="button"class="btn btn-default btn-orange"><?= $_SESSION['Google Scholar'] ?></button></a>
    </div>
</body> 

<div class="modal fade" id="modalBoards" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <h2><?=$_SESSION['selectboard']?></h2>
                </div>
            </div>
            <div class="modal-body">
                <?php if(!empty($boards)){
                        foreach($boards as $value){?>
                        <div class="btn-group col-md-12" role="group">
                            <div class="col-md-11">
                                <a class="offset-sm-2" href="/app/app_board.php?id_app_board=<?=$value['id_app_board']?>"><button type="button" class="btn btn-default btn-block btn-orange"><?=$value['name']?> ►</button></a>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-default" onclick="removeBoard(<?=$value['id_app_board']?>)" title="Remove"><img src="../images/Red_x.svg" style=" max-width:30px;max-height:30px;width:auto;height:auto;"></button><br>
                            </div>
                        </div>
                <?php } 
                }else{?>
                    <a class="offset-sm-2" href="/app/new_app_board.php"><button type="button" class="btn btn-default btn-block btn-green"><?= $_SESSION['createnewboard']?> ►</button></a><br>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGoogle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <img src="../images/googleandfl.gif" alt="this slowpoke moves"  width="100%" />
            <script async src="https://cse.google.com/cse.js?cx=837cdbb2a36a17c30"></script>
            <div class="gcse-search"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        <?php if (isset($_REQUEST['createdBoard'])){?>
            $('#openModal').click();
        <?php } ?>
    });

    function removeBoard(id){
      $.ajax({
          type: "POST",
          url: "/user/actions.php?action=deleteBoard",
          data: {id_app_board: id},
          dataType: "json",
      }).done(function(){
        location.reload();
      })
  }
</script>
