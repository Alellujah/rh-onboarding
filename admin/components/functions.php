<?php

  function is_empty($value){
    if ($value == !null){
      echo '<td>' . $value . '</td>';
    }
    else{
      //nothing to do
    }
  }

  function cleanUpUrl($nome){
      $nome_cleaned = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($nome));
      return preg_replace('/\s+/', '.', strtolower($nome_cleaned));
  }

function getDescricoes($id){
  //get descricoes
    $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $retArray = array();
    $stmt = $con->prepare("SELECT induction_desc.descricao
    FROM induction_desc JOIN induction
    WHERE  induction.id = induction_desc.induction_id
    AND induction.id=$id");
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $value) {
      $retArray[] = $value['descricao'];
    }
    return $retArray;
  }//end of function getDescricoes

  function getInduction($id){
    $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //Simpler and the same - Rght?
    $stmt = $con->prepare("SELECT induction.hora
    FROM induction
    WHERE induction.id=$id ORDER BY induction.hora DESC");

    $stmt->execute();
    $results = $stmt->fetch();

    $hora = $results['hora'];
    echo $hora;
  }
?>
