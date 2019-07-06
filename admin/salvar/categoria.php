<?php
	/* Declarando as variáveis */
	$idcategoria = $categoria = $status = "";

	if ( isset ( $_POST["idcategoria"] ) )
		$idcategoria = trim ( $_POST["idcategoria"] );
		
	if ( isset ( $_POST["categoria"] ) )
		$categoria = trim ( $_POST["categoria"] );

    if ( isset ( $_POST["status"] ) )
		$status = trim ( $_POST["status"] );
	
	if ( empty ( $categoria ) ) {
		echo "<script>alert('Faltou a Categoria');history.back();</script>";
		exit;

	} else if ( empty ( $status ) ) {
		echo "<script>alert('Selecione o status');history.back();</script>";
		exit;
		
	} else {

		include "comunicacao/conecta.php";

	if ( empty ( $idcategoria ) ) {

		$sql = "INSERT INTO categoria 
				(idcategoria,categoria,status) 
				VALUES (NULL, ?, ?)";

		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam(1, $categoria);
		$consulta->bindParam(2, $status);

	} else {

		$sql = "UPDATE categoria 
				SET categoria = ?, status = ? 
				WHERE idcategoria = ? 
				limit 1";

		$consulta = $pdo->prepare($sql);

		$consulta->bindParam(1, $categoria);
		$consulta->bindParam(2, $status);
		$consulta->bindParam(3, $idcategoria);

		}
	}

	if ($consulta->execute()) {
		echo "<script>
				swal('Sucesso!','Registro salvo com sucesso!','success');
	
				setTimeout(() => { 
					location.href='home.php?op=listar&pg=categoria';
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
	
