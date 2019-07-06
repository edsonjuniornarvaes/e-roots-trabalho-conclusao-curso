<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="formulario">
    <h3>Relatório de Pedidos por Período</h3><br>
    <form name="filteay" action="home.php?op=relatorio&pg=lispedidos" method="POST">

    <div class="form-row">

            <div class="form-group col-md-6">
                <label for="data"><b>Data Início</b></label>
                <div class="controls">
                    <input type="date" name="data1" class="form-control" required>
                </div>
                <br>
            </div>
            <div class="form-group col-md-6">
                <label for="data"><b>Data Final</b></label>
                <div class="controls">
                    <input type="date" name="data2" class="form-control" required>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </form>
    </div>
</div>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
