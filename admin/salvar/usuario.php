<?php

$idusuario = $nome = $login = $senha = $status = $idtipousuario = "";

if (isset($_POST["idusuario"]))
	$idusuario = trim($_POST["idusuario"]);

if (isset($_POST["nome"]))
	$nome = trim($_POST["nome"]);

if (isset($_POST["login"]))
	$login = trim($_POST["login"]);

if (isset($_POST["senha"]))
	$senha = trim($_POST["senha"]);

if (isset($_POST["status"]))
	$status = trim($_POST["status"]);

if (isset($_POST["idtipousuario"]))
	$idtipousuario = trim($_POST["idtipousuario"]);

//Verificação para ver se está em branco
if (empty($nome)) {
	echo "<script>swal('Atenção''Favor preencher o nome','warning');history.back();</script>";
	exit;
} else  if ((empty($login)) and (empty($idusuario))) {
	echo "<script>swal('Favor preencher o login','warning');history.back();</script>";
	exit;
if (isset($_POST["idtipousuario"]))
		$idtipousuario = trim($_POST["idtipousuario"]);
} else if ((empty($senha)) and (empty($idusuario))) {
	echo "<script>swal('Atenção','Favor preencher a senha','warning');history.back();</script>";
	exit;
} else if (empty($status)) {
	echo "<script>swal('Atenção','Favor preencher o status','warning');history.back();</script>";
	exit;
} else if (empty($idtipousuario)) {
	echo "<script>swal('Atenção','Favor preencher o tipo do usuário','warning');history.back();</script>";
	exit;
} else {

	include "comunicacao/conecta.php";

	// se não tiver idusuario passando é porque é insert 
	if (empty($idusuario)) {

		$sql = "INSERT INTO usuario 
					(idusuario,nome,login,senha,status,idtipousuario)
					values (NULL, ?, ?, ?, ?, ?)";

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $nome);
		$consulta->bindParam(2, $login);
		$consulta->bindParam(3, $senha);
		$consulta->bindParam(4, $status);
		$consulta->bindParam(5, $idtipousuario);
		
	} else {

		//Update
		$sql = "UPDATE usuario SET nome = ?, status = ?, idtipousuario = ? WHERE idusuario = ? LIMIT 1";

		$consulta = $pdo->prepare($sql);

		$consulta->bindParam(1, $nome);
		$consulta->bindParam(2, $status);
		$consulta->bindParam(3, $idtipousuario);
		$consulta->bindParam(4, $idusuario);
	}
}


if ($consulta->execute()) {
	echo "<script>
			swal('Sucesso!','Registro salvo com sucesso!','success');

			setTimeout(() => { 
				location.href='home.php?op=listar&pg=usuario';
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
