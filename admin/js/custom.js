$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#busca').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#busca" ).autocomplete({
	    minLength: 2,
	    source: function( request, response ) {
	        $.ajax({
	            url: "comunicacao/conecta.php",
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete',
	                parametro: $('#busca').val()
	            },
	            success: function(data) {
	               response(data);
	            }
	        });
	    },
	    focus: function( event, ui ) {
	        $("#busca").val( ui.item.nomeProduto );
	        carregarDados();
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#busca").val( ui.item.nomeProduto );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>Código: </b>" + item.idProduto + " <b>Nome: </b>" + item.nomeProduto  + "</a>" )
        .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
    	var busca = $('#busca').val();

    	if(busca != "" && busca.length >= 2){
    		$.ajax({
	            url: "comunicacao/conecta.php",
	            dataType: "json",	
	            data: {
	            	acao: 'conecta',
	                parametro: $('#busca').val()
	            },
	            success: function( data ) {
                   /*$('#tipoPedido_idTipoPedido').val(data[0].tipoPedido_idTipoPedido);*/
	               $('#codBarras').val(data[0].codBarras);
	               $('#idProduto').val(data[0].idProduto);
	               $('#nomeProduto').val(data[0].nomeProduto);
	               $('#preco').val(data[0].preco);
	            }
	        });
    	}
    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpaCampos(){
       var busca = $('#busca').val();

       if(busca == ""){
	   	   $('#codBarras').val('');
           $('#idProduto').val('')
           $('#nomeProduto').val('');
           $('#preco').val('')
       }
    }
});

$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#busca2').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#busca2" ).autocomplete({
	    minLength: 2,
	    source: function( request, response ) {
	        $.ajax({
	            url: "comunicacao/conecta.php",
	            dataType: "json",
	            data: {
	            	acao: 'autocomplete2',
	                parametro: $('#busca2').val()
	            },
	            success: function(data) {
	               response(data);
	            }
	        });
	    },
	    focus: function( event, ui ) {
	        $("#busca2").val( ui.item.nomeCliente );
	        carregarDados();
	        return false;
	    },
	    select: function( event, ui ) {
	        $("#busca2").val( ui.item.nomeCliente );
	        return false;
	    }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><b>Cliente: </b>" + item.nomeCliente + " <b>  CPF: </b>" + item.cpfCliente  + "<b>  Telefone: </b>" + item.telefoneCliente +  "</a>" )
        .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
    	var busca = $('#busca2').val();

    	if(busca != "" && busca.length >= 2){
    		$.ajax({
	            url: "comunicacao/conecta.php",
	            dataType: "json",	
	            data: {
	            	acao: 'conecta2',
	                parametro: $('#busca2').val()
	            },
	            success: function( data ) {
                   /*$('#tipoPedido_idTipoPedido').val(data[0].tipoPedido_idTipoPedido);*/
	               $('#cpfCliente').val(data[0].cpfCliente);
	               $('#idCliente').val(data[0].idCliente);
	               $('#nomeCliente').val(data[0].nomeCliente);
	               $('#telefoneCliente').val(data[0].telefoneCliente);
	            }
	        });
    	}
    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpaCampos(){
       var busca = $('#busca2').val();

       if(busca == ""){
	   	   $('#cpfCliente').val('');
           $('#idCliente').val('')
           $('#nomeCliente').val('');
           $('#telefoneCliente').val('')
       }
    }
});