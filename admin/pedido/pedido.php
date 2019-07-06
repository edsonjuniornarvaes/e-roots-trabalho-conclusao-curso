<?php
include "comunicacao/conecta.php";
if (isset($_GET['idmesa'])) {
  $idmesaPOST = $_GET['idmesa'];
} else {
  $idmesaPOST = 0;
}
?>

<div class="container" id="formulario">
  <h3>Gerar Pedido</h3><br>


  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="idcliente"><b>Cliente</b></label>
      <select class="form-control" name="idcliente" id="idcliente" required>
        <option value="0">Sem cliente.</option>
        <?php
        $sql = "SELECT * FROM cliente WHERE status = 'A' ";
        $dados_cliente = $pdo->prepare($sql);
        $dados_cliente->execute();
        while ($dados = $dados_cliente->fetch(PDO::FETCH_OBJ)) {
          $idcliente = $dados->idcliente;
          $nome = $dados->nome;
          echo "<option value='$idcliente'> $nome </option> ";
        }
        ?>
      </select>
    </div>

    <div class="form-group col-md-6">
      <label for="idmesa"><b>Mesa</b></label>
      <select class="form-control" name="idmesa" id="idmesa" required>
        <option value="0">Sem Mesa</option>
        <?php
        $sql = "SELECT * FROM mesa WHERE status = 'D' ";
        $dados_mesas = $pdo->prepare($sql);
        $dados_mesas->execute();
        while ($dados = $dados_mesas->fetch(PDO::FETCH_OBJ)) {

          $idmesa = $dados->idmesa;
          $nome = $dados->nome;
          if ($idmesaPOST == $idmesa) {
            echo "<option selected value='$idmesa'> $nome </option> ";
          } else {
            echo "<option value='$idmesa'> $nome </option> ";
          }
        }
        ?>
      </select>
    </div>



  </div>

  <div class="form-row">

    <div class="form-group col-md-4">
      <label for="idproduto"><b>Produto</b></label>
      <select class="form-control" name="idproduto" id="idproduto" required onchange="buscaValor(this.value)">
        <option value="">Selecione</option>
        <?php
        $sql = "SELECT * FROM produto WHERE status = 'A' ";
        $dados_produto = $pdo->prepare($sql);
        $dados_produto->execute();
        while ($dados = $dados_produto->fetch(PDO::FETCH_OBJ)) {
          $idproduto  = $dados->idproduto;
          $nome       = $dados->nome;
          echo "<option value='$idproduto'> $nome </option> ";
        }
        ?>
      </select>
    </div>


    <script>
      // buscar valor do produto
      function buscaValor(idproduto) {

        // ajax que busca o valor do produto no banco
        $.ajax({
          url: 'comunicacao/funcoes.php?acao=buscaValor&idproduto=' + idproduto,
          async: true,
          success: function(result) {
            document.getElementById('valor').value = result; // joga o valor do produto no campo valor
          },
          error: function(result) {
            console.log(result); // se der erro vai mostrar no CONSOLE do f12
          }

        })

      }
    </script>

    
    <div class="form-group col-md-4">
      <label for="preco"><b>Preço</b></label>
      <input type="hidden" class="form-control" id="idtipousuario" value="<? echo $_SESSION["sistema"]["idtipousuario"];?>">
      <input type="number" class="form-control" id="valor">
    </div>



    <div class="form-group col-md-4">
      <label for="qtd"><b>Quantidade</b></label>
      <input type="number" class="form-control" id="qtd">
    </div>
  </div><br>



  <script>
    $(document).ready(function() {
      $('#conteudoCarrinho').load('comunicacao/sessionCarrinho.php');
    });



    function addCarrinho() {
      // grava nas variaveis os dados (produto | valor | quantidade) 
      var idproduto = parseInt($('#idproduto').val());
      var valor = parseFloat($('#valor').val());
      var qtd = parseInt($('#qtd').val());

      if (idproduto > 0 && valor > 0 && qtd > 0) {
        $.ajax({
          url: 'comunicacao/sessionCarrinho.php?acao=add&idproduto=' + idproduto + "&valor=" + valor + "&qtd=" + qtd,
          async: true,
          success: function(result) {
            $('#conteudoCarrinho').load('comunicacao/sessionCarrinho.php');
            $('#idproduto').val("");
            $('#valor').val("");
            $('#qtd').val("");
          },
          error: function(result) {
            console.log(result); // se der erro vai mostrar no CONSOLE do f12
          }

        });
      } else {
        alert('Primeiro selecione o produto');
      }

    }

    function remover(idproduto) {
      $.ajax({
        url: 'comunicacao/sessionCarrinho.php?acao=remover&idproduto=' + idproduto,
        async: true,
        success: function(result) {
          $('#conteudoCarrinho').load('comunicacao/sessionCarrinho.php');
        },
        error: function(result) {
          console.log(result); // se der erro vai mostrar no CONSOLE do f12
        }

      });
    }

    function removerTudo() {
      var x;
      var r = confirm("Tem certeza que deseja apagar carrinho?");
      if (r == true) {
        $.ajax({
          url: 'comunicacao/sessionCarrinho.php?acao=removerTudo',
          async: true,
          success: function(result) {
            $('#conteudoCarrinho').load('comunicacao/sessionCarrinho.php');
          },
          error: function(result) {
            console.log(result); // se der erro vai mostrar no CONSOLE do f12
          }

        });
      }
    }
  </script>

  <div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
      <button type="button" class="btn btn-outline-primary text-left" onclick="addCarrinho()">
        <i class="fa fa-shopping-cart"></i>
        Adicionar
      </button>
      <button class="btn btn-outline-danger text-right" type="button" onclick="removerTudo()">
        <i class="fa fa-trash"></i>
        Limpar Carrinho
      </button>
    </div>
  </div>

  <br>

  <div id="pedido">
    <table class="table-bordered col-md-12" id="dados">
      <thead>
        <tr>
          <td><b>ID do Produto</b></th>
          <td><b>Produto</b></th>
          <td><b>Preço Unitário</b></th>
          <td><b>Quantidade</b></th>
          <td><b>SubTotal</b></th>
          <td><b>Opções</b></th>
        </tr>
      </thead>

      <tbody id="conteudoCarrinho">
      </tbody>

    </table>
  </div><br>


  <a href="home.php" class="btn btn-outline-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>

  <button type="button" class="btn btn-outline-success" onclick="gravarPedido()">
    <i class="fa fa-check"> </i>
    Finalizar
  </button>
  <a href="home.php?op=listar&pg=pedido" class="btn btn-outline-primary" id="bot"><i class="fa fa-search"></i> Exibir Pedidos</a>
  <br><br>


</div>

<script>
  function gravarPedido() {

    var idcliente = document.getElementById('idcliente').value;
    var idmesa = document.getElementById('idmesa').value;
    var total_liquido = document.getElementById('total').value;
    var total_bruto = document.getElementById('total').value;

    //swal(total_liquido);

    $.ajax({
      url: "salvar/pedido.php?idcliente=" + idcliente + "&idmesa=" + idmesa + "&liquido=" + total_liquido + "&bruto=" + total_bruto,
      async: true,
      success: function(result) {
        alert('O pedido foi salvo com sucesso.');
        $.ajax({
          url: 'comunicacao/sessionCarrinho.php?acao=removerTudo',
          async: true,
          success: function(result) {
            $('#conteudoCarrinho').load('comunicacao/sessionCarrinho.php');
          },
          error: function(result) {
            console.log(result); // se der erro vai mostrar no CONSOLE do f12
          }

        });
        setTimeout(function() {
          let idtipousuario = $('#idtipousuario').val();

          if (idtipousuario == 1) {
            window.location.href = "home.php";
          }else if (idtipousuario == 2) {
            window.location.href = "homefuncionario.php";
          }
         
        }, 1000);
      },
      error: function(result) {
        alert(result);
      }
    });

  }
</script>