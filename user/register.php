<?php include "include_view.php";
  $names = $controller->toSchoolUnit->getAll();
  if(isset($_SESSION['userLogged']) && !empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/profile.php'</script>";
  }
?>
<div class="alert alert-danger alert-dismissible fade" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div id='register'>
  <div class="container-fluid center">
    <a href="../index.php"><img src="../images/logo.svg" class="logo"></a>
    <div class="panel panel-default">
      <div class="panel-body">
        <form id="newuserform" name="newuserform">
          <div class="mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="<?=$_SESSION['complete-name']?>">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="<?=$_SESSION['your-email']?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="<?=$_SESSION['your-passwd']?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="confirmpasswd" name="confirmpasswd" placeholder="<?=$_SESSION['confirm-passwd']?>">
          </div>
          <div class="mb-3">
            <select type="text" class="form-control" id="unit" name="unit">
                <option value="" selected disabled><?=$_SESSION['select-unit']?></option>
                <?php foreach($names as $value){?>
                  <option value='<?=$value['id_school_unit']?>'><?=$value['name']?></option>
                  <?php } ?>
            </select>
          </div>
          <button id="submit" type="button" class="btn btn-default btn-lg btn-orange "><?=$_SESSION['create-account']?></button>
        </form>
      </div>
    </div>
    <label><?=$_SESSION['already-account']?></label>
    <a class="text-orange" href="./login.php"><b><?=$_SESSION['signup']?></b></a>
  </div>
  <div class="signinlogo"></div>
</div>

<script type="text/javascript">
  $('#submit').click(function(){
    if($('#passwd').val() == $('#confirmpasswd').val()){
      $.ajax({
            url: "/user/actions.php?action=submitNewUser",
            type: 'POST',
            data: {
              name: $('#name').val(),
              email: $('#email').val(),
              passwd: $('#passwd').val(),
              confirmpasswd: $('#confirmpasswd').val(),
              unit: $('#unit').val(),
            },
            dataType: 'json',
        }).done(function(back) {
          if (back.error) {
                  alert(data.message)
                } else {
                  alert('Register');
                  window.location.href = "login.php";
                }
        });
    }else{
      $('.alert').alert()
    }
  });
</script>
