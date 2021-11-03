<?php include "include_view.php";
//   if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
//     echo "<script>window.location='/user/login.php'</script>";
//   }
$_SESSION['userLogged'] = 1;
    $user = $controller->toUsers->getAll('id_users ='.$_SESSION['userLogged']);
    $unit = $controller->toSchoolUnit->getAll('id_school_unit ='.$user[0]['id_school_unit']);
    $users = $controller->toUsers->getAll('id_school_unit = '.$user[0]['id_school_unit']);
?>

<div class="jumbotron">
    <div class="container" style=" text-align: center;">
        <form id="newAppBoard">
            <div class="form-group col-xs-4">
                <input type="text" value="<?=$unit[0]['name']?>" disabled>
                <input id="id_school_unit" type="hidden" value="<?=$unit[0]['id_school_unit']?>">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

</script>