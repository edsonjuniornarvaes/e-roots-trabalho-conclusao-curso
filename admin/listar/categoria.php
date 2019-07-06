<?php  
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
	<table class="table-bordered table-striped" id="tb">
		<h3>Lista de Categorias</h3><br>
		
		<thead id="k">
			<tr>
				<td><i class=""></i> <b>Id</b></td>
				<td><i class=""></i> <b>Categoria</b></td>
				<td><i class=""></i> <b>Status</b></td>
				<td><i class=""></i> <b>Opções</b></td>
			</tr>
		</thead>
</div>

<?php

	include "comunicacao/conecta.php";
	
	$sql = "SELECT * FROM categoria ORDER BY idcategoria";
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
		
		$idcategoria = $dados->idcategoria;
		$categoria   = $dados->categoria;
		$status      = $dados->status;

		//formar uma linha da tabela
		echo "<tr>
				<td>$idcategoria</td>
				<td>$categoria</td>
				<td>$status</td>
				<td>

					<a href='home.php?op=cadastrar&pg=categoria&idcategoria=$idcategoria' class='btn btn-outline-success'>
					<i class='fa fa-edit'></i> 
					</a>

					<a href=\"javascript:excluir($idcategoria)\" class='btn btn-outline-danger'>
						<i class='fa fa-trash'></i> 
					</a>
				</td>
			</tr>";
	}
?>
		</table>

<script type="text/javascript">

	function excluir(idcategoria,categoria) {

		if ( confirm( "Deseja realmente excluir "+idcategoria+" ? ") ) {

			link = "home.php?pg=categoria&op=excluir&idcategoria="+idcategoria;

			location.href = link;
		}
	}
</script>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
