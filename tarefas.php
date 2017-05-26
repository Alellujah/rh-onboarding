<?php include './components/header.php';?>

    <section id="back" class="sticky">
      <div class="row">
        <div class="columns small-6">
          <a href="homepage"><i class="fa fa-long-arrow-left"></i> Voltar</a>
        </div>
        <div class="columns small-6 page-title">
          Tarefas
        </div>
      </div>
    </section>
    <section id="tarefas-inner" class="inner-page">
      <div class="row">
        <div class="columns small-12 medium-5 medium-centered">
          <img src="assets/img/illustracao-1-03.svg" alt="Agenda" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-8">
          <h1>Tarefas para o <span class="yellowbg">1º dia</span></h1>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-8">
          <ul id="tasks">
            <li id="1" class="one"><i class="fa fa-check" aria-hidden="true"></i> Configurar assinatura de e-mail</li>
            <li id="2" class="two"><i class="fa fa-check" aria-hidden="true"></i> Conhecer o responsável de área</li>
            <li id="3" class="third"><i class="fa fa-check" aria-hidden="true"></i> Almoçar com os colegas</li>
            <li id="4" class="four"><i class="fa fa-check" aria-hidden="true"></i> Pagar o café a um colega</li>
          </ul>
        </div>
      </div>

    <script type="text/javascript">

    var checked1 = Cookies.get('checked1');
    var checked2 = Cookies.get('checked2');
    var checked3 = Cookies.get('checked3');
    var checked4 = Cookies.get('checked4');

    $("#tasks li[id]").on("click", function(event){

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

    </script>
    <?php include './components/footer.php';?>
