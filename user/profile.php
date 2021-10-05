<?php include "include_view.php";
  $names = $controller->toSchoolUnit->getAll("id=1"); //("id=1") ("nome='Augusto'") -> para pesquisar tudo relacionado
  //$names = $controller->toSchoolUnit->getAll("id=1")[0]; se usar o final 0 no colchetes ele retorna só a posição 0 do array, não precisa usar o foreach
  // $names = $controller->toSchoolUnit->insert(); //(["nome"=>"Augusto","lastname"=>"Cardone"]) -> Inseri o nome Augusto dentro da coluna "nome", inseri o nome "Cardone" dentro da coluna "lastname"
  // $controller->toSchoolUnit->update(); //(["nome"=>"Augusto","lastname"=>"Cardone"], "id=1") -> Atualizar no id "1" para o nome Augusto e last name Cardone     ---- Inserindo na coluna "nome" o nome Augusto ---- depois dos colchetes colocar o onde ("where")coluna=/valor
  //<?php echo $names ['nome']; para exibir um nome usando o 0 no final do getall.
  var_dump($names);  

  foreach($names as $valor){ //Para trazer somente o nome de uma pessoa.
    echo $valor["nome"]; //exibindo a coluna nome do id 1
    echo $valor["lastname"]; //exibindo a coluna lastname do id 1
  }
  function enviarNome(){
    $nome = $_REQUEST ["nome"]; //Verificar
  }
  
?>



<nav>

</nav>
<head>
    <meta charset="UTF-8">    
</head>
<body id="bodyprofile">
    <div>
        <form action="enviarNome()" method="post" >
            <label>Nome:</label>
            <input type="text" name="nome" require>
        </form>
    </div>
</body>