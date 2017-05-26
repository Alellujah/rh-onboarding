<?php
//======================================================================
// Página de vistas!
//======================================================================
?>

<?php include ('./components/header.php'); ?>


<?php
// faz a query de acordo com o parametro que estiver no url
$query = $_GET['q'];
if($query == 'colaborador'){
  $stmt = $con->prepare("SELECT
      c.id 'id',
      c.nome 'nome',
      m.nome 'mentor',
      r.nome 'responsavel',
      c.data_inicio 'data_inicio',
      c.clean_url 'clean_url'
    FROM colaborador c join
          mentor m on c.mentor = m.id join
          responsavel r on c.responsavel = r.id
     ORDER BY data_inicio ASC");
}
elseif($query =='induction'){
  $stmt = $con->prepare("SELECT * FROM $query ORDER BY hora ASC");
}else{
  $stmt = $con->prepare("SELECT * FROM $query ORDER BY id ASC");
}
$stmt->execute();
$results = $stmt->fetchAll();
?>

<?php
//chamar a navegação lateral
include_once('./components/left-nav.php');
?>
<div class="columns medium-11" id="header-title">
  <?php
  //faz output do h2 conforme a query
  switch ($query) {
    case 'responsavel':
    echo '<h2>Lista de responsáveis</h2>';
    break;
    case 'colaborador':
    echo '<h2>Lista de colaboradores</h2>';
    break;
    case 'mentor':
    echo '<h2>Lista de mentores</h2>';
    break;
    case 'induction':
    echo '<h2>Agenda induction</h2>';
    break;
    default:
    echo '<h2>Página de administração</h2>';
    break;
  }
  ?>

  <?php
  //controi o botão de adicionar conforme o parametro no url
  if($_GET['q']){
    $query = $_GET['q'];
    echo "<a class=\"btn\" href=add.php?q=$query \">Adicionar</a>";
  }
  ?>

</div>
<div class="columns medium-11 view_page">
  <table class="clear_me">
    <?php
    //se o field de mentor estiver preenchido, é um colaborador, então faz echo das th correspondentes
    $is_colaborador = array_column($results, 'mentor');
    if ($is_colaborador == !null){
      ?>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Mentor</th>
        <th>Responsável</th>
        <th>Data de Inicio</th>
        <th>Link do colaborador</th>
        <th>Editar</th>
      </tr>
      <?php }
      //se for induction
      elseif ($query == 'induction') { ?>
      <select class="" id="dia" name="dia">
        <option value="default">Todos os dias</option>
        <option value="dia1">Dia 1</option>
        <option value="dia2">Dia 2</option>
        <option value="dia3">Dia 3</option>
      </select>
      <tr>
        <th>Dia</th>
        <th>Hora</th>
        <th>Orador</th>
        <th>Conteúdo</th>
        <th>Editar</th>
      </tr>

      <?php
      //caso contrario é um mentor ou responsavel de area
      } else { ?>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Editar</th>
        </tr>
        <?php } //end of th ?>
        <?php foreach($results as $row){
          //define variaveis
          $id = $row['id'];
          //se for colaborador, variaveis para os campos dele
          if (isset($row['nome'], $row['mentor'], $row['responsavel'], $row['data_inicio'])){
            $nome = $row['nome'];
            $clean_url = $row['clean_url'];
            $mentor = $row['mentor'];
            $responsavel = $row['responsavel'];
            $data_inicio = $row['data_inicio'];            
            $hora = null;
            $orador = null;
          }
          //se for mentor ou responsavel
          elseif (isset($row['nome'])){
            $nome = $row['nome'];
            $mentor = null;
            $responsavel = null;
            $data_inicio = null;
            $url_link = null;
            $hora = null;
            $orador = null;
          }
          //se for induction
          elseif (isset($row['hora'])){
            $hora = $row['hora'];
            $orador = $row['orador'];
            $dia = $row['dia'];
            //funcao

            $nome = null;
            $mentor = null;
            $responsavel = null;
            $data_inicio = null;
            $url_link = null;
          }
          //o que não estiver preenchido é null
          else{
            $mentor = null;
            $responsavel = null;
            $data_inicio = null;
            $url_link = null;
          }
          ?>
          <tr <?php if ($_GET['q'] == 'induction' ) {
            echo 'class=' . $dia;
          }
          ?>>
            <?php

            //verifica se as variaveis têm conteudo, se tiver faz output senão não faz nada
            ?>
            <?php
              if ($_GET['q'] != 'induction') {
                is_empty($id);
              }
              else{
                echo '<td>' . $dia . '</td>';
              }
            ?>
            <?php is_empty($nome) ?>
            <?php is_empty($mentor) ?>
            <?php is_empty($responsavel)?>
            <?php is_empty($data_inicio)?>
            <?php
              if (isset($clean_url)){
                echo '<td>' . 'http://' . $_SERVER['HTTP_HOST'] . '/nome/' . $clean_url . '</td>';
                } elseif(!isset($clean_url)){
                //Não faz nada porque não é um colaborador!
              }
            ?>
              <?php is_empty($hora)?>
              <?php is_empty($orador)?>
              <td><?php
                if (isset($row['hora'])){
                  echo '<ul>';
                  foreach(getDescricoes($id) as $item)
                    echo '<li>'.$item.'</li>';
                  echo '</ul>';
                }?></td>
            <td>
              <span class="edit_icons"><a href="edit.php?id=<?= $row['id'] . '&q=' . $query ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>
              <span class="edit_icons"><a onclick="return confirm('Tem a certeza que quer eliminar? Se for um mentor ou responsável irá também eliminar qualquer colaborador que esteja associado!');" href="delete.php?id=<?= $row['id'] . '&q=' . $query ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
            </td>
          </tr>
          <?php
        } //fim do foreach
        ?>
      </table>
    </div>
  </body>
  </html>
  <script type="text/javascript">
    $("td:empty").remove();
  </script>
  <?php
    if ($_GET['q'] === 'induction') {
  ?>
  <script type="text/javascript">
  $(document).ready(function(){
      $('#dia').on('change', function() {
        if ( this.value == 'dia1'){
          $(".1").show();
          $(".2").hide();
          $(".3").hide();
        }
        else if ( this.value == 'dia2'){
          $(".2").show();
          $(".1").hide();
          $(".3").hide();
        }
        else if ( this.value == 'dia3'){
          $(".3").show();
          $(".2").hide();
          $(".1").hide();
        }
        else {
          $(".3").show();
          $(".2").show();
          $(".1").show();
        }
      });
  });
  </script>
  <?php
    }
  ?>
