<?php
date_default_timezone_set('America/Sao_Paulo');
include 'comunicacao/conecta.php';


$sql = "select saldo_atual,saldo_inicial from caixa where data = current_date and datahora_fechamento is null ";
$consulta = $pdo->prepare($sql);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

if (isset($dados->saldo_inicial)) {
    $saldo_atual = $dados->saldo_atual;
    $saldo_inicial = $dados->saldo_inicial;
} else {
    $saldo_atual = "";
    $saldo_inicial = "";
}

?>
<style>
    .box {
        background-color: #00000017;
        min-height: 130px;
        box-shadow: black 4px 4px 10px;
    }

   
</style>
<div class="container-fluid box">
    <div class="row">
        <div class="col-md-2 mt-4">
            <label for="data_referencia"> <b> Data Referencia </b> </label>
            <input type="text" value="<?php echo date('Y-m-d') ?>" class="form-control" id="data_referencia" name="data_referencia" disabled>
        </div>
        <div class="col-md-4 mt-4">
            <label for="saldo_inicial"> <b> Saldo inicial R$ </b> </label>
            <input type="text" class="form-control" placeholder="Digite o saldo inicial" id="saldo_inicial" 
            value="<?php echo $saldo_inicial = number_format($saldo_inicial, 2, ",", '.'); ?>" 
            <?php
                if ($saldo_inicial > 0) {
                    echo "disabled";
                } else {
                    echo "";
                };
                ?>>
        </div>
        <div class="col-md-4 mt-4">
            <label for="saldo_atual"> <b> Saldo Atual R$ </b> </label>
            <input type="text" class="form-control" value="<?php echo $saldo_atual = number_format($saldo_atual, 2, ",", '.'); ?>" disabled>
        </div>
        <div class="col-md-2 mt-5">
            <label> &nbsp; </label>
            <button class="btn btn-outline-primary mt-2" type="button" onclick="abrir()" 
            <?php
            if ($saldo_inicial > 0) {
                echo "disabled";
            } else {
                echo "";
            };
            ?>>
                <i class="fa fa-dollar wi"></i>
            </button>
            <button class="btn btn-outline-primary mt-2" type="button" data-toggle="modal" data-target="#movimento">
                <i class="fa fa-plus wi"></i>
            </button>
            <button class="btn btn-outline-primary mt-2" type="button" onclick="fechar()">
                <i class="fa fa-times-circle wi"></i>
            </button>
            <br>
        </div>
        <div class="col-md-12 mt-4" style='background-color:#ffffffe8'>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr style="font-weight:bold">
                            <td> Data/Hora </td>
                            <td> Operação </td>
                            <td> Motivo </td>
                            <td> Tipo </td>
                            <td> Usuário </td>
                            <td> Valor </td>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $sql2 = " 
                                select 
                                    mv.idmovimento
                                    ,op.nome as operacao
                                    ,case 
                                        when tipo_movimento = 1 then 'Entrada'
                                        else 'Saida'
                                    end as tipo
                                    ,case
                                        when tipo_movimento = 1 then mv.valor
                                        else mv.valor*-1
                                    end as valor 
                                    ,u.nome as usuario                                                                                                                                      
                                    ,mv.datahora
                                    ,mv.motivo
                                from movimento_caixa mv
                                inner join caixa cx on cx.idcaixa = mv.idcaixa and cx.datahora_fechamento is null
                                left join usuario u on u.idusuario = mv.idusuario
                                left join operacao op on op.idoperacao = mv.idoperacao
                                where date(mv.datahora) = current_date 
                                order by mv.datahora
                        ";
                        $consulta2 = $pdo->prepare($sql2);
                        $consulta2->execute();

                        while ($d = $consulta2->fetch(PDO::FETCH_OBJ)) {
                            $operacao = $d->operacao;
                            $tipo = $d->tipo;
                            $usu = $d->usuario;
                            $dthr = $d->datahora;
                            $val = $d->valor;
                            $motivo = $d->motivo;

                            if ($val > 0) {
                                $cor = "green";
                            } else {
                                $cor = "red";
                            }

                            echo '<tr>
                                    <td> ' . date('d/m/Y H:i:s', strtotime($dthr)) .  ' </td>
                                    <td> ' . $operacao .  ' </td>
                                    <td> ' . $motivo .  ' </td>
                                    <td> ' . $tipo .  ' </td>
                                    <td> ' . $usu .  ' </td>
                                    <td  style="font-weight:bold;color:' . $cor . '"> R$ ' . number_format($val, 2, ',', '.') .  ' </td>
                            </tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function abrir() {

            var saldo_inicial = document.getElementById('saldo_inicial').value;
            var idusuario = <?php echo $_SESSION["sistema"]["idusuario"] ?>;
            var data = document.getElementById('data_referencia').value;

            if (saldo_inicial > 0) {
                swal({
                        title: "Atenção.",
                        text: "Deseja abrir o caixa com: R$ " + saldo_inicial + " reais ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            $.ajax({
                                url: 'comunicacao/caixa.php?acao=abrir&idusuario=' + idusuario + '&data=' + data + '&saldo_inicial=' + saldo_inicial,
                                async: true,
                                success: function(result) {
                                    swal("Sucesso.", 'Caixa aberto com sucesso!', 'success');
                                    setTimeout(function() {
                                        window.location.href = "home.php?op=listar&pg=Caixa";
                                    }, 1000);
                                }
                            });
                        }
                    });
            } else {
                swal('Atenção.', 'Favor digite um valor válido.', 'error');
            }


        }


        function fechar() {

            var idusuario = <?php echo $_SESSION["sistema"]["idusuario"] ?>;
            var data = document.getElementById('data_referencia').value;

            swal({
                    title: "Atenção.",
                    text: "Deseja fechar o caixa ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: 'comunicacao/caixa.php?acao=fechar&idusuario=' + idusuario + '&data=' + data,
                            async: true,
                            success: function(result) {
                                console.log(result);

                                if (parseInt(result) == 1) {
                                    swal("Sucesso.", 'Caixa fechado com sucesso!', 'success');
                                    setTimeout(function() {
                                        window.location.href = "home.php?op=listar&pg=Caixa";
                                    }, 1000);
                                } else {
                                    swal('Atenção', 'Somente o usuário que abriu poderá fechar o caixa.', 'error');
                                }

                            }
                        });
                    }
                });
        }
    </script>


    <div class="modal fade" id="movimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Movimentação Caixa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> Tipo de movimento </label>
                            <select class="form-control" id="tipo_mov">
                                <option value="1"> Entrada </option>
                                <option value="2"> Saida </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> Valor </label>
                            <input type="text" class="form-control" id="valor_mov">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> Motivo </label>
                            <textarea class="form-control" id="motivo" rows="2"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-outline-primary" onclick="movimento()">Gravar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function movimento() {
            var tipo = $('#tipo_mov').val();
            var valor = $('#valor_mov').val();
            var idusuario = <?php echo $_SESSION["sistema"]["idusuario"] ?>;
            var motivo = $('#motivo').val();

            if (valor !== "" && motivo !== "") {
                $.ajax({
                    url: 'comunicacao/caixa.php?acao=movimento',
                    async: true,
                    type: 'POST',
                    data: {
                        'tipo': tipo,
                        'valor': valor,
                        'idusuario': idusuario,
                        'motivo': motivo
                    },
                    success: function(result) {
                        console.log(result);
                        alert("Movimento realizado com sucesso");
                        $('#tipo_mov').val("");
                        $('#valor_mov').val("");
                        var idusuario = "";
                        $('#motivo').val("");
                        setTimeout(function() {
                            window.location.href = "home.php?op=listar&pg=Caixa";
                        }, 700);
                    }
                })
            } else {
                alert('Valor inválido');
            }

        }
    </script>