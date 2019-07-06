<?php

    if ( !isset ( $pagina ) ) {
        echo "<h1>Acesso negado</h1>";
        exit;
    }

    include "comunicacao/conecta.php";
    include "comunicacao/validaFunc.php";

    $idcliente = $nome = $cpf = $data_nascimento = $endereco = $email = $numero_casa = $telefone = 
    $status = $cep = $bairro = $cidade = $uf = "";

    //Selecionando do banco um id por GET se tiver sido enviado
    if ( isset ( $_GET["idcliente"] ) ) {
        //Recuperando idCliente
        $idcliente = trim ( $_GET["idcliente"] );
        //selecionar os dados do banco
        $sql = "SELECT *, DATE_FORMAT(data_nascimento,'%d/%m/%Y') data_nascimento 
                FROM cliente 
                WHERE idcliente = ? 
                LIMIT 1";

        //Preparando a consulta   
        $consulta = $pdo->prepare($sql);
        //Passar a var idcliente
        $consulta->bindParam(1, $idcliente);
        //Executar o sql
        $consulta->execute();

        //Recuperando os resultados obtidos
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

    //Fazendo a verificação da existencia do cadastro
    if ( isset ( $dados->idcliente ) ) {

        $idcliente       = $dados->idcliente;
        $nome            = $dados->nome;
        $cpf             = $dados->cpf;
        $data_nascimento = $dados->data_nascimento; 
        $endereco        = $dados->endereco;
        $email           = $dados->email;
        $numero_casa     = $dados->numero_casa;
        $telefone        = $dados->telefone;
        $status          = $dados->status;
        $cep             = $dados->cep;
        $bairro          = $dados->bairro;
        $cidade          = $dados->cidade;
        $uf              = $dados->uf;
        }
    }
?>

   <!-- id do Cliente ocultado -->
    <input type="hidden" name="idcliente" class="form-control" readonly value="<?=$idcliente;?>">

    <div class="container" id="formulario">
        <h3>Cadastro de Cliente</h3><br>

        <?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<form name='form1' method='post' action='home.php?op=salvar&pg=cliente' data-parsley-validate>";
	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
		echo "<form name='form1' method='post' action='homefuncionario.php?op=salvar&pg=cliente' data-parsley-validate>";
	}
?>

         <!-- Primeira Linha -->
        <div class="form-row">
        <input type="hidden" name="idcliente" class="form-control" readonly value="<?=$idcliente;?>">

        <div class="form-group col-md-8">
            <label for="nome"><b>Nome</b></label>
            <input type="text" class="form-control" name="nome" id="nomecliente" value="<?=$nome;?>">
        </div>
        <div class="form-group col-md-2">
            <label for="data_nascimento"><b> Data de Nascimento</b></label>
            <input type="date" value="<?=$data_nascimento;?>" name="data_nascimento" id="data_nascimento" class="form-control"
                   required data-parsley-required-message="Informe a data de nascimento">
        </div>
        <div class="form-group col-md-2">
            <label for="cpf"><b>CPF</b></label>
            <input type="text" class="form-control" name="cpf" id="cpf" data-mask="999.999.999-99" value="<?=$cpf;?>">
        </div>
        </div>
        <!-- Segunda Linha -->
        <div class="form-row">
        <div class="form-group col-md-2">
            <label for="telefone"><b>Telefone</b></label>
            <input type="text" name="telefone" class="form-control" id="telefone" data-mask="(99) 9 9999-9999" value="<?=$telefone;?>">
        </div>
        <div class="form-group col-md-4">
            <label for="email"><b>E-mail</b></label>
            <input type="email" name="email" class="form-control" required data-parsley-required-message="Preencha o e-mail"
                    data-parsley-type-message="Preencha corretamente o e-mail" value="<?=$email;?>">
        </div>
        <div class="form-group col-md-2">
            <label for="cep"><b>CEP</b></label>
            <input type="text" name="cep" class="form-control" id="cep" value="<?=$cep;?>">
        </div>
        <div class="form-group col-md-4">
            <label for="endereco"><b>Endereço</b></label>
            <input type="text" name="endereco" class="form-control" id="logradouro" value="<?=$endereco;?>">
        </div>
        </div>

        <!-- Terceira Linha -->
        <div class="form-row">
        <div class="form-group col-md-1">
            <label for="numero_casa"><b>Número</b></label>
            <input type="text" name="numero_casa" class="form-control" id="numero_casa" value="<?=$numero_casa;?>">
        </div>
        <div class="form-group col-md-4">
            <label for="bairro"><b>Bairro</b></label>
            <input type="text" name="bairro" class="form-control" id="bairro" value="<?=$bairro;?>">
        </div>
        <div class="form-group col-md-4">
            <label for="cidade"><b>Cidade</b></label>
            <input type="text" name="cidade" class="form-control" id="localidade" value="<?=$cidade;?>">
        </div>
        <div class="form-group col-md-1">
            <label for="uf"><b>UF</b></label>
            <input type="text" name="uf" class="form-control" id="uf" value="<?=$uf;?>">
        </div>
        <div class="form-group col-md-2">
            <label for="status"><b>Status</b></label>
            <select id="status" name="status" class="form-control " required data-parsley-required-message= "Selecione uma opção" 
                    value="<?=$status;?>">
                <option value=""><b>Selecione</b></option> /* era selected*/
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        </div><hr>

<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
    echo "<a href='home.php' class='btn btn-outline-danger'><i class='fa fa-chevron-left'></i> Cancelar</a>";
} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
    echo "<a href='homefuncionario.php' class='btn btn-outline-danger'><i class='fa fa-chevron-left'></i> Cancelar</a>";
}
?>
            <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Cadastrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
		<script>
			/*
			 * Para efeito de demonstração, o JavaScript foi
			 * incorporado no arquivo HTML.
			 * O ideal é que você faça em um arquivo ".js" separado. Para mais informações
			 * visite o endereço https://developer.yahoo.com/performance/rules.html#external
			 */
			
			// Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
			// quando o usuário sair do campo "cep"
			$("#cep").blur(function(){
				// Remove tudo o que não é número para fazer a pesquisa
				var cep = this.value.replace(/[^0-9]/, "");
				
				// Validação do CEP; caso o CEP não possua 8 números, então cancela
				// a consulta
				if(cep.length != 8){
					return false;
				}
				
				// A url de pesquisa consiste no endereço do webservice + o cep que
				// o usuário informou + o tipo de retorno desejado (entre "json",
				// "jsonp", "xml", "piped" ou "querty")
				var url = "https://viacep.com.br/ws/"+cep+"/json/";
				
				// Faz a pesquisa do CEP, tratando o retorno com try/catch para que
				// caso ocorra algum erro (o cep pode não existir, por exemplo) a
				// usabilidade não seja afetada, assim o usuário pode continuar//
				// preenchendo os campos normalmente
				$.getJSON(url, function(dadosRetorno){
					try{
						// Preenche os campos de acordo com o retorno da pesquisa
						$("#logradouro").val(dadosRetorno.logradouro);
						$("#bairro").val(dadosRetorno.bairro);
						$("#localidade").val(dadosRetorno.localidade);
						$("#uf").val(dadosRetorno.uf);
					}catch(ex){}
				});
			});
		</script>
	