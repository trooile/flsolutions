<?php 
session_start();
include "include_view.php";
if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
}
$id_course = '';
$course = $_SESSION['notregistered'];
$usersame = $controller->toUsers->getAll('id_courses = 0');
$user = $controller->toUsers->getAll('id_users ='.$_SESSION['userLogged']);
if(isset($user['id_courses'])){
    $courses = $controller->toCourses->getAll('id_courses ='.$user['id_courses']);
    if(!empty($courses)){
        $course = $courses[0]['name'];
        $id_course = $courses[0]['id_courses'];
        $usersame = $controller->toUsers->getAll('id_courses ='.$user['id_courses']);
    }
}
$board_name = $controller->toAppBoard->getAll('id_app_board ='.$_REQUEST['id_app_board'])[0]['name'];
?>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<a href="../user/home.php"><img src="../images/logo.svg" class="logo-black "></a>
<div class="title-giant">
    <label class='giant'><?=$_SESSION['studyplan']?></label>
</div>
<div role="alert" aria-live="assertive" style="position:relative;" id="toastCard" aria-atomic="true" class="toast hide" data-autohide="true">
    <div class="toast-header">
        <img src="../images/flsolutionsdx.svg" class="rounded mr-2" alt="5" style="width:12%;">
        <strong class="mr-auto"><?=$_SESSION['flsolutions']?></strong>
        <small>CollegeTool</small>
        <button type="button" class="ml-2 mb-1 close" id="close-toast" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        <?=$_SESSION['cardadded']?>!
    </div>
</div>
<button type="button" class="btn btn-orange btncard btn-sm"  data-toggle="modal" data-target="#modalCard"><?=$_SESSION['addcard']?></button>
<label class="app-name"><?=$_SESSION['board'] .': '. $board_name?><br>
<a href="../user/home.php"><button type="button" class="btn btn-orange btneditboard btn-sm"><?=$_SESSION['back']?></button></a>
</label>
<!-- MODAL CARD -->
<div class="modal fade" id="modalCard" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCard" class="form-inline">
                    <input type="hidden" name="id_app_board" value="<?=$_REQUEST['id_app_board']?>">
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="course"><?=$_SESSION['course']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text"  value="<?=$course?>" disabled>
                                <input type="hidden" name="course" id="course" value="<?=$id_course?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="semester"><?=$_SESSION['semester']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select type="text" class="form-control" id="semester" name="semester">
                                    <option value="1"><?=$_SESSION['first-semester']?></option>
                                    <option value="2"><?=$_SESSION['second-semester']?></option>
                                    <option value="3"><?=$_SESSION['third-semester']?></option>
                                    <option value="4"><?=$_SESSION['fourth-semester']?></option>
                                    <option value="5"><?=$_SESSION['fifth-semester']?></option>
                                    <option value="6"><?=$_SESSION['sixth-semester']?></option>
                                    <option value="7"><?=$_SESSION['seventh-semester']?></option>
                                    <option value="8"><?=$_SESSION['eighth-semester']?></option>
                                    <option value="9"><?=$_SESSION['ninth-semester']?></option>
                                    <option value="10"><?=$_SESSION['tenth-semester']?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="titleInput"><?=$_SESSION['matter']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" name="title" id="titleInput" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="descriptionInput"><?=$_SESSION['description']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" name="description" id="descriptionInput" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </form>
                <img src="../images/studyplan-background.svg" class="logo-white">
            </div>
            <div class="modal-footer" style="text-align:center;">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnAddNew"><?=$_SESSION['save']?></button>
            </div>
        </div>
    </div>
</div>
<div class="boards">
    <div class="container board">
        <h3 class="text-center"><?=$_SESSION['toDo']?></h3>
        <ul class="sortable connectedSortable dropzone" id="red">
        </ul>
    </div>
    <div class="container board">
        <h3 class="text-center"><?=$_SESSION['inprogress']?></h3>
        <ul class="sortable connectedSortable dropzone" id="yellow">
        </ul>
    </div>
    <div class="container board">
        <h3 class="text-center"><?=$_SESSION['done']?></h3>
        <ul class="sortable connectedSortable dropzone" id="green">
        </ul>
    </div>
</div>

<script type="text/javascript">
  $(function() {
    loadCards()
    $( ".sortable" ).sortable({
      connectWith: ".connectedSortable",
      receive: function( event, ui ) {
        console.log(event)
        updateCard(ui.item[0].value, event.target.id)
      }
    }).disableSelection();  
    $('#btnAddNew').click(function() {
        var card = $('#formCard').serializeArray();
        $.ajax({
          url: "/app/actions.php?action=saveCard",
          type: "POST",
          data: {
            card: card,
            id: <?=$_SESSION['userLogged']?>
          },
          dataType: "json",
      }).done(function(back) {
        if (back.error) {
            alert(back.message)
        } else {
            toggleAlertCard();
            location.reload();
        }
      });
    });  
  });

  function loadCards(){
    $.ajax({
            url: "/app/actions.php?action=searchCards",
            type: "POST",
            dataType: "json",
            data: {id_app_board: <?=$_REQUEST['id_app_board']?>}
        }).done(function(back) {
            var dataCards = back.data;
            $.each(dataCards, function (key, value) { 
                 if(value.position == 'red'){
                    $('#red').closest('div.container').find('ul').append('<li value="'+value.id_cards+'" class="card kanbanCard red"><h4>'+value.name+'</h4><br>'+value.description+'<br>'+value.semester+'° <?=$_SESSION['semester']?><button class="invisibleBtn"><span class="material-icons delete" onclick="deleteCard('+value.id_cards+')">remove_circle</span></button></li>');
                 }else if(value.position == 'yellow'){
                    $('#yellow').closest('div.container').find('ul').append('<li value="'+value.id_cards+'" class="card kanbanCard yellow"><h4>'+value.name+'</h4><br>'+value.description+'<br>'+value.semester+'° <?=$_SESSION['semester']?><button class="invisibleBtn"><span class="material-icons delete" onclick="deleteCard('+value.id_cards+')">remove_circle</span></button></li>');
                 }else{
                    $('#green').closest('div.container').find('ul').append('<li value="'+value.id_cards+'" class="card kanbanCard green"><h4>'+value.name+'</h4><br>'+value.description+'<br>'+value.semester+'° <?=$_SESSION['semester']?><button class="invisibleBtn"><span class="material-icons delete" onclick="deleteCard('+value.id_cards+')">remove_circle</span></button></li>');
                 }
            });
        });
  }
  
  function updateCard(id, position){
      $.ajax({
          type: "POST",
          url: "/app/actions.php?action=updatePosition",
          data: {id_cards: id,
                position: position,
                id: <?=$_SESSION['userLogged']?>},
          dataType: "json",
      }).done(function(back){
          if(back.error){
              alert(back.message)
          }else{
            location.reload();
          }
      })
  }

  function deleteCard(id){
      $.ajax({
          type: "POST",
          url: "/app/actions.php?action=deleteCard",
          data: {id_cards: id,
            id: <?=$_SESSION['userLogged']?>},
          dataType: "json",
      }).done(function(){
        location.reload();
      })
  }

function toggleAlertCard(){
    $("#toastCard").toggleClass('show hide');
    return false;
}

</script>    
