<?php
	//verifica se existe a variavel $pagina
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	//recuperar o id
	$idcliente = "";
	if ( isset ( $_GET["idcliente"] ) ) {
		$idcliente = trim ( $_GET["idcliente"] );
	}

	//verificar se o id esta em branco ou se é inválido
	$idcliente = (int)$idcliente;
	if ($idcliente == 0) {
		//mensagem de erro
		echo "<script>alert('Requisição inválida');history.back();</script>";

		exit;
	}

	//incluir o conecta.php
	include "comunicacao/conecta.php";

	//verificar se o curso ligado a matricula
	$sql = "SELECT * FROM pedido 
			WHERE idcliente = ? limit 1";
	$consulta = $pdo->prepare($sql);
	//passar o id como paramentro
	$consulta->bindParam(1,$idcliente);
	//executar
	$consulta->execute();
	//recuperar os dados se existem
	$dados = $consulta->fetch(PDO::FETCH_OBJ);
	//verifica se existe uma matricula para este curso
	if ( !empty( $dados->idcliente ) ) {
		echo "<script>
				swal('Oops','Este cliente não pode ser Excluído, pois existe um Pedido anexado a ele','error');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=cliente';
				}, 1000);
			  </script>";
		exit;
	}

	//excluir o registro
	$sql = "DELETE FROM cliente 
			WHERE idcliente = ? LIMIT 1";
			
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idcliente);
	
	//verificar se excluiu mesmo
	if ( $consulta->execute() ) {
		echo "<script>
				swal('Sucesso!','Registro Excluído com sucesso!','success');
				
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=cliente';
				}, 1000);
	 		</script>";
exit;
	} else {
		//se não deu erro
		echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
		exit;
	}
