<?php 
 session_start();
 include "include_view.php";
if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
  echo "<script>window.location='/user/login.php'</script>";
}
    $user = $controller->toUsers->getAll('id_users ='.$_SESSION['userLogged']);
    $unit = $controller->toSchoolUnit->getAll('id_school_unit ='.$user[0]['id_school_unit']);
    $course = !empty($user[0]['id_courses']) ? $controller->toCourses->getAll('id_courses ='.$user[0]['id_courses']):null;
    $users = $controller->toUsers->getAll('id_school_unit = '.$user[0]['id_school_unit']);
?>

<div class="container-fluid class_form">
    <div class="jumbotron">
        <form class="form-horizontal" role="form" id='formBoard' name='formBoard'>
            <div class="form-group">
                <label class="control-label col-sm-3"><?=$_SESSION['course']?>:</label>
                <div class="col-sm-12">
                    <input type='text' class='form-control' value="<?=$unit[0]['name']?>" disabled>
                    <input class="form-control" id="id_school_unit" name="id_school_unit" type="hidden" value="<?=$unit[0]['id_school_unit']?>">
                </div><br>
                <label class="control-label col-sm-3"><?=$_SESSION['nameProfile']?></label>
                <div class="col-sm-12">
                    <input type='text' name='name' id='name' class='form-control' placeholder="<?=$_SESSION['nameboard']?>">
                </div>
            </div>
        </form>
        <button type="button" id="submit" class="btn btn-default btn-lg btn-orange"><?=$_SESSION['save']?></button>
    </div>
</div>


<script type="text/javascript">
  $('#submit').click(function(){
      var formData = $('#formBoard').serializeArray();
    $.ajax({
          url: "/app/actions.php?action=addBoard",
          type: "POST",
          data: {
            formdata: formData
          },
          dataType: "json",
      }).done(function(back) {
        if (back.error) {
            $('#modalAlert .modal-body').html(back.message);
            $('#modalAlert').modal('toggle');
        } else {
            $('#modalAlert .modal-body').html(<?=$_SESSION['success']?>);
            $('#modalAlert').modal('toggle');
        }
      });
  });
</script>