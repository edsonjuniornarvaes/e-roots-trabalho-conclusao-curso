<?php

   if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
    }

    include "comunicacao/conecta.php";
    //Declarando as variáveis
	$idcategoria = $categoria = $status = "";

    //Verificando se foi enviado id por get
	if ( isset ( $_GET["idcategoria"] ) ) {

        //Recuperando id
        $idcategoria = trim ( $_GET["idcategoria"] );
        
        //selecionar os dados do banco
        $sql = "SELECT * FROM categoria WHERE idcategoria = ? LIMIT 1";
        //Preparando a consulta
        $consulta = $pdo->prepare($sql);
        //Passar a var idCliente
        $consulta->bindParam(1, $idcategoria);
        //Executar o sql
        $consulta->execute();
        
        //Recuperando os resultados obtidos
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        //Fazendo a verificação da existencia do cadastro
    if ( isset ( $dados->idcategoria ) ) {
        $idcategoria = $dados->idcategoria;
		$categoria   = $dados->categoria;
        $status      = $dados->status;
        
        }
	}
?>

    <div class="container" id="formulario">
        <h3>Cadastro de Categoria</h3><br>

        <form name="form1" method="post" action="home.php?op=salvar&pg=categoria" data-parsley-validate>

        <!-- Primeira Linha -->
        <div class="form-row">

            <input type="hidden" class="form-control" name="idcategoria" readonly value="<?=$idcategoria;?>">

            <div class="form-group col-md-10">
                <label for="categoria"><b>Categoria</b></label>
                <input type="text" class="form-control" name="categoria" value="<?=$categoria;?>">
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