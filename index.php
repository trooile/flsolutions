<?php include "include_view.php"; ?>
<body class="indexbody">
  <div class="container-fluid">
    <img src="./images/logo.svg" class="logo">
    <a type="button" class="btn btn-default btn-orange" href="./user/login.php"><?=$_SESSION['login']?></a>
  </div>
  <br><br><br>
  <div  class="index-text">
    <label><b><?=$_SESSION['text-index']?></b></label>
  </div>
  <br><br><br>
  <div style="margin-left:35px!important;">
    <label for="signup"><?=$_SESSION['signup1']?></label>
    <a class="text-orange" href="./user/register.php"><b><?=$_SESSION['register']?></b></a>
  </div>
</body>
<!- 35.199.109.22 ->
<?=gethostname()?>
