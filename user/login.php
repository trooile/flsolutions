<?php include "include_view.php"; ?>

<div class="container-fluid center">
  <a href="../index.php"><img src="../images/logo.svg" class="logo"></a>
  <div class="panel panel-default">
    <div class="panel-body">
    <form id="formLogin">
        <div class="mb-3">
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="<?=$_SESSION['your-email']?>">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="passwd" name="passwd" placeholder="<?=$_SESSION['your-passwd']?>">
        </div>
        <button type="button" id="submit" class="btn btn-default btn-lg btn-orange"><?=$_SESSION['login']?></button>
      </form>
    </div>
  </div>
  <label for="signup"><?=$_SESSION['signup1']?></label>
  <a class="text-orange" id="signup" href="register.php"><b><?=$_SESSION['register']?></b></a>
</div>
<div class="loginlogo"></div>
<script type="text/javascript">
  $('#submit').click(function(){
      var formdata = $('#formLogin').serializeArray();
      $.ajax({
            url: "/user/actions.php?action=login",
            type: 'POST',
            data: formdata,
            dataType: 'json',
        }).done(function(back) {
          if (back.error) {
                  alert(data.message)
                } else {
                  alert('OK');
                }
        });
  });
</script>
