<?php include "include_view.php";

$user = $controller->toUsers->getAll("id_school_unit=13")[0]; //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado //Pode remover o último colchete para puxar tudo
$school = $controller->toSchoolUnit->getAll($user["id_school_unit"])[0];

//$names = $controller->toSchoolUnit->getAll("id=1")[0]; se usar o final 0 no colchetes ele retorna só a posição 0 do array, não precisa usar o foreach
// $names = $controller->toSchoolUnit->insert(); //(["nome"=>"Augusto","lastname"=>"Cardone"]) -> Inseri o nome Augusto dentro da coluna "nome", inseri o nome "Cardone" dentro da coluna "lastname"
// $controller->toSchoolUnit->update(); //(["nome"=>"Augusto","lastname"=>"Cardone"], "id=1") -> Atualizar no id "1" para o nome Augusto e last name Cardone     ---- Inserindo na coluna "nome" o nome Augusto ---- depois dos colchetes colocar o onde ("where")coluna=/valor
//<?php echo $names ['nome']; para exibir um nome usando o 0 no final do getall.
/*
  foreach($names as $valor){ //Para trazer somente o nome de uma pessoa.
    echo $valor["nome"]; //exibindo a coluna nome do id 1
    echo $valor["lastname"]; //exibindo a coluna lastname do id 1
  }
  function enviarNome(){
    $nome = $_REQUEST ["nome"]; //Verificar
  }
  
  <form action="enviarNome()" method="post" > //Metódo para enviar o nome para o banco. 
    <p>Nome:</p>
    <input type="text" name="nome" require>
  </form>
  
*/
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
      <label><?php echo $_SESSION['nameProfile'];?></label>
      <div>
        <?php echo $user["name"];  ?>
      </div>
      <label><?php echo $_SESSION['email']; ?></label>
      <div>
        <?php echo $user["email"]; ?>
      </div>
      <label><?php echo $_SESSION['college']; ?></label>
      <div>
        <?php echo $school["name"]; ?>
      </div>
    </div>

  </div>
</body>