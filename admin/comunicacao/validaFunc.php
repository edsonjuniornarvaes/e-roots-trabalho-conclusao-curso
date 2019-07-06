<?php
/*
    validaCPF - função para validar CPF
    Como usar: 
    $cpf = "123.123.123-34";
    $msg = validaCPF($cpf);
    if ( $msg != 1 ) echo $msg; //deu erro
*/
function validaCPF($cpfCliente) {
 
    // Extrai somente os números
    $cpfCliente = preg_replace( '/[^0-9]/is', '', $cpfCliente );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpfCliente) != 11) {
        return "O CPF precisa ter ao menos 11 números";
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpfCliente)) {
        return "CPF do Cliente inválido, informe um CPF válido";
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpfCliente{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpfCliente{$c} != $d) {
            return "CPF do Cliente inválido, informe um CPF válido";
        }
    }
    return true;
}

/* funcao para retornar data em formato us */

function formataData($data) {
    $data = explode("/",$data);
    return $data[2]."-".$data[1]."-".$data[0];
}



include "conecta.php";
include "verificaHorario.php";

date_default_timezone_set('America/Sao_Paulo');

?>

<!-- <script type="text/javascript">

$(document).ready(function(){
    $('#data_nascimento').datepicker({
        language: 'pt-BR',
        changeMonth: true,
        changeYear: true,
        autoclose: 1,
        startDate: '01-01-1930',
        endDate: '31-12-2001',
        defaultViewDate: '01-01-1930'
    });
});
</script> -->