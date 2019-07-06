<!-- esse -->

<?php
   if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
    }
    
    include "comunicacao/menu.php";

    unset( $_SESSION["produtos"] );

    echo "<script>alert('Pedido Cancelado com Sucesso'); location.href='home.php';</script>";

?>