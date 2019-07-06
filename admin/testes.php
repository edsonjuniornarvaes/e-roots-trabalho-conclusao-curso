<?php

$idcliente = $nome = $cpf = $data_nascimento = $endereco = $email = $numero_casa = $telefone = 
$status = $cep = $bairro = $cidade = $uf = "";

if (isset($_POST["idcliente"]))
	$idcliente = trim($_POST["idcliente"]);

if (isset($_POST["nome"]))
	$nome = trim($_POST["nome"]);

if (isset($_POST["cpf"]))
	$cpf = trim($_POST["cpf"]);

if (isset($_POST["data_nascimento"]))
	$data_nascimento = trim($_POST["data_nascimento"]);

if (isset($_POST["endereco"]))
	$endereco = trim($_POST["endereco"]);

if (isset($_POST["email"]))
	$email = trim($_POST["email"]);
	
if (isset($_POST["numero_casa"]))
	$numero_casa = trim($_POST["numero_casa"]);

if (isset($_POST["telefone"]))
	$telefone = trim($_POST["telefone"]);
	
if (isset($_POST["status"]))
	$status = trim($_POST["status"]);

if (isset($_POST["cep"]))
	$cep = trim($_POST["cep"]);

if (isset($_POST["bairro"]))
	$bairro = trim($_POST["bairro"]);

if (isset($_POST["cidade"]))
	$cidade = trim($_POST["cidade"]);

if (isset($_POST["uf"]))
	$uf = trim($_POST["uf"]);

	//verificar se esta em branco
	if ( empty ( $nome ) ) {
		echo "<script>alert('Selecione o nome');history.back();</script>";
		exit;

	} else if ( empty ( $cpf ) ) {
		echo "<script>alert('Faltou o CPF');history.back();</script>";
		exit;

	} else if ( empty ( $data_nascimento ) ) {
		echo "<script>alert('Preencha a Data de Nascimento');history.back();</script>";
		exit;

	} else if ( empty ( $endereco ) ) {
		echo "<script>alert('Preencha o endereco');history.back();</script>";
		exit;
		
	} else if ( empty ( $numero_casa ) ) {
		echo "<script>alert('Preencha o número');history.back();</script>";
		exit;

	} else if ( empty ( $bairro ) ) {
		echo "<script>alert('Preencha o Bairro');history.back();</script>";
		exit;

	} else if ( empty ( $telefone ) ) {
		echo "<script>alert('Selecione o telefone');history.back();</script>";
		exit;

	} else if ( empty ( $cidade ) ) {
		echo "<script>alert('Faltou a Cidade');history.back();</script>";
		exit;
		
	} else if ( empty ( $uf ) ) {
		echo "<script>alert('Faltou o Estado (UF)');history.back();</script>";
		exit;

	} else if ( empty ( $status ) ) {
		echo "<script>alert('Selecione o status');history.back();</script>";
		exit;

	} else {
		$salve_data = $data_nascimento;
		$data_nascimento = explode('-', $data_nascimento);

		$checkdate = $data_nascimento;

		$Validadata_nascimento = $data_nascimento;


		if ( count ($data_nascimento) == 3) {
			
		  $data_nascimento = implode ($data_nascimento);
		  $data_nascimento = strlen ($data_nascimento);


			if ($data_nascimento <= 7) {
				echo '<script>alert("Data de nacimento invalida!");history.back();</script>';

			}  else {

				if(count($checkdate) == 3){
					$dia = (int)$checkdate[2];
					$mes = (int)$checkdate[1];
					$ano = (int)$checkdate[0];
				
						if(checkdate($mes, $dia, $ano)){

							$Validadata_nascimento =  $Validadata_nascimento[2]."-".$Validadata_nascimento[1]."-".$Validadata_nascimento[0];
							date_default_timezone_set('America/Sao_Paulo');

							$dataAtual = date('Y-m-d');

							if ($Validadata_nascimento >= $dataAtual) {

							 echo '<script>alert("Data de nascimento é maior que data atual !");history.back();</script>';

							}else {

								if ($Validadata_nascimento <= "01-01-1930") {

									echo '<script>alert("A data está abaixo do permitido");history.back();</script>';
	   
								   	}else {
	   
										include "comunicacao/conecta.php";

										// se não tiver idcliente passando é porque é insert 
										if (empty($idcliente)) {
								
											$sql = "INSERT INTO cliente 
														(idcliente,nome,cpf,data_nascimento,endereco,email,numero_casa,
														telefone,status,cep,bairro,cidade,uf)
														values (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
								
											$consulta = $pdo->prepare($sql);
								
											$consulta->bindParam(1,  $nome);
											$consulta->bindParam(2,  $cpf);
											$consulta->bindParam(3,  $salve_data);
											$consulta->bindParam(4,  $endereco);
											$consulta->bindParam(5,  $email);
											$consulta->bindParam(6,  $numero_casa);
											$consulta->bindParam(7,  $telefone);
											$consulta->bindParam(8,  $status);
											$consulta->bindParam(9,  $cep);
											$consulta->bindParam(10, $bairro);
											$consulta->bindParam(11, $cidade);
											$consulta->bindParam(12, $uf);
								
										} else {
								
											//Update
											$sql = "UPDATE cliente 
													SET nome = ?, cpf = ?, data_nascimento = ?, endereco = ?, email = ?,
													numero_casa = ?, telefone = ?, status = ?, cep = ?, bairro = ?, cidade = ?, uf = ?
													WHERE idcliente = ? LIMIT 1";
								
											$consulta = $pdo->prepare($sql);
								
											$consulta->bindParam(1,  $nome);
											$consulta->bindParam(2,  $cpf);
											$consulta->bindParam(3,  $salve_data);
											$consulta->bindParam(4,  $endereco);
											$consulta->bindParam(5,  $email);
											$consulta->bindParam(6,  $numero_casa);
											$consulta->bindParam(7,  $telefone);
											$consulta->bindParam(8,  $status);
											$consulta->bindParam(9,  $cep);
											$consulta->bindParam(10, $bairro);
											$consulta->bindParam(11, $cidade);
											$consulta->bindParam(12, $uf);
											$consulta->bindParam(13, $idcliente);
								
											}
										}
										

										if ($consulta->execute()) {
											
											if ($_SESSION["sistema"]["idtipousuario"] == 1) {
												echo "<script>alert('Registro salvo'); location.href='home.php?op=listar&pg=cliente';</script>";
												$pdo->commit();
												exit;
											}else if ($_SESSION['sistema']['idtipousuario'] == 2) {
												echo "<script>alert('Registro salvo'); location.href='homefuncionario.php?op=listar&pg=cliente';</script>";
												$pdo->commit();
												exit;
	
											}

										}else {
											$erro = $consulta->errorInfo()[2];
										
											echo $erro;
											echo "<script>alert('Não foi possível salvar');</script>";
									
											$pdo->rollBack();
											exit;
										}
									
	   
								   }

							
						}else{
						 echo '<script>alert("Data de nacimento é inválida!");history.back();</script>';
						}

				}else {
		 			echo '<script>alert("Formato da data de nacimento inválido !");history.back();</script>';
					}
			} 
		} else {
	 		echo '<script>alert("Formato da data de nacimento inválido!");history.back();</script>';
			} 

	}
