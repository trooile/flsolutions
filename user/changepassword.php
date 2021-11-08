<?php
session_start();
include "include_view.php";
?>


<body class="changepassword">

    <div class="container offset-sm-7" id="changepassword">
        <form name="formpass" >
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input  type="text" id="pw" class="form-control" placeholder="<?= $_SESSION['current-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input type="text" id="nwpw" class="form-control" placeholder="<?= $_SESSION['new-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto" id="changepassword">
                    <input type="text" id="cfpw" class="form-control" placeholder="<?= $_SESSION['confirm-password'] ?>" />
                </div>
            </div>
            <div class="row justify-content-md-center offset-sm-1">
                <div class="col-md-auto" id="changepassword">
                    <button id="btnpw" type="button" class="btn btn-default btn-orange"><?= $_SESSION['save'] ?></button>
                </div>
            </div>
        </form>
    </div>

</body>



<script type="text/javascript">
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
                alert(back.data);
            }
            else {
                alert(back.data);
               window.location.href = "profile.php";
            }
        });
    });
</script>