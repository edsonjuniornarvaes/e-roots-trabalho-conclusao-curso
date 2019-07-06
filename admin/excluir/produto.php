<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	$idproduto = "";
	if ( isset ( $_GET["idproduto"] ) ) {
		$idproduto = trim ( $_GET["idproduto"] );
	}

	$idproduto = (int)$idproduto;
	if ($idproduto == 0) {
		echo "<script>alert('Requisição inválida');history.back();</script>";
		exit;
	}

	include "comunicacao/conecta.php";

	$sql = "SELECT * FROM pedido 
			WHERE idproduto = ? 
			LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idproduto);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty( $dados->idproduto ) ) {
		echo "<script>
				swal('Oops','Esse Produto não pode ser Excluído, pois existe um Pedido anexado a ele','error');

				setTimeout(() => { 
				location.href='home.php?op=listar&pg=produto';
				}, 1000);
	 		 </script>";
exit;
	}

	$sql = "DELETE FROM produto 
			WHERE idproduto = ? 
			LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idproduto);

//verificar se excluiu mesmo
if ( $consulta->execute() ) {
	echo "<script>
			swal('Sucesso!','Registro Excluído com sucesso!','success');
			
			setTimeout(() => { 
				location.href='home.php?op=listar&pg=produto';
			}, 1000);
		 </script>";
exit;
	} else {
		//se não deu erro
		echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
		exit;
	}