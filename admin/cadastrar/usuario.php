<?php

if ( !isset ( $pagina ) ) {
    echo "<h1>Acesso negado</h1>";
    exit;
    }

 include "comunicacao/conecta.php";
	$idusuario = $nome = $login = $status = $idtipousuario = "";

	if ( isset ( $_GET["idusuario"] ) ) {

		$idusuario = trim ( $_GET["idusuario"] );
        $sql = "SELECT * FROM usuario WHERE idusuario = ? LIMIT 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idusuario);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
    if ( isset ( $dados->idusuario ) ) {
		$idusuario     = $dados->idusuario;
		$nome          = $dados->nome;
        $login         = $dados->login;
        $status        = $dados->status;
        $idtipousuario = $dados->idtipousuario;
        }
	}
?>

    <div class="container" id="formulario">
        <h3>Cadastro de Usuário</h3><br>

        <form name="form1" method="post" action="home.php?op=salvar&pg=usuario" data-parsley-validate>

        <!-- Primeira Linha -->
        <div class="form-row">
        <input type="hidden" name="idusuario" class="form-control" readonly value="<?=$idusuario;?>">

            <div class="form-group col-md-2">
                    <label for="idtipousuario"><b>Tipo</b></label>
                    <select name="idtipousuario" id="idtipousuario" class="idtipousuario js-states form-control" required
                            data-parsley-required-message="Selecione um Tipo"value="<?=$idtipousuario;?>">
                        <option value=""><b>Selecione</b></option>
                        <?php
                            $consulta = $pdo->prepare("SELECT idtipousuario,nome FROM tipo_usuario ORDER BY nome");
                            $consulta->execute();
                            while ($a = $consulta->fetch(PDO::FETCH_OBJ)) {

                                echo "<option value='$a->idtipousuario'>$a->nome</option>";
                            }
                        ?>
                    </select>
            </div>

            <div class="form-group col-md-4">
                <label for="nome"><b>Nome Completo</b></label>
                <input type="text" name="nome" id="nome" class="form-control" 
                       required data-parsley-required-message="Por favor, preencha o nome do usuário" value="<?=$nome;?>">
            </div>

            <!-- Se for editar, o login e senha desaparecem -->
            <!-- < ?php 

            if(empty($idusuario)) {
               echo "<div class='form-group col-md-2'>
                        <label for='login'><b>Login:</b></label>
                        <input type='text' name='login' class='form-control'id='validalogin' required data-parsley-required-message='Por favor, preencha o login'
                                        maxlength='14' onblur='verificaLogin(this.value)'
                        < ?php if (!empty('$login)) echo 'disabled';?>value='< ?=$login;?>'>
                      </div>
                      <div class='form-group col-md-2'>
                        <label for='senha'><b>Senha:</b></label>
                        <input type='password' name='senha' class='form-control' < ?php if (empty($login)) echo 'required';?> 
                                    data-parsley-required-message='Por favor, digite uma senha'>
                    </div>";
                }
            ? > -->

            <div class="form-group col-md-2">
                <label for="login"><b>Login</b></label>
                <input type="text" name="login" class="form-control" id="validalogin" required data-parsley-required-message="Por favor, preencha o login"
                value="<?=$login;?>" maxlength="14" onblur="verificaLogin(this.value)"
                <?php if (!empty($login)) echo 'disabled';?>">
            </div>
            
            <div class="form-group col-md-2">
                <label for="senha"><b>Senha</b></label>
                <input type="password" name="senha" class="form-control" value="<?=$login;?>" <?php if (empty($login)) echo "required";?> 
                       data-parsley-required-message="Por favor, digite uma senha">
            </div>
        
        <div class="form-group col-md-2">
            <label for="status"><b>Status</b></label>
            <select id="status" name="status" class="form-control" required data-parsley-required-message="Selecione uma opção"
                    value="<?=$status;?>">
                <option value=""><b>Selecione</b></option>
                <option value="A">Ativo</option>
                <option value="I ">Inativo</option>
            </select>
        </div>
        </div>
            <a href="home.php?op=listar&pg=usuario" class="btn btn-outline-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Cadastrar</button>
        </form>
    </div>