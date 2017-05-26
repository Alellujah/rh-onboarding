<?php include './components/header.php';?>
<?php
session_start();
?>
    <div class="inner-page">
    <section id="back" class="sticky">
      <div class="row">
        <div class="columns small-6">
          <a href="homepage"><i class="fa fa-long-arrow-left"></i> Voltar</a>
        </div>
        <div class="columns small-6 page-title">
          Induction time
        </div>
      </div>
    </section>

    <section id="induction" style="padding-top:0;" class="inner-page">
      <div class="row">
        <div class="columns small-12 medium-5 medium-centered">
          <img src="assets/img/illustracao-1-02.svg" alt="Agenda" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12">
          <h1><span class="yellowbg">Induction time</span></h1>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-8">
          <p>
            Na primeira semana de cada mês existem 3 dias dedicados para aprenderes tudo sobre a Iten!
          </p>
          <p>
            Quem somos, o que fazemos, como as várias áreas interagem no seu dia-a-dia, apenas para citar alguns dos tópicos abordados.
          </p>
          <p>
            Sendo assim <span class="yellowbg weight-in">estás convidado</span> para participar no próximo!
          </p>
        </div>
      </div>

      <div class="row" id="dia1">
        <div class="columns small-12 medium-centered medium-8">
          <h2>Dia 1</h2>
              <?php
              $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
              $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

              $stmt = $con->prepare("SELECT
                  i.dia 'dia',
                  i.hora 'hora',
                  i.orador 'orador',
                  GROUP_CONCAT(d.descricao SEPARATOR '</li><li>') 'descricao'
                  from induction i join
                  induction_desc d on i.id = d.induction_id
                  WHERE dia='1'
                  GROUP BY i.dia, i.hora, i.orador
                  ORDER BY hora,dia ASC ");
              $stmt->execute();
              $results = $stmt->fetchAll();

              foreach ($results as $value) {
                $descricao = $value['descricao'];
                $dia = $value['dia'];
                $hora = $value['hora'];
                $orador = $value['orador'];?>
                <div class="row cards">
                  <div class="columns small-12">
                    <?php echo '<h3 class="hora">'.$hora.'</h3>
                    <small>'.$orador.'</small>
                    <ul>
                      <li>'.$descricao.'</li>
                    </ul>
                  </div>
                </div>';
              }

              if (isset($row['hora'])){
                echo '<ul>';

                echo '</ul>';
              }
              ?>

        </div>
      </div><!--end of dia 1-->

      <div class="row" id="dia2">
        <div class="columns small-12 medium-centered medium-8">
          <h2>Dia 2</h2>
          <?php
          $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
          $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

          $stmt = $con->prepare("SELECT
              i.dia 'dia',
              i.hora 'hora',
              i.orador 'orador',
              GROUP_CONCAT(d.descricao SEPARATOR '</li><li>') 'descricao'
              from induction i join
              induction_desc d on i.id = d.induction_id
              WHERE dia='2'
              GROUP BY i.dia, i.hora, i.orador
              ORDER BY hora,dia ASC ");
          $stmt->execute();
          $results = $stmt->fetchAll();

          foreach ($results as $value) {
            $descricao = $value['descricao'];
            $dia = $value['dia'];
            $hora = $value['hora'];
            $orador = $value['orador'];?>
            <div class="row cards">
              <div class="columns small-12">
                <?php echo '<h3 class="hora">'.$hora.'</h3>
                <small>'.$orador.'</small>
                <ul>
                  <li>'.$descricao.'</li>
                </ul>
              </div>
            </div>';
          }

          if (isset($row['hora'])){
            echo '<ul>';

            echo '</ul>';
          }
          ?>

        </div>
      </div><!--end of dia 2-->

      <div class="row" id="dia3">
        <div class="columns small-12 medium-centered medium-8">
          <h2>Dia 3</h2>
          <?php
          $con = new PDO('mysql:host=localhost;dbname=onboarding;','user','pw');
          $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

          $stmt = $con->prepare("SELECT
              i.dia 'dia',
              i.hora 'hora',
              i.orador 'orador',
              GROUP_CONCAT(d.descricao SEPARATOR '</li><li>') 'descricao'
              from induction i join
              induction_desc d on i.id = d.induction_id
              WHERE dia='3'
              GROUP BY i.dia, i.hora, i.orador
              ORDER BY hora,dia ASC ");
          $stmt->execute();
          $results = $stmt->fetchAll();

          foreach ($results as $value) {
            $descricao = $value['descricao'];
            $dia = $value['dia'];
            $hora = $value['hora'];
            $orador = $value['orador'];?>
            <div class="row cards">
              <div class="columns small-12">
                <?php echo '<h3 class="hora">'.$hora.'</h3>
                <small>'.$orador.'</small>
                <ul>
                  <li>'.$descricao.'</li>
                </ul>
              </div>
            </div>';
          }

          if (isset($row['hora'])){
            echo '<ul>';

            echo '</ul>';
          }
          ?>

        </div>
      </div><!--end of dia 3-->

      <div class="bottom-menu">
        <div class="columns small-12 medium-centered medium-8">
            <div class="columns small-4">
              <a href="#dia1">Dia 1</a>
            </div>
            <div class="columns small-4">
              <a href="#dia2">Dia 2</a>
            </div>
            <div class="columns small-4">
              <a href="#dia3">Dia 3</a>
            </div>
        </div>
      </div>
    </section>
    </div>
<script type="text/javascript">
if ($('.hora:contains("14:30h")').length > 0) {
  $('.hora:contains("14:30h")').parents(".cards").before("<div class='row lunch'><div class='columns small-12'><h3><i class='fa fa-cutlery' aria-hidden='true'></i> Almoço</h3></div></div>" );
}
</script>
<?php include './components/footer.php';?>
