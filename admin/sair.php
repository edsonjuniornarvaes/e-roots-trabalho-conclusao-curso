<?php 
	session_start();
	//apagar o que dentro da sessao sistema
	unset( $_SESSION["sistema"] );

	header("Location: index.php");