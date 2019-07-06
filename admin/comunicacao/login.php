<?php

	session_cache_expire(5);
	session_start();

	//verificar se o usuário esta logado
	if (!isset($_SESSION["sistema"]["idusuario"])) {

		header("Location: index.php");
		
	}