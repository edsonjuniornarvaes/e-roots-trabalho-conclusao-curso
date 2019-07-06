
function Somar() {
    
    var x = 0
    var y = 0

    x = $('#total').val();
    y = $('#qtd').val();

        $('#valor').each(function(i){ 

            if ($(this).val() == 1) {
                valor = Number($(this).val()) + Number(x) ;
            }else {
                valor = Number(y) * Number($(this).val()) + Number(x) ;
                 $('#total').val(valor);
            }
        });   
  
}

function Subtrair(subTotal) {
    alert (subTotal)
    /*if (qtd2.length === 1) {
        $('#total').each(function(i){ 
            r = Number($(this).val()) - Number(valor) ;
            $('#total').val(r);
        });  
    }else {

        $('#total').each(function(i){ 
            r = Number($(this).val()) - Number(valor) ;
            $('#total').val(r);
        }); 
    } */
  
}
