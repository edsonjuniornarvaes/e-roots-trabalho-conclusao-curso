<?php
$hora = date("H:i");

$sql = "SELECT id,horarioAbertura, horarioFechamento FROM info";
$resultado = $pdo->prepare($sql);
$resultado->execute();

$dados = $resultado->fetch(PDO::FETCH_OBJ);

if (!empty($dados->id)) {

    $horarioAbertura = $dados->horarioAbertura;
    $horarioFechamento = $dados->horarioFechamento;

    //Verifica se a hora atual esta dentre o horario de funcionamento
    if (( $hora > $horarioAbertura ) and ( $hora < $horarioFechamento )) {

        //Se sim a variavel recebe valor 1 ( ativa ) para verificar na montagem do cardápio
        $aberto = 1;
    } else {

        //Se nao a variavel recebe valor 0 ( inativa ) para verificar na listagem do cardapio.
        $aberto = 0;
    }
} else {

    $horarioAbertura = $horarioFechamento = "";
    $aberto = 0;
}
?>
<script type="text/javascript">
    function mensagemFuncionamento() {
        alert('Fora do Horário de Funcionamento');
    }
</script>