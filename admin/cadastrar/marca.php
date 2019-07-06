<?php

   if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
    }

    include "comunicacao/conecta.php";
    //Declarando as variáveis
	$idmarca = $nome = $status = "";

    //Verificando se foi enviado id por get
	if ( isset ( $_GET["idmarca"] ) ) {

        //Recuperando idMarca
        $idmarca = trim ( $_GET["idmarca"] );
        
        //selecionar os dados do banco
        $sql = "SELECT * FROM marca WHERE idmarca = ? LIMIT 1";
        //Preparando a consulta
        $consulta = $pdo->prepare($sql);
        //Passar a var idCliente
        $consulta->bindParam(1, $idmarca);
        //Executar o sql
        $consulta->execute();
        
        //Recuperando os resultados obtidos
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        //Fazendo a verificação da existencia do cadastro
    if ( isset ( $dados->idmarca ) ) {
        $idmarca = $dados->idmarca;
		$nome    = $dados->nome;
		$status  = $dados->status;
        }
	}
?>

    <div class="container" id="formulario">
        <h3>Cadastro de Marca</h3><br>

        <form name="form1" method="post" action="home.php?op=salvar&pg=marca" data-parsley-validate>

        <!-- Primeira Linha -->
        <div class="form-row">

         <input type="hidden" class="form-control" name="idmarca" readonly value="<?=$idmarca;?>">

            <div class="form-group col-md-10">
                <label for="nome"><b>Marca</b></label>
                <input type="text" class="form-control" name="nome" value="<?=$nome;?>">
            </div>
            
            <div class="form-group col-md-2">
                <label for="status"><b>Status</b></label>
                <select id="status" name="status" class="form-control" required data-parsley-required-message=
                "Selecione uma opção" value="<?=$status;?>">
                    <option value=""><b>Selecione</b></option>
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
            </div>
        </div>
        <a href="home.php" class="btn btn-outline-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Cadastrar</button>
        </form>
    </div>
    <br><br>