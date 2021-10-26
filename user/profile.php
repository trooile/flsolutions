<?php include "include_view.php";

$user = $controller->toUsers->getAll("id_school_unit=13")[0];
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];
?>
<body class="profile">
  <div id="logoprofile">
    <a href="/user/login.php"> <img src="/images/logo-bw.svg"></a>
  </div>
  <div class="profile">
    <div id="profile-img">
      <img src="/images/profile-img.svg">
    </div>
    <div class="dados">
      <label><?=$_SESSION['nameProfile']?></label>
      <div>
        <?=$user["name"]?>
      </div>
      <label><?=$_SESSION['email']?></label>
      <div>
        <?=$user["email"]?>
      </div>
      <label><?=$_SESSION['college']?></label>
      <div>
        <?=$school["name"]?>
      </div>
    </div>

  </div>
</body>