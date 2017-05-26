<?php include './components/header.php';?>
<?php session_start();?>

    <section id="homepage">
      <div class="row" data-equalizer data-equalize-on="small">
        <div class="columns small-6" data-equalizer-watch>
          <img src="assets/img/logo.svg" id="logo" alt="logo" />
        </div>
        <div class="columns small-6 call-out" data-equalizer-watch>
          <a href="agenda"><span id="agenda">Agenda <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12 medium-12 intro-home">
            <div class="row">
              <div class="columns small-12">
                <h1>Olá <?= $_SESSION['nome'] ?> </h1>
              </div>
            </div>
            <div class="row">
              <div class="columns small-12">
                <p>
                  No teu primeiro mês vais ter acesso ao teu Induction Time.
                </p>
                <a href="induction" class="lined">Calendário <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
              </div>
            </div>
        </div>
      </div>

    <div class="row">

      <a href="historia" rel="noopener noreferrer">

          <div class="columns spaced small-12 medium-6">
            <div class="columns small-3 medium-2">
              <img src="assets/img/open-book.svg" alt="" />
            </div>
            <div class="columns small-9 medium-10">
              <h5>A nossa história</h5>
              <small>Conhece um pouco sobre nós.</small>
            </div>
          </div>

      </a>

      <a href="beneficios">

          <div class="columns spaced small-12 medium-6">
            <div class="columns small-3 medium-2">
              <img src="assets/img/add-button.svg" alt="" />
            </div>
            <div class="columns small-9 medium-10">
              <h5>Protocolos</h5>
              <small>Benefícios com parceiros.</small>
            </div>
          </div>

      </a>

      <a href="tarefas">
        <div class="columns small-12 medium-6 spaced">
          <div class="columns small-3 medium-2">
            <img src="assets/img/task.svg" alt="" />
          </div>
          <div class="columns small-9 medium-10">
            <h5>Tarefas</h5>
            <small>Para começares com o pé direito.</small>
          </div>
        </div>
      </a>

      <a href="perguntas">
        <div class="columns small-12 medium-6 spaced">
          <div class="columns small-3 medium-2">
            <img src="assets/img/questions.svg" alt="" />
          </div>
          <div class="columns small-9 medium-10">
            <h5>Perguntas frequentes</h5>
            <small>Respostas e direções.</small>
          </div>
        </div>
      </a>

      <a href="contactos">
        <div class="columns small-12 medium-6 spaced">
          <div class="columns small-3 medium-2">
            <img src="assets/img/agenda.svg" alt="" />
          </div>
          <div class="columns small-9 medium-10">
            <h5>Contactos úteis</h5>
            <small>Perdido? Vê aqui com quem tens de falar.</small>
          </div>
        </div>
      </a>

      <a href="mapa">
        <div class="columns small-12 medium-6 spaced">
          <div class="columns small-3 medium-2">
            <img src="assets/img/blueprint.svg" alt="" />
          </div>
          <div class="columns small-9 medium-10">
            <h5>Mapa</h5>
            <small>Planta do edíficio de Lisboa</small>
          </div>
        </div>
      </a>
    </div>
    </section>


<?php include './components/footer.php';?>
