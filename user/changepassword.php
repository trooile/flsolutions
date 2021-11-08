<?php
session_start();
include "include_view.php";
?>

<script>
    $('#btnpw').click(function() {
        $.ajax({
            url: "/user/actions.php?action=changepw",
            type: "POST",
            data: {
                pw: $("#pw").val(),
                nwpw: $("#nwpw").val(),
                cfpw: $("#cfpw").val(),
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
</script>

<body class="changepassword">

    <div class="container offset-sm-7" id="changepassword">
        <form name="formpass" action="" method="POST">
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" id="pw" class="form-control" placeholder="<?= $_SESSION['current-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" id="nwpd" class="form-control" placeholder="<?= $_SESSION['new-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input id="changepassword" type="text" id="cfpw" class="form-control" placeholder="<?= $_SESSION['confirm-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center offset-sm-1">
                <div class="col-md-auto" id="changepassword">
                    <button id="btnpw" type="submit" onclick="validar()" class="btn btn-default btn-orange"><?= $_SESSION['save'] ?></button>
                </div>
            </div>
        </form>
    </div>

</body>