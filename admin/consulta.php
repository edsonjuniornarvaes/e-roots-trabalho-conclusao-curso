<?php
//criar uma pdo com PDO
$server = "localhost";
$dbname = "eroots";
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
	$where = (!empty($parametro)) ? 'WHERE nomeProduto LIKE ?' : '';
	$sql = "SELECT idProduto, nomeProduto, preco FROM produto " . $where;

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, '%'.$parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;
endif;

// Verifica se foi solicitado uma consulta para preencher os campos do formulário
if($acao == 'conecta'):
	$sql = "SELECT idProduto, nomeProduto, preco FROM produto ";
	$sql .= "WHERE nomeProduto LIKE ? LIMIT 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindValue(1, $parametro.'%');
	$consulta->execute();
	$dados = $consulta->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;
endif;
