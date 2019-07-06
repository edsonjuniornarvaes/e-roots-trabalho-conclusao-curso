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
<h3>Relatório de Pedidos <?php if ( !empty ($data1) && !empty($data2) ) { echo "entre <b>[".$resultdata1."]</b>" ?> e <?php echo "<b>[".$resultdata2."]</b>"; }?> </h3><br><br>		<thead>
		<tr>
			<td><b>Id do Pedido</b></td>
			<td><b>Vendedor</b></td>
			<td><b>Cliente</b></td>
			<td><b>Mesa</b></td>
			<td><b>Data</b></td>
			<td><b>Total</b></td>
		</tr>
	</thead>
	</div>

	<?php

		//conectar no banco
		include "comunicacao/conecta.php";

		if (!empty ($data1) && !empty($data2)) {

		//selecionar todos os
		$sql = "SELECT p.*, u.nome nomeusu, c.nome from pedido p INNER JOIN usuario u ON(p.idusuario = u.idusuario)
		INNER JOIN  cliente c ON(p.idcliente = c.idcliente) where p.datahora_inclusao  between ? and ?";
		}

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $data1);
		$consulta->bindParam(2, $data2);
		$consulta->execute();
		//listar todos os professores
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
			//separar os dados
			$idpedido          = $dados->idpedido;
			$nomeusu         = $dados->nomeusu;
            $nome         = $dados->nome;
            $idmesa 	       = $dados->idmesa;
			$datahora_inclusao = $dados->datahora_inclusao;
			$datahora_inclusao = explode("-", $datahora_inclusao);
						  $dia = $datahora_inclusao[2];
                          $mes = $datahora_inclusao[1];
				          $ano = $datahora_inclusao[0];
		    $datahora_inclusao = $dia . "/" . $mes . "/" . $ano;
				  $total_bruto = $dados->total_bruto;
				  $total_bruto = number_format($total_bruto, 2, ",", '.');
				  
			//formar uma linha da tabela
			echo "<tr>
					<td>$idpedido</td>
					<td>$nomeusu</td>
                    <td>$nome</td>
                    <td>$idmesa</td>
                    <td>$datahora_inclusao</td>
					<td>R$ $total_bruto</td>
				</tr>";
		}
	
		
	
	?>
	
</table>
<br>
<a href="home.php?op=relatorio&pg=idxpedidos" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
