<?php
	/* Iniciando as variáveis */
	$idmesa = $nome = $status = "";

	if ( isset ( $_POST["idmesa"] ) )
		$idmesa = trim ( $_POST["idmesa"] );

	if ( isset ( $_POST["nome"] ) )
		$nome = trim ( $_POST["nome"] );

	if ( isset ( $_POST["status"] ) )
		$status = trim ( $_POST["status"] );

	//verificar se esta em branco
	if ( empty ( $nome ) ) {
		echo "<script> alert ('Faltou o nome'); history.back(); </script>";
		exit;
	} else if ( empty ( $status ) ) {
		echo "<script>alert('Selecione o status');history.back();</script>";
		exit;
	} else {
		include "comunicacao/conecta.php";
	if ( empty ( $idmesa ) ) {

		$sql = "INSERT INTO mesa (idmesa,nome,status) VALUES (NULL, ?, ?)";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam(1, $nome);
		$consulta->bindParam(2, $status);
	} else {
		$sql = "UPDATE mesa SET nome = ?, status = ? WHERE idmesa = ? LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $nome);
		$consulta->bindParam(2, $status);
		$consulta->bindParam(3, $idmesa);
		}
	}

	if ($consulta->execute()) {
		echo "<script>
				swal('Sucesso!','Registro salvo com sucesso!','success');
	
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=mesa';
				}, 1000);
			 </script>";
		exit;
	} else {
		//recuperar erro - array
		$erro = $consulta->errorInfo()[2];
	
		echo "<script>swal('Oops','Não foi possível salvar. ','error');</script>";
	
		//rollBack - voltar a 
		$pdo->rollBack();
		exit;
	}
	