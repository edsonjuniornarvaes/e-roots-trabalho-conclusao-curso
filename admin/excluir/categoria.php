<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	$idcategoria = "";

	if ( isset ( $_GET["idcategoria"] ) ) {
		$idcategoria = trim ( $_GET["idcategoria"] );
	}

	$idcategoria = (int)$idcategoria;

	if ($idcategoria == 0) {
		echo "<script>alert('Requisição inválida');history.back();</script>";
		exit;
	}

	include "comunicacao/conecta.php";

	$sql = "SELECT * FROM produto 
			WHERE idcategoria = ?
			LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $idcategoria);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty( $dados->idcategoria ) ) {
		echo "<script>
				swal('Oops','Essa Categoria não pode ser Excluída, pois existe um Produto anexado a ela','error');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=categoria';
				}, 1000);
	 		  </script>";
		exit;
	}

	$sql = "DELETE FROM categoria 
			WHERE idcategoria = ? 
			LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $idcategoria);

	//verificar se excluiu mesmo
	if ( $consulta->execute() ) {
		echo "<script>
				swal('Sucesso!','Registro Excluído com sucesso!','success');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=categoria';
				}, 1000);
	 		</script>";
	exit;
		} else {
			//se não deu erro
			echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
			exit;
		}
