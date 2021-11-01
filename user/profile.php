<?php include "include_view.php";
$user = isset($_SESSION['userLogged']) ? $_SESSION['userLogged'] : 1;
$user = $controller->toUsers->getAll("id_users =" . $user)[0];
$school = $controller->toSchoolUnit->getAll('id_school_unit = ' . $user["id_school_unit"])[0];
$unit = $controller->toSchoolUnit->getAll();
$courses = $controller->toCourses->getAll("id_courses=13")[0];
?>

<body class="profile">


  <div class="container" id="profile">
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
        <p id="profile"><?= $user["name"] ?></p>
      </div>
      <div class="col" id="profile">
        <br><br><a id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-lg btn-orange"> Alterar</button></a>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['email'] ?></label><br>
        <p id="profile"><?= $user["email"] ?></p>
      </div>
      <div class="col" id="profile">
        <br><br><a class="offset-sm" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-lg btn-orange"> Alterar</button></a>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['college'] ?></label> <br>
        <p id="profile"><?= $school["name"] ?></p>
      </div>
      <div class="col" id="profile">
        <br><br><a class="offset-sm" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-lg btn-orange"> Alterar</button></a>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
        <p id="profile"><?= $user["name"] ?></p>
      </div>
      <div class="col" id="profile">
        <br><br><a class="offset-sm" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-lg btn-orange"> Alterar</button></a>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
        <p id="profile"><?= $user["name"] ?></p>
      </div>
      <div class="col" id="profile">
        <br><br><a class="offset-sm" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-lg btn-orange"> Alterar</button></a>
      </div>
    </div>
  </div>
</body>