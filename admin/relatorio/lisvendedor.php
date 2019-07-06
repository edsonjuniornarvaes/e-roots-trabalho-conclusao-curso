<?php

	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}


$data1 = $_POST['data1'];
$data2 = $_POST['data2'];
$vendedor = $_POST['vendedor'];

if ($data1 > $data2) {
	echo "<script>alert('Período Inválido');history.back();</script>";
	exit;
} else {

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

?>


<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3 id="texto">Relatório de Vendas do Vendedor entre <?php echo "<b>[".$resultdata1."]</b>" ?> e <?php echo "<b>[".$resultdata2."]</b>" ?> </h3><br><br>
	<thead>
		<tr>
			<td><b>ID:</b></td>
			<td><b>Vendedor:</b></td>
            <td><b>Total Clientes:</b></td>
			<td><b>Total Vendas:</b></td>
		</tr>
	</thead>
	</div>

	<?php

		//conectar no banco
		include "comunicacao/conecta.php";
		//include "comunicacao/validaFunc.php";
		//selecionar todos os professores
	if (empty($vendedor)) {
		$sql = "select * from usuario where status = 'A' ";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();

		if($consulta->rowCount() > 0) {
			$dadosCol = $consulta->fetchAll();

			$resultdados = array();

			foreach ($dadosCol as $listCol) {

				$id = $listCol['idusuario'];

				$sql = "SELECT SUM(total_bruto) AS total_bruto, p.idusuario, u.nome, count(idcliente) idcliente FROM pedido p INNER JOIN usuario u on(p.idusuario = u.idusuario) 
				WHERE p.idusuario = ? ";
				$consulta = $pdo->prepare($sql);
				$consulta->bindParam(1, $id);
				$consulta->execute();

					$dados = $consulta->fetch(PDO::FETCH_OBJ);

					$resultdados[] = $array = array('idusuario' => $dados->idusuario, 'total_bruto' => $dados->total_bruto, 'nome' => $dados->nome, 'idcliente' => $dados->idcliente);

			}

		} else {
			echo '<script>alert("vazio");history.back();</script>';
		}

	}else {
		$sql = "SELECT SUM(total_bruto) AS total_bruto, p.idusuario, u.nome, count(idcliente) idcliente FROM pedido p INNER JOIN usuario u on(p.idusuario = u.idusuario) 
		WHERE p.idusuario = ? and p.datahora_inclusao BETWEEN ? AND ?
		order by p.idusuario desc limit 0,10";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $vendedor);
		$consulta->bindParam(2, $data1);
		$consulta->bindParam(3, $data2);
		$consulta->execute();
		$resultdados = $consulta->fetchAll();
	}
		
			
		//$sql = "SELECT p.*, m.nome marca, c.categoria FROM produto p INNER JOIN marca m on(p.idmarca = m.idmarca) 
		//INNER JOIN categoria c ON (p.idcategoria = c.idcategoria)";

		foreach ($resultdados as $list) {
			$total_bruto = $list['total_bruto'];
			$total_bruto = number_format($total_bruto, 2, ",", '.');

			?> 
			<tr>
					<td><?php echo $list['idusuario'];?></td>
                    <td><?php echo $list['nome'];?></td>
                    <td><?php echo $list['idcliente'];?></td> 
                    <td>R$ <?php echo $total_bruto;?></td>
				</tr>
			<?php
		}
		
		//listar todos os professores
		/*while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
			//separar os dados
				  $idusuario   = $dados->idusuario;
                  $nome        = $dados->nome;
                  $idcliente   = $dados->idcliente;
				  $total_bruto = $dados->total_bruto;
				  $total_bruto = number_format($total_bruto, 2, ",", '.');
				  
			//formar uma linha da tabela
			echo "<tr>
					<td>$idusuario</td>
                    <td>$nome</td>
                    <td>$idcliente</td> 
                    <td>R$ $total_bruto</td>
				</tr>";
		}	 */
		}	
	?>	
	
</table>
<br>
<a href="home.php?op=relatorio&pg=idxvendedor" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
