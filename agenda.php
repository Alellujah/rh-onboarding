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
          Agenda
        </div>
      </div>
    </section>

    <section style="padding-top:0;" id="agenda-inner">
      <div class="row">
        <div class="columns small-12 medium-5 medium-centered">
          <img src="assets/img/illustracao-1-02.svg" alt="Agenda" />
        </div>
      </div>
      <div class="row">
        <div class="columns small-12">
          <h1><span class="yellowbg">O primeiro dia</span> no escritório</h1>
        </div>
      </div>

      <div class="row">
        <div class="columns small-12 medium-8 medium-centered">
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
              <small>Mentor - <?= $_SESSION['mentor'] ?> + RH</small>
              <ul>
                <li>Apresentação do Mentor e do Programa de Mentoring</li>
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
    </section>
    </div>


<?php include './components/footer.php';?>
