<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
		<table class="table-bordered table-striped" id="tb">
			<h3>Busca Preço</h3><br>
			<thead id="k">
				<tr>
					<td><i class=""></i><b> Id do Produto</b></td>
					<td><i class=""></i><b> Produto</b></td>
					<td><i class=""></i><b> Marca</b></td>
					<td><i class=""></i><b> Descrição</b></td>
					<td><i class=""></i><b> Preço</b></td>
					<td><i class=""></i><b> Categoria </b></td>
					<td><i class=""></i><b> Status</b></td>
				</tr>
			</thead>
	</div>

		<?php
			include "comunicacao/conecta.php";
			
			$sql = "SELECT p.*, m.nome marca, c.categoria FROM produto p INNER JOIN marca m on(p.idmarca = m.idmarca) 
					INNER JOIN categoria c ON (p.idcategoria = c.idcategoria)";

			$consulta = $pdo->prepare($sql);
			$consulta->execute();
			while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {

				$idproduto = $dados->idproduto;
				$nome      = $dados->nome;
				$nomemarca = $dados->marca;
				$descricao = $dados->descricao;
                $preco 	   = $dados->preco;
                $preco     = number_format($preco, 2, ",", '.');
				$categoria = $dados->categoria;
				$status    = $dados->status;

				echo "<tr>
						<td>$idproduto</td>
						<td>$nome</td>
						<td>$nomemarca</td>
						<td>$descricao</td>
						<td>R$ $preco</td>
						<td>$categoria</td>
						<td>$status</td>
					</tr>";
			}
		?>
	</table><br>
	
<br><br>
<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a href='home.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
		echo "<a href='homefuncionario.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	}
?>
	