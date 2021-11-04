<?php include "include_view.php";
?>

<body class="changepassword">
    
        <div class="container offset-sm-7" id="changepassword">
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" name="password" class="form-control" placeholder="<?= $_SESSION['current-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" name="newpassword" class="form-control" placeholder="<?= $_SESSION['new-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" name="confirmpassword" class="form-control" placeholder="<?= $_SESSION['confirm-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center offset-sm-1">
                <div class="col-md-auto" id="changepassword">
                    <input id="btnchangepassword" type="submit" value="<?= $_SESSION['save'] ?>" class="btn btn-default btn-orange " />
                </div>
            </div>
        </div>
    
</body>
<script type="text/javascript">
 $('#submit').click(function(){
    $.ajax({
          url: "/user/actions.php?action=changepassword",
          type: "POST",
          data: {
            passwd: $("#password"),
            newpasswd: $("#newpassword"),
            newpasswd: $("#confirmpassword")
          },
          dataType: "json",
      }).done(function(back) {
        if (back.error) {
            toggleAlertError();
        } else {
          
        }
      });
  });

  </script>