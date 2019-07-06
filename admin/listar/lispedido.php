
<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3 id="texto">Detalhe do Pedido </h3>	
	<thead>
		<tr>
			<td><b>ID do Pedido</b></td>
			<td><b>ID do Produto</b></td>
			<td><b>Quantidade</b></td>
			<td><b>Valor Unitário</b></td>
			<td><b>Valor Total</b></td>
		</tr>
	</thead>
	</div>

	<?php

		$idpedido = $idproduto = $qtde = $valor_unitario = $valor_total = "";
		$idpedido = $_GET['idpedido'];
		include "comunicacao/conecta.php";
		$sql = "SELECT it.*, p.nome FROM item_pedido it INNER JOIN produto p on(p.idproduto = it.idproduto) where it.idpedido = ?";

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1,$idpedido);
		$consulta->execute();
		
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
			//separar os dados
			$idpedido       = $dados->idpedido;
			$nome           = $dados->nome;
            $qtde           = $dados->qtde;
            $valor_unitario = $dados->valor_unitario;
            $valor_total    = $dados->valor_total;
			$valor_total    = number_format($valor_total, 2, ",", '.');
				  
			//formar uma linha da tabela
			echo "<tr>
					<td>$idpedido</td>
					<td>$nome</td>
                    <td>$qtde</td>
                    <td>$valor_unitario</td>
					<td>R$ $valor_total</td>
				</tr>";
		}	
	?>
</table><br>
<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a href='home.php?op=listar&pg=pedido' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
		echo "<a href='homefuncionario.php?op=listar&pg=pedido' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	}
?>
	