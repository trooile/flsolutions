<?php include "include_view.php"; ?>

<div class="container-fluid" style="text-align:center;">
  <a href="../index.php"><img src="../images/logo.svg" class="logo"></a>
  <div class="panel panel-default" style="margin:auto;width:50%;border:3px;padding:10px;">
    <div class="panel-body">
    <form>
        <div class="mb-3">
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['your-email'];?>">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="passwd" placeholder="<?php echo $_SESSION['your-passwd'];?>">
        </div>
        <button type="submit" class="btn btn-default btn-lg btn-orange"><?php echo $_SESSION['login'];?></button>
      </form>
    </div>
  </div>
  <label for="signup"><?php echo $_SESSION['signup1'];?></label>
  <a class="text-orange" id="signup" href="register.php"><b><?php echo $_SESSION['register'];?></b></a>
</div>
<div class="loginlogo"></div>
<script>
grecaptcha.enterprise.ready(function() {
    grecaptcha.enterprise.execute('6Lcwm4kcAAAAAJDchOGVncUglJZqxgYFBCsa9EAA', {action: 'login'}).then(function(token) {
       ...
    });
});
</script>