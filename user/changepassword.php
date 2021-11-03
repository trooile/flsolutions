<?php include "include_view.php";


?>



<body class="changepassword">
    <form id="formchangepassword" method="POST" action="/user/profile_cadastro_update.php">
        <div class="container" id="changepassword">
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="profile" type="text" name="email" class="form-control" placeholder="<?= $_SESSION['current-password']?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="profile" type="text" name="email" class="form-control"  />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="profile" type="text" name="email" class="form-control"  />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <br><input id="btnProfile" type="submit" value="<?= $_SESSION['save'] ?>" class="btn btn-default btn-orange offset-sm-2" />
                </div>
            </div>
        </div>
    </form>
</body>