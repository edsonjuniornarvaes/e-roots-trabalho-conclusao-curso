<?php  
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
	<table class="table-bordered table-striped" id="tb">
		<h3>Lista de Mesas</h3><br>
		
		<thead id="k">
			<tr>
				<td><i class=""></i> <b>Id</b></td>
				<td><i class=""></i> <b>nome</b></td>
				<td><i class=""></i> <b>Status</b></td>
				<td><i class=""></i> <b>Opções</b></td>
			</tr>
		</thead>
</div>

<?php

	include "comunicacao/conecta.php";
	
	$sql = "SELECT * FROM mesa ORDER BY idmesa";
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
		
		$idmesa = $dados->idmesa;
		$nome   = $dados->nome;
		$status = $dados->status;

		//formar uma linha da tabela
		echo "<tr>
				<td>$idmesa</td>
				<td>$nome</td>
				<td>$status</td>
				<td>

					<a href='home.php?op=cadastrar&pg=mesa&idmesa=$idmesa' class='btn btn-outline-success'>
					<i class='fa fa-edit'></i> 
					</a>

					<a href=\"javascript:excluir($idmesa)\" class='btn btn-outline-danger'>
						<i class='fa fa-trash'></i> 
					</a>
				</td>
			</tr>";
	}
?>
		</table>

<script type="text/javascript">

	function excluir(idmesa,nome) {

		if ( confirm( "Deseja realmente excluir "+idmesa+" ? ") ) {

			link = "home.php?pg=mesa&op=excluir&idmesa="+idmesa;

			location.href = link;
		}
	}
</script>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
