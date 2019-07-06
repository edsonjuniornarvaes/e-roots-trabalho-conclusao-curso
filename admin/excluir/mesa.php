<?php
	//verifica se existe a variavel $pagina
	//$pagina esta sendo configurada no home.php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

	//recuperar o id
	$idmesa = "";
	if ( isset ( $_GET["idmesa"] ) ) {
		$idmesa = trim ( $_GET["idmesa"] );
	}

	//verificar se o id esta em branco ou se é inválido
	$idmesa = (int)$idmesa;
	if ($idmesa == 0) {
		//mensagem de erro
		echo "<script>alert('Requisição inválida');history.back();</script>";

		exit;
	}

	//incluir o conecta.php
	include "comunicacao/conecta.php";

	//verificar se o curso ligado a matricula
	$sql = "SELECT * FROM pedido WHERE idmesa = ? limit 1";
	$consulta = $pdo->prepare($sql);
	//passar o id como paramentro
	$consulta->bindParam(1,$idmesa);
	//executar
	$consulta->execute();
	//recuperar os dados se existem
	$dados = $consulta->fetch(PDO::FETCH_OBJ);
	//verifica se existe uma matricula para este curso
	if ( !empty( $dados->idmesa ) ) {
		echo "<script>
				swal('Oops','Essa Mesa não pode ser Excluída, pois existe um Pedido anexado a ela','error');

				setTimeout(() => { 
				location.href='home.php?op=listar&pg=mesa';
				}, 1000);
	 		 </script>";
exit;
	}

	//excluir o registro
	$sql = "DELETE FROM mesa WHERE idmesa = ? LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1,$idmesa);
	
//verificar se excluiu mesmo
if ( $consulta->execute() ) {
	echo "<script>
			swal('Sucesso!','Registro Excluído com sucesso!','success');
			
			setTimeout(() => { 
				location.href='home.php?op=listar&pg=mesa';
			}, 1000);
		 </script>";
exit;
	} else {
		//se não deu erro
		echo "<script>swal('Oops','Não foi possível Excluir Registro. ','error');</script>";
		exit;
	}