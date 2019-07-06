<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	$data1 = $_POST['data1'];
	$data2 = $_POST['data2'];

if ($data1 > $data2) {
	echo "<script>alert('Período Inválido');history.back();</script>";
	exit;
} else {
	if (!empty ($data1) && !empty($data2)) {
		$resultdata1 = explode("-", $data1);
							$dia = $resultdata1[2];
							$mes = $resultdata1[1];
							$ano = $resultdata1[0];
				$resultdata1 = $dia . "/" . $mes . "/" . $ano;
		$resultdata2 = explode("-", $data2);
				$dia = $resultdata2[2];
				$mes = $resultdata2[1];
				$ano = $resultdata2[0];
		$resultdata2 = $dia . "/" . $mes . "/" . $ano;
	}
}

?>

<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3>Relatório de Produtos mais Vendidos <?php if ( !empty ($data1) && !empty($data2) ) { echo "entre <b>[".$resultdata1."]</b>" ?> e <?php echo "<b>[".$resultdata2."]</b>"; }?> </h3><br><br>	
	<thead>
		<tr>
			<td><b>Produto</b></td>
			<td><b>Quantidade</b></td>
		</tr>
	</thead>
	</div>

	<?php

		//conectar no banco
		include "comunicacao/conecta.php";
	
		if (!empty ($data1) && !empty($data2)) {

		//selecionar todos os 
		$sql = "SELECT SUM(qtde) AS qtde, p.nome FROM item_pedido it
		INNER JOIN produto p on it.idproduto = p.idproduto
		INNER JOIN pedido pe on pe.idpedido = it.idpedido
		where pe.datahora_inclusao between ? and ?
		GROUP BY it.idproduto order by it.qtde";

		} else {

		$sql = "SELECT SUM(qtde) AS qtde, p.nome FROM item_pedido it INNER JOIN produto p on(it.idproduto = p.idproduto)
		GROUP BY it.idproduto order by it.qtde ";
		
		}

		
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $data1);
		$consulta->bindParam(2, $data2);
		$consulta->execute();
		//listar todos os professores
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
			//separar os dados
			$nome = $dados->nome;
            $qtde      = $dados->qtde;
				  
			//formar uma linha da tabela
			echo "<tr>
					<td>$nome</td>
                    <td>$qtde</td>
				</tr>";
		}	
	?>

</table>
<br>
<a href="home.php?op=relatorio&pg=idxmaisvendidos" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
