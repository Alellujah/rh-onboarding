<?php
//======================================================================
// Página de remoção!
//======================================================================
?>
<?php include ('./components/header.php'); ?>
<?php
  //busca o id e a tabela onde vai retirar
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $q = $_GET['q'];
    try{
      $stmt = $con->prepare("DELETE FROM $q WHERE id = ?");
      $stmt->execute(array($id));
      $url_params = 'view.php?q=' . $_GET['q'];
      header("Location:$url_params");
    }catch(PDOException $ex){
      echo $ex->getMessage();
    }
  }
?>
