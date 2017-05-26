
<?php include './components/header.php';?>

  <?php
    session_start();
    $server = 'http://' . $_SERVER['HTTP_HOST'];
  ?>

  <?php
    if(isset($_GET['clean_url'])){
      $url = $_GET['clean_url'];
      $stmt = $con->prepare("SELECT * FROM colaborador WHERE clean_url = :clean_url");
      $stmt->execute(array(':clean_url'=>$url));
      $results = $stmt->fetchAll();
      foreach($results as $row){
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['data_inicio'] = $row['data_inicio'];
        $mentor_id = $row['mentor'];
        $responsavel_id = $row['responsavel'];
    }
    $stmtR = $con->prepare("SELECT nome FROM responsavel WHERE id = :responsavel_id");
    $stmtR->execute(array(':responsavel_id'=>$responsavel_id));
    $results_r = $stmtR->fetchAll();

    foreach ($results_r as $row) {
      $_SESSION['responsavel'] = $row['nome'];
    }

    $stmtM = $con->prepare("SELECT nome FROM mentor WHERE id = :mentor_id");
    $stmtM->execute(array(':mentor_id'=>$mentor_id));
    $results_m = $stmtM->fetchAll();

    foreach ($results_m as $row) {
      $_SESSION['mentor'] = $row['nome'];
    }

    header("Location:$server");
    die();
  }elseif (!isset($_GET['clean_url']) && $_SESSION['nome'] === null){
    header("Location:$server");
    die();
  }
  ?>

    <section id="hello">
          <div class="wrapper-center">
            <div class="row">
              <div class="columns small-12 medium-12">
                  <h1>Olá</h1>
                  <?php echo '<h2 style="font-size:3rem;">' . $_SESSION['nome'] . '</h2>';?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="columns small-12">
                <a href="javascript:void(0)" id="goToSecondStep"><h4>Vamos começar <i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4></a>
            </div>
          </div>
    </section>
    <!--end of hello-->

    <section id="firstpage">
      <div class="row">
        <div class="columns small-12 medium-centered medium-7">
            <img src="/assets/img/illustracao-1-01.svg" alt="Yellow Company" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-6">
            <h1>Bem vindo à <span class="yellowbg">Iten</span></h1>
            <p>
              Estamos muito contentes por contar contigo! Vamos guiar-te pelo teu primeiro dia e dar-te acesso a informação útil!
            </p>
        </div>
      </div>
      <div class="row bottom">
        <div class="columns small-12">
          <a href="javascript:void(0)" id="goToThirdStep"><h4>Agenda 1º dia <i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4></a>
        </div>
      </div>
    </section>
    <!--end of firstpage-->

    <section id="secondpage">
      <div class="row">
        <div class="columns small-12 medium-centered medium-5">
          <img src="assets/img/illustracao-1-02.svg" alt="Agenda" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-6">
          <h1 style="margin-bottom:2rem;"><span class="yellowbg">O teu primeiro dia</span> no escritório!</h1>
          <p style="text-align:center;">
            No teu primeiro dia vamos tentar integrar-te o melhor possível!
          </p>
          <p style="text-align:center;margin-bottom:2rem;">
            <strong>Para tal irás ter reuniões com os recursos humanos e
            o teu responsável de área (<?= $_SESSION['responsavel'] ?>) e o  teu mentor (<?= $_SESSION['mentor'] ?>).</strong>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="columns small-12 medium-centered medium-6">
          <div class="row cards">
            <div class="columns small-12">
              <h3>09:30h - 10:30h</h3>
              <small>Human Resources</small>
              <ul>
                <li>Welcome Aboard: Entrega do Onboarding Kit</li>
                <li>Apresentação Geral da ITEN e Informação Geral</li>
                <li>Demo das principais ferramentas e aplicações</li>
              </ul>
            </div>
          </div>
          <div class="row cards">
            <div class="columns small-12">
              <h3>11:00h - 12:30h</h3>
              <small>Responsável de área - <?= $_SESSION['responsavel'] ?></small>
              <ul>
                <li>Acolhimento e enquadramento do colaborador na sua nova função, partilhando o descritivo funcional</li>
                <li>Apresentação do colaborador à equipa</li>
              </ul>
            </div>
          </div>
          <div class="row cards">
            <div class="columns small-12">
              <h3>12:00h - 12:30h</h3>
              <small><?= $_SESSION['mentor'] ?>RH</small>
              <ul>
                <li>Visita geral às instalações e apresentação aos responsáveis das áreas</li>
              </ul>
            </div>
          </div>
          <div class="row cards">
            <div class="columns small-12">
              <h3>14:00h - 14:30h</h3>
              <small>Responsável de área - <?= $_SESSION['responsavel'] ?></small>
              <ul>
                <li>Visita geral às instalações e apresentação aos responsáveis das áreas</li>
              </ul>
            </div>
          </div>
          <div class="row cards">
            <div class="columns small-12">
              <h3>15:00h - 15:30h</h3>
              <small>Responsável de área - <?= $_SESSION['responsavel'] ?></small>
              <ul>
                <li>Tour pelas diferentes áreas que compõe a grande área funcional onde o colaborador se insere</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row bottom">
        <a href="javascript:void(0)" id="goToFourthStep"><h4>Tarefas 1º dia <i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4></a>
      </div>
    </section>
    <!--end of secondpage-->

    <section id="thirdpage">
      <div class="row">
        <div class="columns small-12 medium-centered medium-5">
          <img src="assets/img/illustracao-1-03.svg" alt="Agenda" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-6">
          <h1>Tarefas para o <span class="yellowbg">1º dia</span></h1>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-6">
          <ul id="tasks">
            <li id="1" class="one"><i class="fa fa-check" aria-hidden="true"></i> Configurar assinatura de e-mail</li>
            <li id="2" class="two"><i class="fa fa-check" aria-hidden="true"></i> Conhecer o responsável de área</li>
            <li id="3" class="third"><i class="fa fa-check" aria-hidden="true"></i> Almoçar com os colegas</li>
            <li id="4" class="four"><i class="fa fa-check" aria-hidden="true"></i> Pagar o café a um colega</li>
        </div>
      </div>

      <div class="row bottom">
        <a href="javascript:void(0)" id="goToHomepage"><h4>All ready! <i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4></a>
      </div>
    </section>
    <!-- end of thirdpage-->

   <script type="text/javascript">
   $('#goToSecondStep').click(function(){
       $("#hello").fadeOut();
       $("#firstpage").show();
   });
   $('#goToThirdStep').click(function(){
       $("#firstpage").fadeOut();
       $("#secondpage").show();
   });
   $('#goToFourthStep').click(function(){
       $("#secondpage").fadeOut();
       $("#thirdpage").show();
   });
   $('#goToHomepage').click(function(){
     $("#thirdpage").fadeOut();
     window.location.href = '<?= $server ?>/homepage';
   });


  $( document ).ready(function() {
    var checked1 = Cookies.get('checked1');
    var checked2 = Cookies.get('checked2');
    var checked3 = Cookies.get('checked3');
    var checked4 = Cookies.get('checked4');

    $("#tasks li[id]").on("click", function(event){
      //tasks

      if ( $(this).hasClass("checked") ) {
        $(this).removeClass("checked");
      }
      if ( $(this).hasClass("one") ) {
        Cookies.set('checked1', 'true');
        $(this).addClass("checked");
      }
      if ( $(this).hasClass("two") ) {
        Cookies.set('checked2', 'true');
        $(this).addClass("checked");
      }
      if ( $(this).hasClass("third") ) {
        Cookies.set('checked3', 'true');
        $(this).addClass("checked");
      }
      if ( $(this).hasClass("four") ) {
        Cookies.set('checked4', 'true');
        $(this).addClass("checked");
      }
      else{
        $(this).addClass("checked");
      }
    });
     if (typeof checked1 !== 'undefined') {
       // the variable is defined
         $('.one').addClass('checked');
     };
     if (typeof checked2 !== 'undefined') {
       // the variable is defined
         $('.two').addClass('checked');
     };
     if (typeof checked3 !== 'undefined') {
       // the variable is defined
         $('.third').addClass('checked');
     };
     if (typeof checked4 !== 'undefined') {
       // the variable is defined
         $('.four').addClass('checked');
     };
  });
   </script>
<?php include './components/footer.php';?>
