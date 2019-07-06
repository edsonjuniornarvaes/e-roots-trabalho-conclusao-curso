<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
	<table class="table-bordered table-striped" id="tb">
		<h3>Lista de Marcas</h3><br>

		<thead id="k">
			<tr>
				<td><i class=""></i><b> Id</b></td>
				<td><i class=""></i><b> Nome</b></td>
				<td><i class=""></i><b> Status</b></td>
				<td><i class=""></i><b> Opções</b></td>
			</tr>
		</thead>

<?php

	include "comunicacao/conecta.php";
	
	$sql = "SELECT * FROM marca";

	
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {

		$idmarca = $dados->idmarca;
		$nome    = $dados->nome;
		$status  = $dados->status;

		echo "<tr>
				<td>$idmarca</td>
				<td>$nome</td>
				<td>$status</td>
				<td>
					<a href='home.php?op=cadastrar&pg=marca&idmarca=$idmarca' class='btn btn-outline-success'>
						<i class='fa fa-edit'></i>
					</a>
					<a href=\"javascript:excluir($idmarca)\" class='btn btn-outline-danger'>
						<i class='fa fa-trash'></i>
					</a>
				</td>
			</tr>";
	}
?>

	</table>

<script type="text/javascript">
	function excluir(idmarca,nome) {
		if ( confirm( "Deseja realmente excluir "+nome+" ? ") ) {
			link = "home.php?pg=marca&op=excluir&idmarca="+idmarca;
			location.href = link;
		}
	}
	
</script>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
