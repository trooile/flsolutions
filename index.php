<?php include "include_view.php"; ?>

<body background="./images/background.png" style="background-size:100%;">
  <div class="container-fluid">
    <img src="./images/logo.png" class="w-15 p-3">
    <a type="button" class="btn btn-default btn-orange" href="./user/login.php"><?php echo $_SESSION['login'];?></a>
  </div>
  <br><br><br>
  <div class="container-fluid md-40" style="font-size:28px;margin-left:35px!important;">
    <label><b><?php echo $_SESSION['text-index']; ?></b></label>
  </div>
  <br><br><br>
  <div class="container-fluid" style="margin-left:35px!important;">
    <label for="signup"><?php echo $_SESSION['signup'];?></label>
    <a class="text-orange" href="./user/register.php"><b><?php echo $_SESSION['register'];?></b></a>
  </div>
 </body>
 <?php include_once "./includes/footer.php"; ?>

