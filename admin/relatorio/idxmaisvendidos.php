<?php
if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
}
    include "comunicacao/conecta.php";
?>

<div class="container" id="formulario">
<h3>Produtos mais Vendidos</h3><br>
    <form name="filteay" action="home.php?op=relatorio&pg=lismaisvendidos" method="POST">

    <div class="form-row">
            <div class="form-group col-md-6">
                <label for="data"><b>Data Início</b></label>
                <div class="controls">
                    <input type="date" name="data1" class="form-control">
                </div>
            </div>
                <br>
            <div class="form-group col-md-6">
                <label for="data"><b>Data Final</b></label>
                <div class="controls">
                    <input type="date" name="data2" class="form-control">
                </div>
            </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </form>
    </div>
</div>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
