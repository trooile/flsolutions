<?php 
session_start();
include "include_view.php";
  if(isset($_SESSION['userLogged']) && !empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/home.php'</script>";
  }
?>
<div id="alert-success" class="alert alert-success alert-dismissible fade hide" role="alert">
  <strong><?=$_SESSION['success']?></strong> <?=$_SESSION['verify-success']?>
  <button type="button" class="close" id="close-modal-success" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div id="alert-error-login" class="alert alert-danger alert-dismissible fade hide" role="alert">
  <strong><?=$_SESSION['loginerror']?></strong> <?=$_SESSION['accounterror']?>
  <button type="button" class="close" id="close-modal-error" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

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
        <button type="button" id="login" class="btn btn-default btn-lg btn-orange"><?=$_SESSION['login']?></button>
      </form>
    </div>
  </div>
  <label for="signup"><?=$_SESSION['signup1']?></label>
  <a class="text-orange" id="signup" href="register.php"><b><?=$_SESSION['register']?></b></a>
</div>
<div class="loginlogo"></div>

<script type="text/javascript">
$(function(){
  <?php if (isset($_REQUEST['registerSucess'])){?>
    toggleAlertSuccess();
  <?php } ?>
  });
    $('#login').click(function(){
      $.ajax({
            url: "/user/actions.php?action=login",
            type: "POST",
            data: {
              email: $("#email").val(),
              passwd: $("#passwd").val(),
            },
            dataType: "json",
        }).done(function(back) {
          if (back.error) {
            toggleAlertError()
          } else {
            window.location.href = "profile.php";
          }
        });
    });

  $('#close-modal-success').click(function(){
    toggleAlertSuccess();
  });

  function toggleAlertSuccess(){
    $("#alert-success").toggleClass('show hide');
    return false;
  }

  $('#close-modal-error').click(function(){
    toggleAlertError();
  });

  function toggleAlertError(){
    $("#alert-error-login").toggleClass('show hide');
    return false;
  }

</script>