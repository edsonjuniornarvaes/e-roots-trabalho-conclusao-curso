<?php
include 'comunicacao/conecta.php';

$idpedido = $_GET['idpedido'];

$sql = "SELECT  p.datahora_inclusao,
                    p.idpedido,
                    p.idcliente,
                    p.idusuario,
                    p.idmesa,
                    u.nome as usuario,
                    p.total_liquido as valor,
                    m.nome as mesa,
                    c.nome as cliente
            FROM pedido p 
            INNER JOIN cliente c ON c.idcliente = p.idcliente   
            INNER JOIN usuario u on u.idusuario = p.idusuario
            INNER JOIN mesa m on m.idmesa = p.idmesa
            WHERE
                p.idpedido = $idpedido
            ";

$dados = $pdo->prepare($sql);
$dados->execute();
$d = $dados->fetchAll();

//var_dump($sql);

?>


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <h2 class="text-center">Checkout - <?php echo $d[0]['mesa'] ?> </h2>
            <br>
            <br>
        </div>

        <div class="col-md-6 col-sm-6 col-xl-6">
            <p class="text-center"> <b> INFORMAÇÕES DO PEDIDO </b> </p>
            <p> <b> Data: </b> <?php echo date('d/m/Y', strtotime($d[0]['datahora_inclusao'])) ?> </p>
            <p> <b> Vendedor: </b> <?php echo  $d[0]['usuario']   ?> </p>
            <p> <b> Cliente: </b> <?php echo  $d[0]['cliente']   ?> </p>
            <p> <b> Pedido: </b> <?php echo $idpedido ?> </p>
            <p> <b> Valor: </b>R$ <?php echo  number_format($d[0]['valor'], 2, ',', '.')  ?> </p>
            <p> <b> Mesa: </b> <?php echo   $d[0]['mesa']  ?> </p>

            <p class="text-center"> <b> PRODUTOS DO PEDIDO </b> </p>

            <table id="table" class="table table-striped">
                <thead>
                    <tr style="font-weight:bold">
                        <td> Produto </td>
                        <td> Val. Unit. </td>
                        <td> Qtde </td>
                        <td> Val. Total. </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql2 = "select 
                                        i.*, concat(i.idproduto,' - ',p.nome) as produto
                                     from item_pedido i 
                                     inner join produto p on p.idproduto = i.idproduto
                                     where i.idpedido = $idpedido
                                     ";

                    $dadosCarrinho = $pdo->prepare($sql2);
                    $dadosCarrinho->execute();

                    $valor_final = $qtde_final = 0;
                    while ($dados2 = $dadosCarrinho->fetch(PDO::FETCH_OBJ)) {
                        $produto = $dados2->produto;
                        $qtd = $dados2->qtde;
                        $val_unitario = $dados2->valor_unitario;
                        $val_total = $dados2->valor_total;
                        $valor_final += $val_total;
                        $qtde_final += $qtd;
                        echo "
                                <tr>
                                    <td> " . $produto . " </td>
                                    <td> " . number_format($val_unitario, 2, ',', '.') . " </td>
                                    <td> " . $qtd . " </td>
                                    <td> " . number_format($val_total, 2, ',', '.') . " </td> 
                                </tr>
                                ";
                    }
                    echo "
                            <tr style='font-weight: bold'>
                                <td> Total: </td>
                                <td> </td>
                                <td> " . $qtde_final . " </td>
                                <td>" . number_format($valor_final, 2, ',', '.') . " </td>
                            </tr>
                        ";
                    ?>
                </tbody>
            </table>

        </div>


        <div class="col-md-6 col-sm-6 col-xl-6">
            <p class="text-center"> <b> INFORAMÇÕES DO PAGAMENTO </b> </p>

            <div class="row">
                <div class="col-md-12">
                    <label for="idtipopagamento"> Tipo pagamento </label>
                    <select required class="form-control" id="idtipopagamento" name="idtipopagamento">
                        <option value=""> Selecione.. </option>
                        <?php
                        $sql = "SELECT * FROM tipo_pagamento";
                        $dadosTP = $pdo->prepare($sql);
                        $dadosTP->execute();
                        while ($dados3 = $dadosTP->fetch(PDO::FETCH_OBJ)) {
                            $idpgto = $dados3->idtipopagamento;
                            $nome = $dados3->nome;
                            echo "<option value='$idpgto'> $nome </option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="col-md-10 mt-3">
                    <label for="qtd_pessoas"> Qtde. Pessoas </label>
                    <input type="number" class="form-control" id="qtd_pessoas" placeholder="Digite a qtde de pessoas.">
                </div>

                <div class="col-md-2 mt-5">
                    <label> &nbsp; </label>
                    <button class="btn btn-primary" type="button" onclick="porPessoa()"> <i class="fa fa-refresh" style="color:white"> </i> </button>
                </div>

                <div class="col-md-12 mt-2" id="conteudo_porPessoa">
                </div>

            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xl-12">
            <hr>
            <div class="text-right">
                <button class="btn btn-success" onclick="finalizaPedido()" type="button"> <i class="fa fa-check" style="color:white" > </i> Finalizar </button>
            </div>
        </div>

    </div>
</div>

<script>
    function porPessoa() {
        var valor = <?php echo $d[0]['valor'] ?>;
        var pessoas = document.getElementById('qtd_pessoas').value;

        $('#conteudo_porPessoa').load('comunicacao/funcoes.php?acao=porPessoa&valor=' + valor + "&pessoas=" + pessoas);

    }

    function finalizaPedido() {

        var idpedido = <?php echo $_GET['idpedido'] ?>;
        var idtipopagamento = document.getElementById('idtipopagamento').value;
         
            $.ajax({
                url:'comunicacao/funcoes.php?acao=finalizaPedido&idpedido='+idpedido+'&idtipopagamento='+idtipopagamento,
                async:true,
                success: function(result){
                        if ( parseInt(result) == 1 ){
                            alert('Pedido finalizado com sucesso');
                            setTimeout(function() {
                                window.location.href = "home.php";
                            }, 1000);
                        } else {
                            alert('Algo deu errado.');
                        }
                }
            })
    }
</script>