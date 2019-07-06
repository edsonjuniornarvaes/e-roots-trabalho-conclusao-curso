<!-- Painel de Controle -->
<section id="dashboard">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card">
                    <p><img class=" img-fluid" src="../arquivos/imagens/busca.png" alt="card image"></p>
                    <h4 class="card-title"><b>Busca Preço</b></h4>
                    <hr>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-xs-center" href="home.php?op=listar&pg=buscapreco">
                                <i class="fa fa-search"></i>
                                <label for="ir"><b> Consultar </b></label>
                            </a>
                        </li>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card">
                    <p><img class=" img-fluid" src="../arquivos/imagens/pedido.png" alt="card image"></p>
                    <h4 class="card-title"><b>Pedido</b></h4>
                    <hr>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-xs-center" href="home.php?op=pedido&pg=pedido">
                                <i class="fa fa-angle-up"></i>
                                <label for="ir"><b> Abrir </b></label>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-xs-center" href="home.php?op=listar&pg=pedido">
                                <i class="fa fa-search"></i>
                                <label for="ir"><b> Buscar </b></label>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card">
                    <p><img class=" img-fluid" src="../arquivos/imagens/mesa.png" alt="card image"></p>
                    <h4 class="card-title"><b>Mesas</b></h4>
                    <hr>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-xs-center" href="" data-toggle="modal" data-target="#modalMapa">
                                <i class="fa fa-search"></i>
                                <label for="ir"><b> Exibir </b></label>
                            </a>
                        </li>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card">
                    <p><img class=" img-fluid" src="../arquivos/imagens/caixa.png" alt="card image"></p>
                    <h4 class="card-title"><b>Caixa</b></h4>
                    <hr>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-xs-center" href="home.php?op=listar&pg=Caixa">
                                <i class="fa fa-angle-up"></i>
                                <label for="ir"><b> Abrir </b></label>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
</section>

<!-- Modal Mapa das Mesas -->
<div class="modal fade" id="modalMapa" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo">Mapa de Mesas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-md-12 col-xl-12 col-sm-12" id="mapa">
                    <div class="row">

                        <?php
                        include 'comunicacao/conecta.php';

                        $sql = $dadosMesas = $dadosMesas = $idmesa = $nome = "";

                        $sql = "SELECT 
                                m.idmesa, 
                                m.nome, 
                                m.status , 
                                p.idpedido, 
                                c.nome as cliente 
                            FROM mesa m 
                            left JOIN pedido p on p.idmesa = m.idmesa and p.idpedido in (select max(idpedido) from pedido)
                            left JOIN cliente c ON c.idcliente = p.idcliente 
                            ORDER BY m.nome";

                        $dadosMesas = $pdo->prepare($sql);
                        $dadosMesas->execute();

                        while ($dados = $dadosMesas->fetch(PDO::FETCH_OBJ)) {
                            $idmesa   = $dados->idmesa;
                            $nome     = $dados->nome;
                            $idpedido = $dados->idpedido;
                            $cliente  = $dados->cliente;

                            if ($dados->status == "D") {
                                echo '<div class="col-sm-6 col-md-4 col-xl-4">
                                <div class="card mesa-livre" id="mesa">

                                    <div class="card-title">
                                        <p> <b> ' . $nome . ' - [Livre] </b> </p>
                                        <small><b> Cliente:</b></small> 
                                    </div>

                                    <img src="../arquivos/imagens/mesa.png">

                                    <div class="card-footer mt-2"> 
                                        <a class="btn btn-outline-primary" href="home.php?op=pedido&pg=pedido&idmesa=' . $idmesa . '"> 
                                            <i class="fa fa-plus"></i> 
                                            Abrir 
                                        </a>   
                                    </div>
                                </div>
                                </div>';
                            } else {

                                echo ' <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="card mesa-ocupada" id="mesa">

                            <div class="card-title">
                                <p> <b> ' . $nome . ' - [Ocupada] </b> </p>
                                <small><b> Cliente: ' . $cliente . ' </b></small> 
                            </div>

                            <img src="../arquivos/imagens/mesa.png">

                            <div class="card-footer mt-2">
                                <button onclick="crtz('.$idpedido.')" type="button" class="btn btn-outline-success"> 
                                    <i class="fa fa-check"></i> 
                                    Finalizar 
                                </button>  
                            </div>
                        </div>
                    </div>';
                            }
                        }

                        ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Voltar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function crtz(idpedido) {
        var x;
        var r = confirm("Tem certeza que deseja finalizar?");
        if (r == true) {
            window.location.href="home.php?op=pedido&pg=checkout&idpedido="+idpedido;
        } 
    }
</script>