<?php
include "comunicacao/login.php";
?>

<!DOCTYPE html>
<html>

<head>
  <title>E-Roots - [Funcionário]</title>
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

  <!-- PDF -->
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/jszip.min.js"></script> 
  <script src="js/pdfmake.min.js"></script> 
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>

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

   <!-- Menu Lateral / Navbar -->
   <div id="menulat" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark" id="func">
      <!--  style="background-color:rgb(19, 1, 1) !important;" -->
      <!-- ícone do menu lateral -->
      <?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a class='navbar-brand' href='home.php' style='color:yellow; vertical-align:text-top;'>
    <img src='../arquivos/imagens/logo1.png' id='alogo'> E-Roots</a>";

	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {

		echo "<a class='navbar-brand' href='homefuncionario.php' style='color:yellow; vertical-align:text-top;'>
    <img src='../arquivos/imagens/logo1.png' id='alogo'> E-Roots</a>";	
  }
?>
	
      <!-- fim do ícone lateral -->
      <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-user-circle" id="white"></i> <?php echo ($_SESSION["sistema"]["nome"]) ?></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="sair.php">
              <i class="fa fa-power-off" id="white"></i> Sair
            </a>
          </li>
        </ul>
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
      $pagina = "dashboard2.php";
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