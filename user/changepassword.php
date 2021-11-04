<?php include "include_view.php";
?>




<body class="changepassword">

    <div class="container offset-sm-7" id="changepassword">
        <form name="formpass" action="" method="POST">
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
                    <button id="btnchangepassword" type="submit" onclick="validar"  class="btn btn-default btn-orange" ><?= $_SESSION['save'] ?></button>
                </div>
            </div>
        </form>
    </div>

</body>

<script type="text/javascript">
    function validar() {
        alert("ok");
    }
</script>