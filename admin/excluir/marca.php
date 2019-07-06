<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	$idcategoria = "";
	if ( isset ( $_GET["idmarca"] ) ) {
		$idmarca = trim ( $_GET["idmarca"] );
	}

	$idmarca = (int)$idmarca;
	if ($idmarca == 0) {
		echo "<script>alert('Requisição inválida');history.back();</script>";
		exit;
	}

	include "comunicacao/conecta.php";

	$sql = "SELECT * FROM produto WHERE idmarca = ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idmarca);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty( $dados->idproduto ) ) {
		echo "<script>
				swal('Oops','Essa Marca não pode ser Excluída, pois existe um Produto anexado a ela','error');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=marca';
				}, 1000);
	 		  </script>";
		exit;
	}

	$sql = "DELETE FROM marca WHERE idmarca = ? LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idmarca);

//verificar se excluiu mesmo
if ( $consulta->execute() ) {
	echo "<script>
			swal('Sucesso!','Registro Excluído com sucesso!','success');
			
			setTimeout(() => { 
				location.href='home.php?op=listar&pg=marca';
			}, 1000);
		 </script>";
exit;
	} else {
		//se não deu erro
		echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
		exit;
	}