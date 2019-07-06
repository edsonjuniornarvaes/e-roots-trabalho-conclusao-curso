<?php
//iniciar a sessao
session_start();

//variavel na sessao para controlar as tentativas de acesso
if (isset($_SESSION["tentativas"])) {
	//somar mais 1 a tentativa
	$_SESSION["tentativas"]++;
} else {
	//se nao existir iniciar a variavel
	$_SESSION["tentativas"] = 1;
}

//se as tentativas forem > 10 bloqueia
if ($_SESSION["tentativas"] > 50) {
	echo "<p>Você tentou efetuar mais de 10 tentativas. Tente novamente mais tarde!</p>";
	exit;
}

//verificar se dados foram postados
if ($_POST) {

	$login = $senha = "";
	//verificar se o login e a senha foram enviados por post
	if (isset($_POST["login"]))
		$login = trim($_POST["login"]);
	if (isset($_POST["senha"]))
		$senha = trim($_POST["senha"]);

	//verificar se esta em branco
	if (empty($login)) {
		//mensagem de erro
		echo "<script>alert('Preencha o login');history.back();</script>";
		exit;
	} else if (empty($senha)) {
		//mensagem de erro
		echo "<script>alert('Preencha a senha');history.back();</script>";
		exit;
	} else {
		//se deu certo

		//incluir a conexão com o banco
		include "comunicacao/conecta.php";

		//sql para buscar o usuario
		$sql = "SELECT * FROM usuario WHERE LOGIN = ?  LIMIT 1";
		$consulta = $pdo->prepare($sql);
		//passar parametro login
		$consulta->bindParam(1, $login);
		//executar o sql
		$consulta->execute();
		//recuperar os dados do sql
		$dados = $consulta->fetch(PDO::FETCH_OBJ);


		//se trouxe algum resultado
		if (empty($dados->idusuario)) {

			echo "<script>alert('Usuário não encontrado');history.back();</script>";
		} else if ($dados->status != "A") {

			echo "<script>alert('Este usuário não está ativo');history.back();</script>";
		} else if (!password_verify($senha, $dados->senha)) {

			echo "<script>alert('Senha incorreta');history.back();</script>";
		} else {

			//gravar uma sessao com o usuario
			$_SESSION["sistema"] =
				array(
					"idusuario" => $dados->idusuario,
					"login" => $dados->login,
					"nome" => $dados->nome,
					"idtipousuario" => $dados->idtipousuario
				);

			//mandar para uma tela
			if ($dados->idtipousuario == 1) {
				header("Location: home.php");
			}else if ($dados->idtipousuario == 2) {
				header("Location: homefuncionario.php");
			}
		}
	}
} else {
	//mandar para o formulario
	header("Location: index.php");
}
