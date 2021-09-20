<?php include "../includes/include_view.php" ?>

<div class="container-fluid" style="text-align:center;">
  <a href="../index.php"><img src="../images/logo.png" class="w-15 p-3"></a>
  <div class="panel panel-default" style="margin:auto;width:50%;border:3px;padding:10px;">
    <div class="panel-body">
    <form>
        <div class="mb-3">
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Your email address">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="passwd" placeholder="Your password">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="robot">
          <label class="form-check-label" for="robot">I'm not a robot.</label>
        </div>
        <button type="submit" class="btn btn-default btn-lg btn-orange ">Log in</button>
      </form>
    </div>
  </div>
  <label>Don't have an account?</label><br>
  <a class="text-orange" href="./register.php"><b>Register</b></a>
</div>
<img src="../images/login-background.png" class="w-15 p-3" style="float:right">
<?php include_once "../includes/footer.php" ?>
