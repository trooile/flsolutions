<?php include "include_view.php"; ?>
<body class="indexbody">
  <div class="container-fluid">
    <img src="./images/logo.svg" class="logo">
    <a type="button" class="btn btn-default btn-orange" href="./user/login.php"><?php echo $_SESSION['login'];?></a>
  </div>
  <br><br><br>
  <div  class="index-text">
    <label><b><?php echo $_SESSION['text-index']; ?></b></label>
  </div>
  <br><br><br>
  <div style="margin-left:35px!important;">
    <label for="signup"><?php echo $_SESSION['signup1'];?></label>
    <a class="text-orange" href="./user/register.php"><b><?php echo $_SESSION['register'];?></b></a>
  </div>
</body>