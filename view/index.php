<?php

require_once "seguranca.php";
require_once("../controller/dashboardController.php");
require_once("../controller/salaController.php");
require_once("../model/sala.php");
$salaController = new salaController();

$dsc = new dashboardController();
$sala = new sala();
$lista = $salaController->listarSalas();
if (isset($_GET['data'])) {
	$hoje = date_create_from_format('d/m/Y', $_GET['data']);
} else {
	$hoje = new DateTime();
}



// gera o topo da index
$tabela_topo = $dsc->gerarTopoController();

// gerar o corpo do relatorio
$tabela_corpo = $dsc->gerarCorpoController($hoje);

// configurar dias
$dia_anterior = date_create_from_format('d/m/Y', $hoje->format("d/m/Y"));
$dia_anterior->modify('-1 day');

$dia_posterior = date_create_from_format('d/m/Y', $hoje->format("d/m/Y"));
$dia_posterior->modify('+1 day');

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="js/jquery.js"></script>
	<script src="js/jquery.datetimepicker.full.js"></script>
	<script src="js/dateformat.js"></script>

	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">

	<script src="js/lib.js"></script>
	<script>

		// variavel com a data

		var data = '<?= $hoje->format("d/m/Y"); ?>';
		var dia_anterior = '<?= $dia_anterior->format("d/m/Y"); ?>';
		var dia_posterior = '<?= $dia_posterior->format("d/m/Y"); ?>';
		// configura o calendario

		jQuery.datetimepicker.setLocale('pt');

		// configura a area visivel do formulario

		$(window).on('scroll resize load', getVisible);


		$(window).load(function () {
			$('#data').datetimepicker({
				timepicker: false,
				format: 'd/m/Y'
			});

		});


		function atualizaTela(o) {
			// pegar os dados da data atual e atualziar a tela
			window.location.href = "index.php?data=" + $(o).val();
		}

		function voltaTela() {
			window.location.href = "index.php?data=" + dia_anterior;
		}
		function avancaTela() {
			window.location.href = "index.php?data=" + dia_posterior;
		}

	</script>

	<title>Home</title>
</head>

<body>


	<!-- menu esquerdo -->
	<?php include "menu_esquerdo.php"; ?>


	<!--<table border="0" cellpadding="4" cellspacing="0">

			<thead>

				<? //= $tabela_topo ?>

			</thead>

		</table>

		<div class="tabelarow">

			<table border="0" cellpadding="4" cellspacing="0">

				<tbody>

					<? //= $tabela_corpo ?>

				</tbody>

			</table>

		</div> -->




	</div>


	<!-- conteudo -->

	<div class="corpo">

		<h1> Escolha a sala </h3>


		<table class="lista_comum" cellpadding="4" cellspacing="4">

			<thead>

				<tr>
					<th> id </th>
					<th> Nome </th>
				</tr>

			</thead>

			<tbody>

				<?= $lista ?>

			</tbody>

		</table>

	</div>

</body>

</html>