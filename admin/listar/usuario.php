<?php
	if ( !isset ( $pagina ) ) {
		echo "<h1>Acesso negado</h1>";
		exit;
	}

?>

<div class="container" id="listagem">
<table class="table-bordered table-striped" id="tb">
	<h3>Usuários Cadastrados</h3>
	<br>
	<thead id="k">
		<tr>
			<td><i class=""></i><b> ID</b></td>
			<td><i class=""></i><b> Nome</b></td>
			<td><i class=""></i><b> Login</b></td>
			<td><i class=""></i><b> Tipo</b></td>
			<td><i class=""></i><b> Status</b></td>
			<td><i class=""></i><b> Opções</b></td>
		</tr>
	</thead>
	</div>

	<?php
		//conectar no banco
		include "comunicacao/conecta.php";
		
		$sql = "SELECT u.*, t.nome tipo FROM usuario u INNER JOIN tipo_usuario t on(u.idtipousuario = t.idtipousuario) ORDER BY idusuario";

		// $sql = "SELECT p.*, m.nome marca, c.categoria FROM produto p INNER JOIN marca m on(p.idmarca = m.idmarca) 
		// INNER JOIN categoria c ON (p.idcategoria = c.idcategoria)";


		$consulta = $pdo->prepare($sql);
		$consulta->execute();

		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ))
		{
			//separar os dados
			$idusuario = $dados->idusuario;
			$nome 	   = $dados->nome;
			$login     = $dados->login;
			$tipo      = $dados->tipo;
			$status    = $dados->status;

			//formar uma linha da tabela
			echo "<tr>
					<td>$idusuario</td>
					<td>$nome</td>
					<td>$login</td>
					<td>$tipo</td>
					<td>$status</td>
					<td>
						<a href='home.php?op=cadastrar&pg=usuario&idusuario=$idusuario' class='btn btn-outline-success'>
						<i class='fa fa-edit'></i>
						</a>

						<a href=\"javascript:excluir($idusuario,'$nome')\" class='btn btn-outline-danger'>
							<i class='fa fa-trash'></i>
						</a>
					</td>
				</tr>";
		}
	?>
	
</table>

<script type="text/javascript">
	//funcao para perguntar se deseja excluir
	function excluir(idusuario,nome) {
		//pergunta e confirmar
		if ( confirm( "Deseja realmente excluir "+nome+" ? ") ) {
			//mandar excluir
			link = "home.php?pg=usuario&op=excluir&idusuario="+idusuario;
			//chamar o link
			location.href = link;
		}
	}
</script>
<br>
<a href="home.php" class="btn btn-outline-success"><i class="fa fa-chevron-left"></i> Voltar</a>
