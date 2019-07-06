<?php

   if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
    }

    include "comunicacao/conecta.php";
    //Declarando as variáveis
	$idmesa = $nome = $status = "";

    //Verificando se foi enviado id por get
	if ( isset ( $_GET["idmesa"] ) ) {

        //Recuperando id
        $idmesa = trim ( $_GET["idmesa"] );
        
        //selecionar os dados do banco
        $sql = "SELECT * FROM mesa WHERE idmesa = ? LIMIT 1";
        //Preparando a consulta
        $consulta = $pdo->prepare($sql);
        //Passar a var idCliente
        $consulta->bindParam(1, $idmesa);
        //Executar o sql
        $consulta->execute();
        
        //Recuperando os resultados obtidos
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        //Fazendo a verificação da existencia do cadastro
    if ( isset ( $dados->idmesa ) ) {
        $idmesa = $dados->idmesa;
		$nome   = $dados->nome;
		$status = $dados->status;
        }
	}
?>

    <div class="container" id="formulario">
        <h3>Cadastro de Mesa</h3><br>

        <form name="form1" method="post" action="home.php?op=salvar&pg=mesa" data-parsley-validate>

        <!-- Primeira Linha -->
        <div class="form-row">

            <input type="hidden" class="form-control" name="idmesa" readonly value="<?=$idmesa;?>">

            <div class="form-group col-md-10">
                <label for="nome"><b>Mesa</b></label>
                <input type="text" class="form-control" name="nome" value="<?=$nome;?>">
            </div>
            
            <div class="form-group col-md-2">
                <label for="status"><b>Status:</b></label>
                <select id="status" name="status" class="form-control" required data-parsley-required-message=
                "Selecione uma opção" value="<?=$status;?>">
                    <option value=""><b>Selecione</b></option>
                    <option value="D">Disponível</option>
                    <option value="O">Ocupada</option>
                </select>
            </div>
        </div>
            <a href="home.php" class="btn btn-outline-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Cadastrar</button>
        </form>
    </div>