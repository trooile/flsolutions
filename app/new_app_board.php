<?php 
 session_start();
 include "include_view.php";
if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
}
    $user = $controller->toUsers->getAll('id_users ='.$_SESSION['userLogged']);
    $unit = $controller->toSchoolUnit->getAll('id_school_unit ='.$user[0]['id_school_unit']);
    $course = !empty($user[0]['id_courses']) ? $controller->toCourses->getAll('id_courses ='.$user[0]['id_courses']):null;
    $users = $controller->toUsers->getAll('id_school_unit = '.$user[0]['id_school_unit'].' AND id_courses ='.$user[0]['id_courses']);
    $list_users = !empty($users) ? $users:null;
    include_once "../includes/menu.php";
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
                </div><br>
                <input type="hidden" id="id_app_board" name="id_app_board">
                <label class="control-label col-sm-3"><?=$_SESSION['usersame']?>:</label>
                <div class="col-sm-12">
                    <select type="text" class="form-control" id="users" name="id_user" multiple>
                    <?php foreach($list_users as $value){?>
                        <option value="<?=$value['id_users']?>"
                        <?php if($value['id_users'] == $_SESSION['userLogged']){
                                echo 'selected>'.$_SESSION['onlyme'];
                            }else{
                                echo '>'. $value['name'];
                            } ?>
                        </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <button type="button" id="submit" class="btn btn-default btn-lg btn-orange"><?=$_SESSION['save']?></button><br><br>
    <a href="../user/home.php"><button type="button" class="btn btn-orange btn-sm"><?=$_SESSION['cancel']?></button></a>
</div>


<script type="text/javascript">
    $(function(){
        $('#users').select2();
    })
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
                alert(back.message);
            } else {
                window.location.href = "../user/home.php?createdBoard";
            }
        });
    });

    <?php if(isset($_REQUEST['editBoard'])){ ?>
        $.ajax({
            type: "POST",
            url: "/app/actions.php?action=searchBoard",
            data: {id_app_board: <?=$_REQUEST['editBoard']?>},
            dataType: "json",
        }).done(function(back){
            if(back.error){
                alert(back.message)
            }else{
                var boardID = back.data.board;
                var usersID = back.data.users;
                $('#name').val(boardID.name);
                $('#id_app_board').val(boardID.id_app_board);
                $.each(usersID, function (key, value) { 
                    $("#users option").val(value.id_users).select2()
                });
            }
        });
    <?php } ?>

</script>