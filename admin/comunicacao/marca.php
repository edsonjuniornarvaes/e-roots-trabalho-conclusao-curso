<?php
	session_start();
	if ( !isset ( $_SESSION["sistema"]["idUsuario"]) ) {
		exit;
	}
    include "conecta.php";
    
    $marca = $_GET['q'];

	//selecionar os clientes
    $sql = "select * from marca where nomeMarca like '%$nomeMarca%'";
    
	$consulta = $pdo->prepare( $sql );
	$consulta->execute();
	//iniciar o array
	$marca[] = array();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)){

		$marca[] = $dados['nomeMarca'];

	}
	//transformando array em json
	echo json_encode($marca);
