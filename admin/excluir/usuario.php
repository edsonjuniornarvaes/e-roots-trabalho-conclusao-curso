<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	$idusuario = "";
	if ( isset ( $_GET["idusuario"] ) ) {
		$idusuario = trim ( $_GET["idusuario"] );
	}

	$idusuario = (int)$idusuario;
	if ($idusuario == 0) {
		echo "<script>alert('Requisição inválida');history.back();</script>";
		exit;
	}

	include "comunicacao/conecta.php";

	$sql = "SELECT * FROM pedido WHERE idusuario = ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idusuario);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty( $dados->idusuario ) ) {
		echo "<script>
				swal('Oops','Este Usuário não pode ser Excluído, pois existe um Pedido anexado a ele','error');
		
				setTimeout(() => { 
				location.href='home.php?op=listar&pg=usuario';
				}, 1000);

			  </script>";
		exit;
	}

	$sql = "DELETE FROM usuario WHERE idusuario = ? LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idusuario);
	
	//verificar se excluiu mesmo
	if ( $consulta->execute() ) {
		echo "<script>
				swal('Sucesso!','Registro Excluído com sucesso!','success');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=usuario';
				}, 1000);
	 		</script>";
exit;
	} else {
		//se não deu erro
		echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
		exit;
	}
