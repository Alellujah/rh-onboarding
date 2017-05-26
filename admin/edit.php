<?php
//======================================================================
// Página de edição!
//======================================================================
?>
<?php include ('./components/header.php'); ?>

<?php
// Verifica se foi efetuada uma submissão e apanha os valores para variaveis.
if(isset($_POST['btn_submit'])){
  $id = $_POST['id'];
  if(isset($_POST['mentor'],$_POST['responsavel'],$_POST['data_inicio'])){
    // $url_link = $_POST['url_link'];
    $nome = $_POST['nome'];
    $url_link = cleanUpUrl($nome);
    $mentor = $_POST['mentor'];
    $responsavel = $_POST['responsavel'];
    $data_inicio = $_POST['data_inicio'];
  }
  // Se as variaveis nome e mentor estiver preenchidas quer dizer que estamos a adicionar um colaborador.
  if($_GET['q'] === 'colaborador'){
    $nome = $_POST['nome'];
    try{
      $table = $_GET['q'];
      $stmt = $con->prepare("UPDATE $table set nome= :nome, mentor= :mentor, responsavel= :responsavel, data_inicio= :data_inicio, clean_url= :clean_url WHERE id = :id");
      $stmt->execute(array(':nome'=>$nome,':mentor'=>$mentor,':responsavel'=>$responsavel,':data_inicio'=>$data_inicio,':clean_url'=>$url_link, ':id'=>$id));
      if($stmt){
        $url_params = 'view.php?q=' . $_GET['q'];
        header("Location:$url_params");
      }
    }catch(PDOException $ex){
      echo $ex->getMessage();
    }
  }
  // Caso contrario é um mentor ou um responsável de área que vamos definir conforme o parametro "q" que está no url
  elseif ($_GET['q'] == 'mentor' || $_GET['q'] == 'responsavel'){
    $nome = $_POST['nome'];
    try{
      $table = $_GET['q'];
      $stmt = $con->prepare("UPDATE $table set nome= :nome WHERE id = :id");
      $stmt->execute(array(':nome'=>$nome, ':id'=>$id));
      if($stmt){
        $url_params = 'view.php?q=' . $_GET['q'];
        header("Location:$url_params");
      }
    }catch(PDOException $ex){
      echo $ex->getMessage();
    }
  }

  //alterar induction
  elseif ($_GET['q'] === "induction"){
    $descricao_all = $_POST['desc'];
    $hora = $_POST['hora'];
    $dia = $_POST['dia'];
    $orador = $_POST['orador'];
    try{
      $descricao = "(" . implode( ")," , $descricao_all);
      echo $descricao . '<br>';

      $con->beginTransaction();

      $lastId = $_GET['id'];

      $stmInduction_update = $con->prepare("UPDATE induction set hora= :hora, orador= :orador,dia= :dia WHERE id = :id");
      $stmInduction_update->execute(array(':id'=>$lastId, ':hora'=>$hora,':orador'=>$orador,':dia'=>$dia));

      $stmInduction_delete = $con->prepare("DELETE FROM induction_desc WHERE induction_id = :id");
      $stmInduction_delete->execute(array(':id'=>$lastId));
      foreach ($descricao_all as $descricao) {
        if($descricao != ''){
          $stmtInduction_desc = $con->prepare("INSERT INTO induction_desc(induction_id,descricao) VALUES (:id,:descricao);");
          $stmtInduction_desc->execute(array(':id'=>$lastId,':descricao'=>$descricao));
        }
      }
      $con->commit();

      $url_params = 'view.php?q=' . $_GET['q'];
      header("Location:$url_params");

    }catch(PDOException $ex){
      echo $ex->getMessage();
    }
  }
  // Se não tiver nada -> 404 * Undone
  else{
    echo 'errorrrrr';
  }
}
// Preparar as variaveis para fazer query à bd
$id = 0;
$table = $_GET['q'];
$nome = '';
$mentor = '';
$responsavel = '';
$data_inicio = '';
$url_link = '';

// Retirar os parametros do url para fazer query
if(isset($id, $table) && $table != 'induction'){
  $id = $_GET['id'];
  $table = $_GET['q'];
  $stmt = $con->prepare("SELECT * FROM $table WHERE id = :id");
  $stmt->execute(array(':id'=>$id));
  $row = $stmt->fetch();
  $id = $row['id'];
  if (isset($row['nome'])){
    $nome = $row['nome'];
  }
  // Se for um colaborador vamos ficar também com as variaveis de mentor / responsavel / data inicio
  if (isset($row['mentor'],$row['responsavel'],$row['data_inicio'])){
    $mentor = $row['mentor'];
    $responsavel = $row['responsavel'];
    $data_inicio = $row['data_inicio'];
    $url_link = cleanUpUrl($nome);
  }
}

// Editar para induction
elseif($table == 'induction'){

  $id = $_GET['id'];
  $stmt = $con->prepare("SELECT *
  FROM induction INNER JOIN induction_desc
  WHERE  induction.id = induction_desc.induction_id
  AND induction.id=$id");
  $stmt->execute();
  $results = $stmt->fetch();
  $orador = $results['orador'];
  $dia = $results['dia'];
} //end of elseif induction
else{
  echo 'Nothing to display';
}
?>

<?php
//incluir navegaçao lateral
include_once('./components/left-nav.php');
?>

<div class="columns medium-11" id="header-title">
  <h2>Editar</h2>
</div>

<div class="columns medium-11 page_edit">
  <form class="" action="" method="post">
    <table>
      <tr>

        <?php if ($_GET['q'] == 'induction'){ ?>
          <td>
            Dia
          </td>
          <td>
            <input type="text" name="dia" value="<?= $dia ?>">
          </td>
        </tr>
        <tr>
          <td>
            Hora
          </td>
          <td>
            <input type="text" name="hora" value="<?= getInduction($id); ?>">
          </td>
        </tr>
        <tr>
          <td>
            Orador
          </td>
          <td>
            <input type="text" name="orador" value="<?= $orador; ?>">
          </td>
        </tr>
        <tr class="last">
          <td>
            Descrição
          </td>
          <td>
            <?php
            $descArr = getDescricoes($id);
            $count = 0;
            $len = count($descArr);
            foreach($descArr as $item){ ?>
                <input type="text" name='desc[]' value="<?= $item ?>">
                <?php if($count != $len - 1){ ?> </td></tr>
                <tr><td></td><td>
                <?php } ?>
            <?php
              $count++;
            } ?>

          </td>
        </tr>
        <?php } //end of induction ?>

        <?php if (!empty($nome)){ ?>
          <td>Nome do <?php echo $_GET['q'];?></td>
          <td><input type="text" name="nome" value="<?= $nome; ?>"></td>
        <?php }?>
          <?php if (!empty($mentor) || !empty($responsavel) || !empty($data_inicio) || !empty($url_link)){ ?>
          <tr>
            <td>Mentor
              <td>
                <select name="mentor" required placeholder="Mentor">
                  <?php
                    $query = $_GET['q'];
                    if($query == 'colaborador'){
                      $stmt = $con->prepare("SELECT * FROM mentor ORDER BY nome ASC");
                    }else{
                      //Nothing
                    }
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                  ?>
                  <?php
                    foreach($results as $row){
                    $select_opt = $row['nome'];
                    $select_val = $row['id'];
                  ?>
                  <option value="<?= $select_val;?>"
                        <?php
                          if($select_val == $mentor){ ?> selected="selected"
                          <?php } ?>><?= $select_opt; ?></option>
                  <?php
                    }
                  ?>

                </select>
              </td>
            </td>
          </tr>
          <tr>
            <td>Responsavel
              <td>                
                <select name="responsavel" required placeholder="Responsavel de área">
                  <?php
                    $query = $_GET['q'];
                    if($query == 'colaborador'){
                      $stmt = $con->prepare("SELECT * FROM responsavel ORDER BY nome ASC");
                    }else{
                      //Nothing
                    }
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                  ?>
                  <?php
                    foreach($results as $row){
                    $select_opt = $row['nome'];
                    $select_val = $row['id'];
                  ?>
                  <option value="<?= $select_val;?>"
                        <?php
                          if($select_val == $responsavel){ ?> selected="selected"
                          <?php } ?>><?= $select_opt; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
            </td>
          </tr>
          <tr>
            <td>Data Inicio
              <td><input type="date" name="data_inicio" value="<?= $data_inicio; ?>"></td>
            </td>
            <tr>
              <td>
                Link para o colaborador
                <td><input type="text" name="url" value="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/nome/' . $url_link; ?>" disabled></td>
              </td>
            </tr>
          </tr>
          <?php } //end of if ?>

        </tr>
      </table>
      <?php
        if($_GET['q'] === "induction"){
      ?>
      <button class="add" type="button" name="button">Adicionar tópico <i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
      <script type="text/javascript">
      $("button").click(function(){
        $(".last").last().after("<tr class='last'><td></td><td><input type='text' name='desc[]' placeholder='Tópico'></td></tr>'");
      });
      </script>
      <?php
        }
      ?>
      <input type="hidden" name="id" value="<?= $id; ?>">
      <input class="btn_submit" type="submit" name="btn_submit" value="Alterar informação">
    </form>
  </div>
</body>
</html>
