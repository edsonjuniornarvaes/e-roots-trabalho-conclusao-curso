<?php

include 'conecta.php';

// validação de login  -- ajax validaLogin

if (isset($_GET['acao']) && $_GET['acao'] == 'validaLogin') {
	$login = $_GET['login'];

	$sql = " SELECT login FROM usuario WHERE login = '$login' LIMIT 1";

	$consulta = $pdo->prepare($sql);

	if ($consulta->execute()) {
		$dados = $consulta->fetchAll();
		
		if ( isset ( $dados[0]['login'] ) ){
			echo "Existe";
		}  
	}
}
