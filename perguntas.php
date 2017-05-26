<?php include './components/header.php';?>
<?php session_start();?>
    <section id="back" class="sticky">
      <div class="row">
        <div class="columns small-4">
          <a href="homepage"><i class="fa fa-long-arrow-left"></i> Voltar</a>
        </div>
        <div class="columns small-8 page-title">
          Perguntas Frequentes
        </div>
      </div>
    </section>
    <section id="perguntas" class="inner-page">
      <div class="row">
        <div class="columns medium-8 medium-centered small-12">
            <h1 style="text-align:left;margin-top:3rem;">Perguntas Frequentes</h1>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-centered medium-8">
          <h5>Qual é o horário de trabalho da ITEN?</h5>
          <p>Das 9h00 às 18h00.</p>
          <hr>
          <h5>Posso estacionar dentro das instalações?</h5>
          <p>
             Podes, desde que tenhas um dístico associado à tua viatura. Para isso, terás de solicitar um aos Recursos Humanos.
          </p>
          <hr>
          <h5>Existe uma política de recrutamento interno?</h5>
          <p>
            Sim, está partilhada no Yammer e todos os anúncios são publicados na mesma plataforma.
          </p>
          <hr>
          <h5>Onde posso partilhar sugestões?</h5>
          <p>
            Podes enviar sugestões que aches pertinentes para <a href="mailto:sugestoes@iten.pt">sugestoes@iten.pt.</a>
          </p>
          <hr>
          <h5>Mentor?</h5>
          <p>
            O teu mentor, <?= $_SESSION['mentor'] ?> vai te ajudar em tudo o que precisares para te sentires integrado na tua equipa e na ITEN!
          </p>
        </div>
      </div>
    </section>


<?php include './components/footer.php';?>
