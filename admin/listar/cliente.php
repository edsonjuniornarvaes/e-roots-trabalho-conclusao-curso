<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3>Lista de Clientes</h3><br>
	<thead>
		<tr>
			<td><b>Id</b></td>
			<td><b>Nome</b></td>
			<td><b>CPF</b></td>
			<td><b>Telefone</b></td>
			<td><b>E-Mail</b></td>
			<td><b>Status</b></td>
			<td><b>Opções</b></td>
		</tr>
	</thead>
	</div>

	<?php
		//conectar no banco
		include "comunicacao/conecta.php";
		//selecionar todos os clientes
		$sql = "SELECT * FROM cliente ORDER BY nome";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();
		//listar todos os professores
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
			//separar os dados
			$idcliente = $dados->idcliente;
			$nome 	   = $dados->nome;
			$cpf 	   = $dados->cpf;
			$telefone  = $dados->telefone;
			$email	   = $dados->email;
			$status    = $dados->status;

			//formar uma linha da tabela
			if ($_SESSION["sistema"]["idtipousuario"] == 1) {
			echo "<tr>
					<td>$idcliente</td>
					<td>$nome</td>
					<td>$cpf</td>
					<td>$telefone</td>
					<td>$email</td>
					<td>$status</td>
					<td>
						<a href='home.php?op=cadastrar&pg=cliente&idcliente=$idcliente' class='btn btn-outline-success'>
							<i class='fa fa-edit'></i>
						</a>

						<a href=\"javascript:excluir($idcliente,'$nome')\" class='btn btn-outline-danger'>
							<i class='fa fa-trash'></i>
						</a>
					</td>
				</tr>";

			} else 	if ($_SESSION["sistema"]["idtipousuario"] == 2) {
				echo "<tr>
					<td>$idcliente</td>
					<td>$nome</td>
					<td>$cpf</td>
					<td>$telefone</td>
					<td>$email</td>
					<td>$status</td>
					<td>
						<a href='homefuncionario.php?op=cadastrar&pg=cliente&idcliente=$idcliente' class='btn btn-outline-success'>
							<i class='fa fa-edit'></i>
						</a>
					</td>
				</tr>";
			}
		}
	?>
	
</table>

	<script type="text/javascript">
		//funcao para perguntar se deseja excluir
		function excluir(idcliente,nome) {
			//pergunta e confirmar
			if ( confirm( "Deseja realmente excluir "+nome+" ? ") ) {
				//mandar excluir
				link = "home.php?pg=cliente&op=excluir&idcliente="+idcliente;
				//chamar o link
				location.href = link;
			}
		}
</script>
<br>
<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a href='home.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
		echo "<a href='homefuncionario.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	}
?>
	