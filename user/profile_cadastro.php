<?php include "include_view.php";
$user = $controller->toUsers->getAll("id_school_unit=13")[0]; //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado //Pode remover o último colchete para puxar tudo
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];
?>

<body class="profile">
    <div id="logoprofile">
        <a href="/user/login.php"> <img src="/images/logo-bw.svg"></a>
    </div>
    <div class="profile">
        <div id="profile-img">
            <img src="/images/profile-img.svg">
        </div>
        <div class="dados">
            <form id="form" method="POST" action="/idade">
                <label><?=$_SESSION['nameProfile']?></label>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="<?=$user["name"]?>" />
                </div>
                <label><?=$_SESSION['email']; ?></label>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="<?=$user["email"]?>" />
                </div>
                <label><?=$_SESSION['college']?></label>
                <div>
                    <input  type="text" name="name" class="form-control" placeholder="<?=$user["name"]?>" />
                </div>
                <input id="btnProfile" type="submit" value="Enviar" class="btn btn-primary" />
            </form>
        </div>

    </div>
</body>