<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3>Lista de Pedidos </h3><br>	
	<thead>
		<tr>
			<td><b>Id do Pedido</b></td>
			<td><b>Vendedor</b></td>
			<td><b>Cliente</b></td>
			<td><b>Mesa</b></td>
			<td><b>Data</b></td>
			<td><b>Total</b></td>
			<td><b>Opções</b></td>
		</tr>
	</thead>
</div>
<?php

//conectar no banco
include "comunicacao/conecta.php";
//include "comunicacao/validaFunc.php";
//selecionar todos
$sql = "SELECT p.*, u.nome nomeusu, c.nome nomecliente from pedido p INNER JOIN usuario u ON(p.idusuario = u.idusuario)
INNER JOIN cliente c ON(p.idcliente = c.idcliente)";
$consulta = $pdo->prepare($sql);
$consulta->execute();
//listar todos os pedidos
while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
	//separar os dados
	$idpedido          = $dados->idpedido;
	$nomeusu           = $dados->nomeusu;
	$nomecliente       = $dados->nomecliente;
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
	if ($_SESSION["sistema"]["idtipousuario"] == 1) {
	echo "<tr>
			<td>$idpedido</td>
			<td>$nomeusu</td>
			<td>$nomecliente</td>
			<td>$idmesa</td>
			<td>$datahora_inclusao</td>
			<td>R$ $total_bruto</td>
			<td>
				<a href='home.php?op=listar&pg=lispedido&idpedido=$idpedido' class='btn btn-outline-primary'>
					<i class='fa fa-search'></i>
				</a>
			</td>
		</tr>";

} else 	if ($_SESSION["sistema"]["idtipousuario"] == 2) {
	echo "<tr>
			<td>$idpedido</td>
			<td>$nomeusu</td>
			<td>$nomecliente</td>
			<td>$idmesa</td>
			<td>$datahora_inclusao</td>
			<td>R$ $total_bruto</td>
			<td>
				<a href='homefuncionario.php?op=listar&pg=lispedido&idpedido=$idpedido' class='btn btn-outline-primary'>
					<i class='fa fa-search'></i>	 
				</a>
			</td>
		</tr>";
}
}
?>

</table>
<br>
<?php
if ($_SESSION["sistema"]["idtipousuario"] == 1) {
		echo "<a href='home.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	} else if ($_SESSION['sistema']['idtipousuario'] == 2) {
		echo "<a href='homefuncionario.php' class='btn btn-outline-success'><i class='fa fa-chevron-left'></i> Voltar</a>";
	}
?>
	