<?php 
session_start();
include "include_view.php";
/*
$user = $controller->toUsers->getAll("id_school_unit=13")[0]; //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado //Pode remover o último colchete para puxar tudo
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];
// $names = $controller->toUsers->insert(["name"=>"Augusto","email"=>"augusto.cardone@fatec.sp.gov.br","id_school_unit"=>"12"]); //(["nome"=>"Augusto","lastname"=>"Cardone"])
*/
if (!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])) {
    echo "<script>window.location='/user/login.php'</script>";
}
$schools = $controller->toSchoolUnit->getAll();
$courses = $controller->toCourses->getAll();
$user = $_SESSION['userLogged'];
$user = $controller->toUsers->getAll("id_users =" . $user)[0];
$school = $controller->toSchoolUnit->getAll('id_school_unit = ' . $user["id_school_unit"])[0];
$course_exists = $controller->toCourses->getAll("id_courses=" . $user["id_courses"]);
$course_name = !empty($course_exists) ? $course_exists[0]['name']: $_SESSION['notregistered'];
$course_id = !empty($course_exists) ? $course_exists[0]['id_courses']: 0;
?>

<body class="profile">
    <form id="formprofile" method="POST" action="/user/profile_cadastro_update.php">
        <div class="container" id="profile">
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="profile">
                    <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
                    <input id="profile" type="text" name="name" class="form-control" placeholder="<?= $user["name"] ?>" value="<?= $user["name"] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="profile">
                    <label><?= $_SESSION['email']; ?></label><br>
                    <input id="profile" type="text" name="email" class="form-control" placeholder="<?= $user["email"] ?>" value="<?= $user["email"] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="profile">
                    <label id="profile"><?= $_SESSION['college'] ?></label><br>
                    <select id="profile" type="text" class="form-control" id="school" name="school">
                        <option value="<?= $school["id_school_unit"] ?>" selected><?= $school["name"] ?></option>
                        <?php foreach ($schools as $value) { ?>
                            <option value='<?= $value['id_school_unit'] ?>'><?= $value['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="profile">
                    <label id="profile"><?= $_SESSION['course'] ?></label><br>
                    <select id="profile" type="text" class="form-control" id="course" name="course">
                        <option value="<?= $course_id ?>" selected><?= $course_name ?></option>
                        <?php foreach ($courses as $value) { ?>
                            <option value='<?= $value['id_courses'] ?>'><?= $value['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="profile">
                    <br><input id="btnProfile" type="submit" value="<?= $_SESSION['save']?>" class="btn btn-default btn-orange offset-sm-2" />
                </div>
            </div>
        </div>
    </form>
</body>