<?php include "include_view.php";
  $names = $controller->toSchoolUnit->getAll();
?>

<div id='register'>
  <div class="container-fluid center">
    <a href="../index.php"><img src="../images/logo.svg" class="logo"></a>
    <div class="panel panel-default">
      <div class="panel-body">
        <form id="newuserform">
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
      var formdata = $('#newuserform').serializeArray();
      $.ajax({
            url: "/user/actions.php?action=submitNewUser",
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
    }else{
      alert('<?=$_SESSION['invalidpasswd']?>')
    }
  });
</script>
