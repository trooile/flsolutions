<?php include "include_view.php";
$user = $controller->toUsers->getAll("id_school_unit=13")[0]; //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado //Pode remover o último colchete para puxar tudo
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];
// $names = $controller->toUsers->insert(["name"=>"Augusto","email"=>"augusto.cardone@fatec.sp.gov.br","id_school_unit"=>"12"]); //(["nome"=>"Augusto","lastname"=>"Cardone"])
 

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
            <form id="form" method="POST" action ="/user/profile_cadastro_update.php">
                <label><?=$_SESSION['nameProfile']?></label>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="<?=$user["name"]?>" />
                </div>
                <label><?=$_SESSION['email']; ?></label>
                <div>
                    <input type="text" name="email" class="form-control" placeholder="<?=$user["email"]?>" />
                </div>
                <label><?=$_SESSION['college']?></label>
                <div>
                    <input  type="text" name="college" class="form-control" placeholder="<?=$user["name"]?>" />
                </div>
                <input id="btnProfile" type="submit" value="Enviar" class="btn btn-primary" />
            </form>
        </div>

    </div>
</body>