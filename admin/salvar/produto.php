
<?php

$idproduto = $nome = $descricao = $preco = $status = $idmarca = $idcategoria = "";

if ( isset ( $_POST["idproduto"] ) )
	$idproduto = trim ( $_POST["idproduto"] );

if ( isset ( $_POST["nome"] ) )
	$nome = trim ( $_POST["nome"] );

if ( isset ( $_POST["descricao"] ) )
	$descricao = trim ( $_POST["descricao"] );

if ( isset ( $_POST["preco"] ) )
	$preco = trim ( $_POST["preco"] );

if ( isset ( $_POST["status"] ) )
	$status = trim ( $_POST["status"] );

if ( isset ( $_POST["idmarca"] ) )
	$idmarca = trim ( $_POST["idmarca"] );

if ( isset ( $_POST["idcategoria"] ) )
	$idcategoria = trim ( $_POST["idcategoria"] );

//verificar se esta em branco
if ( empty ( $idcategoria ) ) {
	echo "<script> alert ('Faltou a categoria'); history.back(); </script>";
	exit;

} else if ( empty ( $nome ) ) {
	echo "<script> alert ('Faltou o nome'); history.back(); </script>";
	exit;

} else if ( empty ( $descricao ) ) {
	echo "<script> alert ('Faltou a Descrição'); history.back(); </script>";
	exit;

} else if ( empty ( $idmarca ) ) {
	echo "<script> alert ('Faltou a marca'); history.back(); </script>";
	exit;

} else if ( empty ( $descricao) ) {
	echo "<script> alert ('Faltou a descrição'); history.back(); </script>";
	exit;

} else if ( empty ( $preco ) ) {
	echo "<script> alert ('Faltou o preco'); history.back(); </script>";
	exit;

} else if ( empty ( $status ) ) {
	echo "<script> alert ('Faltou o status'); history.back(); </script>";
	exit;

} else {

	include "comunicacao/conecta.php";

if ( empty ( $idproduto ) ) {

	$sql = "INSERT INTO produto
			(idproduto,nome,descricao,preco,status,idmarca,idcategoria)
			VALUES (NULL, ?, ?, ?, ?, ?, ?)";
			
	$consulta = $pdo->prepare( $sql );
	$consulta->bindParam(1, $nome);
	$consulta->bindParam(2, $descricao);
	$consulta->bindParam(3, $preco);
	$consulta->bindParam(4, $status);
	$consulta->bindParam(5, $idmarca);
	$consulta->bindParam(6, $idcategoria);
} else {
	$sql = "UPDATE produto set nome = ?, descricao = ?, preco = ?, status = ?, idmarca = ?,
			idcategoria = ? where idproduto = ? limit 1";
	
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $nome);
	$consulta->bindParam(2, $descricao);
	$consulta->bindParam(3, $preco);
	$consulta->bindParam(4, $status);
	$consulta->bindParam(5, $idmarca);
	$consulta->bindParam(6, $idcategoria);
	$consulta->bindParam(7, $idproduto);
	}
}

if ($consulta->execute()) {
	echo "<script>
			swal('Sucesso!','Registro salvo com sucesso!','success');

			setTimeout(() => { 
				location.href='home.php?op=listar&pg=produto';
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