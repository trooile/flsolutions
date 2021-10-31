<?php include "include_view.php";
$user = isset($_SESSION['userLogged']) ? $_SESSION['userLogged'] : 1;
$user = $controller->toUsers->getAll("id_users =" . $user)[0];
$school = $controller->toSchoolUnit->getAll('id_school_unit = ' . $user["id_school_unit"])[0];
$unit = $controller->toSchoolUnit->getAll();
$courses = $controller->toCourses->getAll("id_courses=13")[0];
?>

<body class="profile">
    <div id="logoprofile">
        <a href="/user/login.php"> <img src="/images/logo-bw.svg"></a>
    </div>
    <div class="container" id="bodyprofile">    
            <div class="panel-body">
            </div>
            <form id="formprofile" method="POST" action="/user/profile_cadastro_update.php">
                <div class="mb-3">
                    <input type="text" class="form" id="nameprofile" name="nameprofile" placeholder="<?= $user["name"] ?>">
                </div>
                <div class="mb-3">
                    <input type="password" class="form" id="emailprofile" name="emailprofile" placeholder="<?= $user["email"] ?>">
                </div>
                <div class="mb-3">
                    <input type="password" class="form" id="courseprofile" name="courseprofile" placeholder="<?= $courses["name"] ?>">
                </div>
                <div class="mb-3">
                    <input type="password" class="form" id="semesterprofile" name="semesterprofile" placeholder="Semestre?">
                </div>
                <div class="mb-3">
                    <select type="text" class="form" id="unit" name="unit">
                        <option value="" selected disabled><?= $_SESSION['select-unit'] ?></option>
                        <?php foreach ($unit as $value) { ?>
                            <option value='<?= $value['id_school_unit'] ?>'><?= $value['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="button" id="changeprofile" class="btn btn-default btn-lg btn-orange">Alterar Dados</button>
            </form>
        </div>
    </div>