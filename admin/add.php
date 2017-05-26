<?php
//======================================================================
// Página de adição!
//======================================================================
?>
<?php include ('./components/header.php'); ?>
<?php
// se o submit for pressionado
  if(isset($_POST['btn_submit'])){
    //prepara variaveis
    if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $nomeUrl = cleanUpUrl($nome);
    }
    if(isset($_POST['mentor'],$_POST['responsavel'],$_POST['data_inicio'])){
    $mentor = $_POST['mentor'];
    $responsavel = $_POST['responsavel'];
    $data_inicio = $_POST['data_inicio'];
    }
    if(isset($_POST['hora'],$_POST['orador'])){
    $hora = $_POST['hora'];
    $orador = $_POST['orador'];
    $dia = $_POST['dia'];
    $descricao_all = $_POST['desc'];
    }
    //insere dados na tabela colaborador
    if($_GET['q'] == 'colaborador'){
      try{
        $stmt = $con->prepare("INSERT INTO colaborador(nome,mentor,responsavel,data_inicio,clean_url)
                              VALUES(:nome,:mentor,:responsavel,:data_inicio,:clean_url)");
        $stmt->execute(array(':nome'=>$nome,':mentor'=>$mentor,':responsavel'=>$responsavel,':data_inicio'=>$data_inicio,':clean_url'=>$nomeUrl));
        $url_params = 'view.php?q=' . $_GET['q'];
        header("Location:$url_params");
      }catch(PDOException $ex){
        echo $ex->getMessage();
      }
    }
    //insere dados na tabela mentor ou responsavel
    if($_GET['q'] == 'responsavel' || $_GET['q'] == 'mentor'){
      try{
        //define a tabela conforme o parametro no url
        $table = $_GET['q'];
        $stmt = $con->prepare("INSERT INTO $table (nome)
                              VALUES(:nome)");
        $stmt->execute(array(':nome'=>$nome));
        $url_params = 'view.php?q=' . $_GET['q'];
        header("Location:$url_params");
      }catch(PDOException $ex){
        echo $ex->getMessage();
      }
    }
    //inserir dados induction
    elseif($_GET['q'] == 'induction'){
      try{
        $descricao = "(" . implode( ")," , $descricao_all);
        echo $descricao . '<br>';

        $con->beginTransaction();
        $stmtInduction = $con->prepare("INSERT INTO induction(hora,orador,dia)VALUES(:hora,:orador,:dia);");
        $stmtInduction->execute(array(':hora'=>$hora,':orador'=>$orador,':dia'=>$dia));

        $lastId = $con->lastInsertId();

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
    else{echo "error";}
  }
?>

    <?php
      //inclui navegação lateral
      include_once('./components/left-nav.php');
    ?>

      <div class="columns medium-11" id="header-title">
        <h2>Adicionar</h2>
      </div>
      <div class="columns medium-11 add_page">
        <form class="" action="" method="post">
          <?php
            //se o parametro q for colaborador
            if ($_GET['q'] == "colaborador") {
          ?>
          <table>
            <tr>
              <td>
                Nome do colaborador
              </td>
              <td>
                <input type="text" name="nome" required placeholder="Nome do <?= $_GET['q']; ?>">
              </td>
            </tr>
            <tr>
              <td>
                Mentor
              </td>
              <td>
                <!-- <input type="text" name="mentor" required placeholder="Mentor"> -->
                <select name="mentor" required placeholder="Mentor">
                  <option selected="selected">Selection um mentor</option>
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
                  <option value="<?= $select_val;?>"><?= $select_opt; ?></option>
                  <?php
                    }
                  ?>

                </select>
              </td>
            </tr>
            <tr>
              <td>
                Responsável de área
              </td>
              <td>
                <select name="responsavel" required placeholder="Responsavel de área">
                  <option selected="selected">Selection um responsavel</option>
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
                  <option value="<?= $select_val;?>"><?= $select_opt; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                Data de inicio
              </td>
              <td>
                <input type="date" name="data_inicio" required>
              </td>
            </tr>
          </table>              
          <?php } //end of colaborador
            //caso contrario é um mentor ou responsavel de area
            elseif ($_GET['q'] == "mentor" || $_GET['q'] == "responsavel"){
            ?>
            <table>
              <tr>
                <td>
                  Nome do <?= $_GET['q'];?>
                </td>
                <td>
                  <input type="text" name="nome" required placeholder="Nome do <?= $_GET['q']; ?>">
                </td>
              </tr>
            </table>
          <?php } //end of responsavel e mentor
          elseif ($_GET['q'] == "induction"){ ?>
            <table>
              <tr>
                <td>
                  Dia
                </td>
                <td>
                  <select class="" name="dia">
                    <option>Selecione o dia!</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Hora
                </td>
                <td>
                  <input type="text" name="hora" required placeholder="Hora">
                </td>
              </tr>
              <tr>
                <td>
                  Orador
                </td>
                <td>
                  <input type="text" name="orador" required placeholder="Orador">
                </td>
              </tr>
              <tr class="last">
                <td>
                  Descricão <span></span>
                </td>
                <td>
                  <input type="text" name="desc[]" placeholder="Tópico">
                </td>
              </tr>
            </table>
            <button class="add" type="button" name="button">Adicionar tópico <i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
            <script type="text/javascript">
            $("button").click(function(){
              $(".last").last().after("<tr class='last'><td></td><td><input type='text' name='desc[]' placeholder='Tópico'></td></tr>'");
            });
            </script>
            <?php
              }
            ?>
          <?php //} //end of induction add?>
              <input type="submit" class="btn_submit" name="btn_submit" value="Inserir <?= $_GET['q']; ?>">
        </form>
      </div>
    </div>
  </body>
</html>
