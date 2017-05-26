<?php
function getDescricoes($id){
  //get descricoes
    $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $con->prepare("SELECT induction_desc.descricao
    FROM induction_desc JOIN induction
    WHERE  induction.id = induction_desc.induction_id
    AND induction.id=$id");
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $value) {
      $descricao = $value['descricao'];
      echo '<li>' . $descricao . '</li>';
      // return $descricao;
    }
  }//end of function getDescricoes
  function getInduction($id){
    $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Join porque??
    // $stmt = $con->prepare("SELECT induction.hora
    // FROM induction JOIN induction_desc
    // WHERE  induction.id = induction_desc.induction_id
    // AND induction.id=$id");

    //Simpler and the same - Rght?
    $stmt = $con->prepare("SELECT induction.hora
    FROM induction
    WHERE induction.id=$id");

    $stmt->execute();
    $results = $stmt->fetch();

    $hora = $results['hora'];
    echo $hora;
  }
?>
