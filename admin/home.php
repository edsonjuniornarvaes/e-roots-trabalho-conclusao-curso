<?php
include "comunicacao/login.php";


	//verificar se o usuário tem permissão
	if ($_SESSION["sistema"]["idtipousuario"] == 2) {
		echo "<script>alert('Acesso Negado!');location.href='homefuncionario.php';</script>";
	}
?>


<!DOCTYPE html>
<html>

<head>
  <title>E-Roots - [Administrador]</title>
  <meta charset="utf-8">

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="shortcut icon" href="../arquivos/imagens/icone.png">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
  <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> <!-- //maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link ajax -->
  <!--<link rel="stylesheet" href="css/jquery-ui.css"> -->
  <!-- https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css -->
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

  <!-- Css data table -->
  <style type="text/css">
    @import "css/jquery.dataTables.css";
  </style>

  <script src="js/jquery.min.js"></script> <!-- //cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js -->
  <script src="js/sweetalert.min.js"></script>



  <script type="text/javascript" src="js/functions.js"></script>

  <script src="js/jquery-ui.min.js"></script> <!-- https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js -->
  <script src="js/bootstrap.min.js"></script> <!-- //maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js -->

  <!-- Função para adicionar ao carrinho -->
  <script type="text/javascript" src="js/functions.js"></script>
  <script type="text/javascript" src="Add.js"></script>

  <!-- Botão que move a nav bar -->

  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>



  <!-- Máscaras -->
  <script type="text/javascript" src="js/bootstrap-inputmask.min.js"></script>
  <script type="text/javascript" src="js/jquery.maskMoney.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>

  <!-- trouxe -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!--https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js-->
  <script type="text/javascript" src="js/parsley.min.js"></script>
  <script type="text/javascript" src="js/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>

  <!-- Auto complete antigo 
	        <script type="text/javascript" src="js/jquery.easy-autocomplete.min.js"></script>
	        <link rel="stylesheet" type="text/css" href="css/easy-autocomplete.min.css"> -->

  <script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script> <!-- https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js -->
  <link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css" /> <!-- https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css -->

  <script type="text/javascript" src="js/custom.js"></script>
  <!-- ínicio data table -->
  <script>
    $(document).ready(function() {
      $('#tb').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ],
        /* Tradução data table */
        "language": {
          "EmptyTable": "Nenhum registro encontrado",
          "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 até 0 de 0 registros",
          "infoFiltered": "(Filtrados de _MAX_ registros)",
          "infoPostFix": "",
          "infoThousands": ".",
          "lengthMenu": "_MENU_ Resultados por página",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "zeroRecords": "Nenhum registro encontrado",
          "search": "Pesquisar",
          "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
          }
        },
        /* ícones de próx, última pag... */
        "pagingType": "full_numbers"
      });
    });
  </script>
  <!-- fim data table -->
</head>

<body>
  <!-- Menu Lateral / Navbar -->
  <div id="menulat" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark" id="admin">
      <!--  style="background-color:rgb(19, 1, 1) !important;" -->
      <!-- ícone do menu lateral -->
      <span class="navbar-toggler-icon leftmenutrigger"></span>

<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a class='navbar-brand mx-auto' href='home.php' style='color:yellow; vertical-align:text-top;'>
    <img src='../arquivos/imagens/logo1.png' id='alogo'> E-Roots</a>";

	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {

		echo "<a class='navbar-brand' href='homefuncionario.php' style='color:yellow; vertical-align:text-top;'>
    <img src='../arquivos/imagens/logo1.png' id='alogo'> E-Roots</a>";	
  }
?>
	
<!-- 
      <a class="navbar-brand" href="/eroots/admin/home.php" style="color:yellow; vertical-align:text-top;">
        <img src="../arquivos/imagens/logo1.png" id="alogo"> E-Roots</a> -->
      <!-- fim do ícone lateral -->

      <!-- Inicio Nav Lateral  -->
      <div class="collapse navbar-collapse" id="navbarlat">
        <ul class="navbar-nav animacao side-nav">
          <!--<li class="nav-item">
              <a class="nav-link" href="/eroots/admin/home.php"><i class="fa fa-home" id="white"></i>
                  Início
                  <span class="sr-only">(current)</span>
              </a>
            </li> -->
          <li class="nav-item">
            <button class="accordion"><b>Cadastrar</b></button>
            <div class="panel">
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=usuario">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Usuário </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=cliente">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Cliente </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=produto">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Produto </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=marca">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Marca </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=categoria">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Categoria </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=cadastrar&pg=mesa">
                <i class="fa fa-plus-square"></i>
                <label for="ir"><b> Mesa </b></label>
              </a>
            </div>

            <button class="accordion"><b>Listar</b></button>
            <div class="panel">
              <a class="text-xs-center" href="home.php?op=listar&pg=usuario">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Usuário </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=listar&pg=cliente">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Cliente </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=listar&pg=produto">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Produto </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=listar&pg=marca">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Marca </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=listar&pg=categoria">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Categoria </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=listar&pg=mesa">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Mesa </b></label>
              </a>
            </div>

            <button class="accordion"><b>Relatório</b></button>
            <div class="panel">
              <a class="text-xs-center" href="home.php?op=relatorio&pg=idxpedidos">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Pedidos </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=relatorio&pg=idxmaisvendidos">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Mais Vendidos </b></label><br>
              </a>
              <a class="text-xs-center" href="home.php?op=relatorio&pg=idxvendedor">
                <i class="fa fa-list-ol"></i>
                <label for="ir"><b> Vendedor </b></label><br>
              </a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-user-circle" id="white"></i> <?php echo ($_SESSION["sistema"]["nome"]) ?></a>
          </li>
          <li class="nav-item">

          </li>
          <li class="nav-item">
            <a class="nav-link" href="sair.php">
              <i class="fa fa-power-off" id="white"></i> Sair
            </a>
          </li>
        </ul>

      </div>
      <!-- Fim Nav Lateral -->
    </nav>

  </div>
  <main class="container tela">
    <?php

    $op = $pg = "";
    //recuperar o op
    if (isset($_GET["op"])) {
      $op = trim($_GET["op"]);
    }
    if (isset($_GET["pg"])) {
      $pg = trim($_GET["pg"]);
    }

    //echo "Conteudo do op e do pg: $op $pg";

    if (empty($pg)) {
      $pagina = "dashboard.php";
    } else {
      $pagina = $op . "/" . $pg . ".php";
    }

    //verificar se o arquivo existe
    if (file_exists($pagina)) {
      include $pagina;
    }

    ?>
  </main>
</body>

<!-- script da função de mover a nav lateral -->
<script text="text/javascript">
  $(document).ready(function() {
    $('.leftmenutrigger').on('click', function(e) {
      $('.side-nav').toggleClass("abrir");
      e.preventDefault();
    });
  });
</script>

<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
</script>

</html>