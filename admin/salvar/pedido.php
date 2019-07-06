<?php

include '../comunicacao/conecta.php';

session_start();


if ((int) $_GET['idcliente'] > 0) {
	$idcliente = $_GET['idcliente'];
} else {
	$idcliente = 999;
}

$idmesa = (int) $_GET['idmesa'];
$idusuario = (int) $_SESSION['sistema']['idusuario'];
$liquido = $_GET['liquido'];
$bruto = $_GET['liquido'];

// ver se esta recebendo corretamente
//echo "Cliente: $idcliente , Mesa: $idmesa , Usuario: $idusuario , Valor: $liquido ";


$sql = "insert into pedido 
					(idpedido,idcliente,idusuario,idmesa,idtipopagamento,datahora_inclusao,datahora_baixa,status,total_liquido,total_bruto)
					values (null,$idcliente,$idusuario,$idmesa,NULL, current_timestamp ,NULL,'F','$liquido','$bruto')";

$grava = $pdo->prepare($sql);



//var_dump($sql_caixa);

if ($grava->execute()) {

	// buscar o ultimo idpedido
	$sql_ultid = "SELECT max(idpedido) as idpedido FROM pedido";

	$consulta_idpedido = $pdo->prepare($sql_ultid);
	$consulta_idpedido->execute();
	$idpedido = $consulta_idpedido->fetchAll();
	$idpedido = $idpedido[0]['idpedido'];

	foreach ($_SESSION['carrinho'] as $c) {
		$idproduto = (int) $c['idproduto'];
		$qtde = (int) $c['qtd'];

		$sqlValor = "SELECT preco FROM produto WHERE idproduto = $idproduto limit 1";
		$val = $pdo->prepare($sqlValor);
		$valor =  $val->execute();
		$valor = $val->fetchAll();

		$valorUnitario = $valor[0]['preco'];
		$valorTotal = $c['qtd'] * $valor[0]['preco'];

		$sqlProduto = " insert into item_pedido (iditempedido,idproduto,idpedido,qtde,valor_unitario,valor_total) 
								values (null,$idproduto,$idpedido,$qtde,'$valorUnitario','$valorTotal') ";

		$gravaProduto = $pdo->prepare($sqlProduto);

		//var_dump($sqlProduto);

		if ($gravaProduto->execute()) {

			$sqlMesa = "UPDATE mesa SET status = 'O' WHERE idmesa = $idmesa ";
			$gravaMesa = $pdo->prepare($sqlMesa);
			if ($gravaMesa->execute()) {
				$_SESSION['carrinho'] = array();
				echo "Gravou!!";
			} else {
				echo "Deu Ruim";
			}
		} else {
			echo 'Deu Ruim.';
		}
	}
}
