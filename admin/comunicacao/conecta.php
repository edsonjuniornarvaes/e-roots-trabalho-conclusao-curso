<?php
//criar uma pdo com PDO
$server = "localhost";
$dbname = "bdrootsfinal";
$user = "root";
$pwd = "";

try {
    //codigo de pdo
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pwd);

} catch (PDOException $erro) {
    //se não conseguir
    echo $erro->getMessage();
    exit;
}

// Recebe os parâmetros enviados via GET
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$parametro = (isset($_GET['parametro'])) ? $_GET['parametro'] : '';

// Verifica se foi solicitado uma consulta para o autocomplete
if($acao == 'autocomplete'):
	$where = (!empty($parametro)) ? 'WHERE nome LIKE ?' : '';
	$sql = "SELECT idproduto, nome, preco FROM produto " . $where;

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, '%'.$parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;
endif;

// Verifica se foi solicitado uma consulta para preencher os campos do formulário
if($acao == 'conecta'):
	$sql = "SELECT idproduto, nome, preco FROM produto ";
	$sql .= "WHERE nome LIKE ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, $parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;
endif;

// Parte 2 Autocomplete
// Verifica se foi solicitado uma consulta para o autocomplete
if($acao == 'autocomplete2'):
	$where = (!empty($parametro)) ? 'WHERE nome LIKE ?' : '';
	$sql = "SELECT idcliente, nome, cpf FROM cliente " . $where;

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, '%'.$parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;

endif;

// Verifica se foi solicitado uma consulta para preencher os campos do formulário
if($acao == 'conecta2'):
	$sql = "SELECT idcliente, nome, cpf FROM cliente WHERE nome LIKE ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, $parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;

endif;


// Parte 2 Autocomplete
// Verifica se foi solicitado uma consulta para o autocomplete
if($acao == 'autocomplete3'):
	$where = (!empty($parametro)) ? 'WHERE nome LIKE ?' : '';
	$sql = "SELECT idcidade, nome FROM cidade " . $where;

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, '%'.$parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;

endif;

// Verifica se foi solicitado uma consulta para preencher os campos do formulário
if($acao == 'conecta3'):
	$sql = "SELECT idcidade, nome FROM cidade ";
	$sql .= "WHERE nome LIKE ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, $parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;

endif;






