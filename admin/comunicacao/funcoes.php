<?php

include 'conecta.php';

// finaliza pedido
if (isset($_GET['acao']) && $_GET['acao'] == 'finalizaPedido') {

    $idpedido = $_GET['idpedido'];
    $idtipopagamento = $_GET['idtipopagamento'];



    $sql_mesa = "SELECT idmesa, total_liquido, idusuario FROM pedido WHERE idpedido = $idpedido LIMIT 1";
    $consulta_mesa = $pdo->prepare($sql_mesa);
    $consulta_mesa->execute();
    $mesa = $consulta_mesa->fetchAll();
    $idmesa = $mesa[0]['idmesa'];
    $liquido = $mesa[0]['total_liquido'];
    $idusuario = $mesa[0]['idusuario'];

    //var_dump($sql_mesa);

    $sql_libera_mesa = "UPDATE mesa 
            SET status = 'D'
            WHERE idmesa = $idmesa";

    $gravamesa = $pdo->prepare($sql_libera_mesa);
    //var_dump($sql_libera_mesa);

    $sql = "UPDATE pedido 
            SET datahora_baixa = CURRENT_TIMESTAMP,
                status = 'B',
                idtipopagamento = $idtipopagamento
            WHERE idpedido = $idpedido";

    $grava = $pdo->prepare($sql);

    $sql_caixa = "SELECT idcaixa FROM caixa WHERE idcaixa in (select max(idcaixa) from caixa) and datahora_fechamento is null";
    $consulta = $pdo->prepare($sql_caixa);
    $consulta->execute();
    $dados_caixa = $consulta->fetchAll();
    $idcaixa = $dados_caixa[0]['idcaixa'];

    $sql_caixa = "insert into movimento_caixa
                        (idmovimento,idcaixa,valor,idusuario,tipo_movimento,idoperacao)
                        values (null,$idcaixa,'$liquido',$idusuario,1,1)";

    $grava_caixa = $pdo->prepare($sql_caixa);

    if ($grava->execute() && $gravamesa->execute() && $grava_caixa->execute()) {
        echo 1;
    } else {
        echo 0;
    }
}


// buscar o valor do produto
if (isset($_GET['acao']) && $_GET['acao'] == 'buscaValor') {

    $idproduto = $_GET['idproduto'];

    $sql = "SELECT preco FROM produto WHERE idproduto = $idproduto LIMIT 1 ";

    $dados = $pdo->prepare($sql);
    $dados->execute();

    $val = $dados->fetchAll();

    echo $val[0]['preco'];
}


if (isset($_GET['acao']) && $_GET['acao'] == 'porPessoa') {
    $valor = (float) $_GET['valor'];
    $pessoas = (int) $_GET['pessoas'];

    $calc = $valor / $pessoas;

    echo "
        <table id='table' class='table table-striped'>
            <thead>
                <tr>
                    <td> Pessoa </td>
                    <td> Valor </td>
                </tr>
            </thead>
            <tbody>
    ";
    for ($i = 1; $i <= $pessoas; $i++) {
        echo " 
            <tr>
                <td> " . $i . " </td>
                <td>R$ " . number_format($calc, 2, ',', '.') . " </td> 
            </tr> 
        ";
    }
    echo "
        </tbody>
       </table>
    ";
}
