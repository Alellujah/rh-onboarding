<div id="nav-wrapper">
  <div class="columns medium-1" id="left-nav">
    <img id="logo" src="./images/logo.svg" alt="logo-iten" />
    <ul>

      <a href="view.php?q=colaborador">
        <li>
          <img src="./images/users.svg" alt="colaboradores" />
          <br>
          Colaboradores
        </li>
      </a>

      <a href="view.php?q=induction">
        <li>
          <img src="./images/calendar.svg" alt="induction" />
          <br>
          Induction
        </li>
      </a>

      <a href="view.php?q=mentor">
        <li>
          <img src="./images/knowledge.svg" alt="mentores" />
          <br>
          Mentores
        </li>
      </a>

      <a href="view.php?q=responsavel">
        <li>
          <img src="./images/people.svg" alt="responsaveis" />
          <br>
          Responsáveis de área
        </li>
      </a>

    </ul>
  </div>
</div>

<script type="text/javascript">

  $("#left-nav a").click(function() {
     // remove classes from all
     $("#left-nav li").removeClass("active");
     // add class to the one we clicked
     $(this li).addClass("active");
  });

</script>
