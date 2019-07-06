<?php
    if ( !isset ( $pagina ) ) {
        echo "<h1>Acesso negado</h1>";
        exit;
    }

    include "comunicacao/conecta.php";
    $idproduto = $nome = $descricao = $preco = $status = $idmarca = $idcategoria = "";

	if ( isset ( $_GET["idproduto"] ) ) {
        $idproduto = trim ( $_GET["idproduto"] );
        $sql = "SELECT * FROM produto WHERE idproduto = ? LIMIT 1";
            
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idproduto);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
    if ( isset ( $dados->idproduto ) ) {

            $idproduto    = $dados->idproduto;
            $nome         = $dados->nome;
            $descricao    = $dados->descricao;
            $preco        = $dados->preco;
            $status       = $dados->status;
            $idmarca      = $dados->idmarca;
            $idcategoria  = $dados->idcategoria;
        }
    }
?>

    <!-- Auto increment do id -->

    <div class="container" id="formulario">
        <h3>Cadastro de Produto</h3><br>

        <form name="form1" method="post" action="home.php?op=salvar&pg=produto" data-parsley-validate>

        <!-- Primeira Linha -->
        <div class="form-row">
                    <label for="idproduto"></label>
                    <input type="hidden" class="form-control" name="idproduto" readonly value="<?=$idproduto;?>">

            <div class="form-group col-md-2">
                    <label for="idcategoria"><b>Categoria</b></label>
                    <select name="idcategoria" id="idcategoria" class="idcategoria js-states form-control" required
                            data-parsley-required-message="Selecione uma Categoria" value="<?=$idcategoria;?>">
                        <option value=""><b>Selecione</b></option>
                        <?php
                            $consulta = $pdo->prepare("SELECT idcategoria,categoria FROM categoria ORDER BY categoria");
                            $consulta->execute();
                            while ($a = $consulta->fetch(PDO::FETCH_OBJ)) {

                                echo "<option value='$a->idcategoria'>$a->categoria</option>";
                            }
                        ?>
                        </select>
                </div>

            <div class="form-group col-md-2">
                <label for="idmarca"><b>Marca</b></label>
                <select name="idmarca" id="idmarca" class="idmarca js-states form-control" required
                         data-parsley-required-message="Selecione uma Marca">
                    <option value=""><b>Selecione</b</option>

                    <?php
                        $consulta = $pdo->prepare("SELECT idmarca,nome FROM marca ORDER BY nome");
                        $consulta->execute();
                        while ($a = $consulta->fetch(PDO::FETCH_OBJ)) {

                            echo "<option value='$a->idmarca'>$a->nome</option>";
                        }
                    ?>

                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="nome"><b>Nome do Produto</b></label>
                <input type="text" class="form-control" name="nome" value="<?=$nome;?>">
            </div>
            <div class="form-group col-md-2">
                <label for="preco"><b>Preço</b></label>
                <input type="text" class="form-control" name="preco" value="<?=$preco;?>">
            </div>
            <div class="form-group col-md-2">
                <label for="status"><b>Status</b></label>
                <select id="status" name="status" class="form-control" required data-parsley-required-message="Selecione uma opção"
                value="<?=$status;?>">
                <option value=""><b>Selecione</b></option>
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
                <script>
			        $("#status").val("<?=$status;?>")
		        </script>
            </div>
        </div>
        
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="descricao"><b>Descrição</b></label>
                <input type="text" class="form-control" maxlength="20" name="descricao" value="<?=$descricao;?>">
            </div>
        </div>
        
        <!-- Segunda Linha --> 
            <div class="form-row">
                <div class="form-group col-md-12">
                <a href="home.php" class="btn btn-outline-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Cadastrar</button>
                </div>
            </div>
        </form>
    </div>