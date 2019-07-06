<?php
include 'conecta.php';

if (isset($_GET['acao']) && $_GET['acao'] == "abrir") {

    $data = $_GET['data'];
    $idusuario = $_GET['idusuario'];
    $saldo_inicial = $_GET['saldo_inicial'];

    $sql = "INSERT INTO caixa VALUES (null,'$data',$idusuario,$saldo_inicial,$saldo_inicial,null)";

    $grava = $pdo->prepare($sql);

    if ($grava->execute()) {
        echo "deu certo";
        var_dump($sql);
    } else {
        echo "deu erro";
        var_dump($sql);
    }
}

if (isset($_GET['acao']) && $_GET['acao'] == "fechar") {

    $data = $_GET['data'];
    $idusuario = $_GET['idusuario'];

    $sql = "UPDATE caixa SET datahora_fechamento = current_timestamp WHERE data = '$data' and idusuario = $idusuario  ";

    $grava = $pdo->prepare($sql);

    if ($grava->execute()) {
        echo 1;
    } else {
        echo 0;
    }
}





if (isset($_GET['acao']) && $_GET['acao'] == "movimento") {

    $tipo = (int)$_POST['tipo'];
    $valor_mov = str_replace(",",".",$_POST['valor']);
    $idusuario = $_POST['idusuario'];
    $motivo = $_POST['motivo'];


    $sql = "select idcaixa,saldo_atual from caixa where data = current_date and datahora_fechamento is null ";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $idcaixa = $dados->idcaixa;
    $saldo = $dados->saldo_atual;

    if ($tipo == 1) {
        $valor = $saldo += $valor_mov;
        $operacao = 2;
    } else {
        $valor = $saldo - $valor_mov;
        $operacao = 3;
    }

    $sql2 = "UPDATE caixa SET saldo_atual = '$valor' WHERE idcaixa = $idcaixa ";
    $grava = $pdo->prepare($sql2);

    if ($grava->execute()) {
        $sql3 = "INSERT INTO movimento_caixa VALUES (null, $idcaixa, '$valor_mov',current_timestamp, $idusuario, $tipo, $operacao,'$motivo') ";
        $grava2 = $pdo->prepare($sql3);
        if ($grava2->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}
