<?php include "include_view.php"; ?>

<body background="./images/background.png" style="background-size:100%; background-repeat:repeat-x;">
  <div class="container-fluid">
    <img src="./images/logo.svg" class="w-15 p-3">
    <a type="button" class="btn btn-default btn-orange" href="./user/login.php"><?php echo $_SESSION['login'];?></a>
  </div>
  <br><br><br>
  <div  style="font-size:28px;margin-left:35px!important;">
    <label><b><?php echo $_SESSION['text-index']; ?></b></label>
  </div>
  <br><br><br>
  <div style="margin-left:35px!important;">
    <label for="signup"><?php echo $_SESSION['signup1'];?></label>
    <a class="text-orange" href="./user/register.php"><b><?php echo $_SESSION['register'];?></b></a>
  </div>
 </body>
 <?php include_once "./includes/footer.php"; ?>

