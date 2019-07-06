<?php
session_start();
$idproduto = $valor = $qtd = $chave = "";

include 'conecta.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// se estiver recebendo ação e a ação for add
if (isset($_GET['acao']) && $_GET['acao'] == 'add') {

    $idproduto = $_GET['idproduto'];
    $valor = $_GET['valor'];
    $qtd = $_GET['qtd'];

    $chave = $idproduto;

    // se não existe esse produto no carrinho ele adiciona
    if (!isset($_SESSION['carrinho'][$chave])) {
        $_SESSION['carrinho'][$chave]['idproduto'] = $idproduto;
        $_SESSION['carrinho'][$chave]['valor'] = $valor;
        $_SESSION['carrinho'][$chave]['qtd'] = $qtd;
    } else {
        // se existir ele soma com a qtd existente 
        $_SESSION['carrinho'][$chave]['qtd'] += $qtd;
    }
}

if (isset($_GET['acao']) && $_GET['acao'] == 'remover') {
    unset($_SESSION['carrinho'][$_GET['idproduto']]);
}
if (isset($_GET['acao']) && $_GET['acao'] == 'removerTudo') {
    unset($_SESSION['carrinho']);
}

$totalCompra = 0;
foreach ($_SESSION['carrinho'] as $car => $s) {
    $totalCompra += $s['qtd'] * $s['valor'];

    $sqlProduto = "SELECT * FROM produto WHERE idproduto = " . $s['idproduto'] . " LIMIT 1 ";
    $dadosProd = $pdo->prepare($sqlProduto);
    $dadosProd->execute();
    $dProd = $dadosProd->fetchAll();

    echo ' 
        <tr>
            <td> ' . $s['idproduto'] .'</td>
            <td> ' . $dProd[0]['nome'] . ' </td>
            <td>R$ ' . number_format($s['valor'], 2, ',', '.') . ' </td>
            <td> ' . $s['qtd'] .' </td>
            <td>R$ ' . number_format($s['qtd'] * $s['valor'], 2, ',', '.') . ' </td>
            <td> <button class="btn btn-outline-danger" type="button" onclick="remover(' . $s['idproduto'] . ')"> <i class="fa fa-trash"></i> </button> </td>
        <tr>
     ';
}
echo '
<tr style="font-weight:bold">
    <td>   </td>
    <td>   </td>
    <td>   </td>
    <td> TOTAL: </td>
    <td> 
        <input disabled type="text" class="form-control" id="total" name="total" 
            R$ value="' . $totalCompra . '">
    </td>
    <td>  </td>
</tr>
';
