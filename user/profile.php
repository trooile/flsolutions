<?php 
session_start();
include "include_view.php";
if (!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])) {
  echo "<script>window.location='/user/login.php'</script>";
}
$user = isset($_SESSION['userLogged']) ? $_SESSION['userLogged'] : 1;
// $user = $_SESSION['userLogged'];  - retirar a linha de cima quando for para produção
$user = $controller->toUsers->getAll("id_users =" . $user)[0];
$school = $controller->toSchoolUnit->getAll('id_school_unit = ' . $user["id_school_unit"])[0];
$unit = $controller->toSchoolUnit->getAll();
$course_exists = $controller->toCourses->getAll("id_courses=" . $user["id_courses"]);
$course = !empty($course_exists) ? $course_exists[0]['name']: $_SESSION['notregistered'];
?>

<body class="profile">

  <div class="container" id="profile">
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
        <p id="profile"><?= $user["name"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['email'] ?></label><br>
        <p id="profile"><?= $user["email"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['college'] ?></label> <br>
        <p id="profile"><?= $school["name"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['course'] ?></label><br>
        <p id="profile"><?= $course ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <a class="offset-sm-2" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-orange"><?=$_SESSION['change']?></button></a>
      </div>
    </div>
  </div>
</body>
