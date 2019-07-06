<?php
if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
}
    include "comunicacao/conecta.php";
?>

<div class="container" id="formulario">
    <h3>Relatório do Vendedor</h3><br>
    <form name="filteay" action="home.php?op=relatorio&pg=lisvendedor" method="POST">

    <div class="form-row">
            <div class="form-group col-md-4">
                <label for="vendedor"><b>Vendedor</b></label>
                <select name="vendedor" id="vendedor" class="vendedor js-states form-control">
                    <option value=""><b>Todos</b></option>
                    <?php
                        $consulta = $pdo->prepare("SELECT idusuario,nome FROM usuario ORDER BY nome");
                        $consulta->execute();
                        while ($a = $consulta->fetch(PDO::FETCH_OBJ)) {

                            echo "<option value='$a->idusuario'>$a->nome</option>";
                        }
                    ?>
                    </select>
            </div>
            <div class="form-group col-md-4">
                <label for="data"><b>Data Início</b></label>
                <div class="controls">
                    <input type="date" name="data1" class="form-control" required>
                </div>
            </div>
                <br>
            <div class="form-group col-md-4">
                <label for="data"><b>Data Final</b></label>
                <div class="controls">
                    <input type="date" name="data2" class="form-control" required>
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
