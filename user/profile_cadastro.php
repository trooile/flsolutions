<?php include "include_view.php";
$user = $controller->toUsers->getAll("id_school_unit=13")[0]; //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado //Pode remover o último colchete para puxar tudo
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];


function update(){
    $controller->toSchoolUnit->update(); //(["nome"=>"Augusto","lastname"=>"Cardone"], "id=1") -> Atualizar no id "1" para o nome Augusto e last name Cardone     ---- Inserindo na coluna "nome" o nome Augusto ---- depois dos colchetes colocar o onde ("where")coluna=/valor
}
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
            <form id="form" method="POST">
                <label><?php echo $_SESSION['nameProfile']; ?></label>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="<?php echo $user["name"]; ?>" />
                </div>
                <label><?php echo $_SESSION['email']; ?></label>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="<?php echo $user["email"]; ?>" />
                </div>
                <label><?php echo $_SESSION['college']; ?></label>
                <div>
                    <input  type="text" name="name" class="form-control" placeholder="<?php echo $user["name"]; ?>" />
                </div>
                <input id="btnProfile" type="submit" value="Enviar" class="btn btn-primary" />
            </form>
        </div>

    </div>
</body>