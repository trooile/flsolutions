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
            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $_SESSION['complete-name'];?>">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['your-email'];?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="<?php echo $_SESSION['your-passwd'];?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="confirmpasswd" name="confirmpasswd" placeholder="<?php echo $_SESSION['confirm-passwd'];?>">
          </div>
          <div class="mb-3">
            <select type="text" class="form-control" id="unit" name="unit">
                <option value="" selected disabled><?php echo $_SESSION['select-unit'];?></option>
                <?php foreach($names as $value){?>
                  <option value='<?php echo $value['id_school_unit'] ?>'><?php echo $value['name'] ?></option>
                  <?php } ?>
            </select>
          </div>
          <button id="submit" type="button" class="btn btn-default btn-lg btn-orange "><?php echo $_SESSION['create-account'];?></button>
        </form>
      </div>
    </div>
    <label><?php echo $_SESSION['already-account'];?></label>
    <a class="text-orange" href="./login.php"><b><?php echo $_SESSION['signup'];?></b></a>
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
    alert('<?php echo $_SESSION['invalidpasswd']; ?>')
  }
})
</script>