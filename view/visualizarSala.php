<?php

require_once "seguranca.php";
require_once "../controller/salaController.php";

$salaController = new salaController();

// $sala = $salaController->excluir();
// $sala = $salaController->salvar();
$sala = $salaController->abrir();
if (isset($sala[0]))
    extract($sala[0]);

if (!isset($id)) {
    $nome = '';
    $id = 0;

}



require_once "seguranca.php";
require_once("../controller/dashboardController.php");
require_once("../controller/salaController.php");
require_once("../model/sala.php");

$dsc = new dashboardController();
$sala = new sala();
$lista = $salaController->listarcontroller();
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <script src="js/jquery.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script src="js/dateformat.js"></script>

    <!-- <link href="css/select2.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">

    <!-- <script src="js/select2.min.js"></script> -->
    <script src="js/lib.js"></script>

</head>
<title>Cadastro de salas</title>

<body>

    <!-- menu esquerdo -->
    <?php include "menu_esquerdo.php"; ?>


    <h2 class="mb-4">Agenda</h2>

    <span id="msg"></span>

    <div id='calendar'></div>

    <!-- Modal Visualizar -->
    <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="visualizarModalLabel">Visualizar o Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <dl class="row">

                        <dt class="col-sm-3">ID: </dt>
                        <dd class="col-sm-9" id="visualizar_id"></dd>

                        <dt class="col-sm-3">Título: </dt>
                        <dd class="col-sm-9" id="visualizar_title"></dd>

                        <dt class="col-sm-3">Início: </dt>
                        <dd class="col-sm-9" id="visualizar_start"></dd>

                        <dt class="col-sm-3">Fim: </dt>
                        <dd class="col-sm-9" id="visualizar_end"></dd>

                    </dl>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar -->
    <div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarModalLabel">Cadastrar o Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msgCadEvento"></span>

                    <form method="POST" id="formCadEvento">

                        <div class="row mb-3">
                            <label for="cad_title" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="cad_title" class="form-control" id="cad_title" placeholder="Título do evento">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Início</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_start" class="form-control" id="cad_start">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_end" class="col-sm-2 col-form-label">Fim</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_end" class="form-control" id="cad_end">
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="sala_id" class="col-sm-2 col-form-label">sala_id</label>
                            <div class="col-sm-10">
                                <input type="int" name="sala_id" class="form-control" id="sala_id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="periodo_id" class="col-sm-2 col-form-label">periodo_id</label>
                            <div class="col-sm-10">
                                <input type="int" name="periodo_id" class="form-control" id="periodo_id">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="professor_desc" class="col-sm-2 col-form-label">professor_desc</label>
                            <div class="col-sm-10">
                                <input type="text" name="professor_desc" class="form-control" id="professor_desc">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="disciplina_desc" class="col-sm-2 col-form-label">disciplina_desc</label>
                            <div class="col-sm-10">
                                <input type="text" name="disciplina_desc" class="form-control" id="disciplina_desc">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-2 col-form-label">status</label>
                            <div class="col-sm-10">
                                <input type="int" name="status" class="form-control" id="status">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="observacao" class="col-sm-2 col-form-label">observacao</label>
                            <div class="col-sm-10">
                                <input type="text" name="observacao" class="form-control" id="observacao">
                            </div>
                        </div>



                        <button type="submit" name="btnCadEvento" class="btn btn-success" id="btnCadEvento">Cadastrar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src='./script/index.global.min.js'></script>
    <script src="./script/bootstrap5/index.global.min.js"></script>
    <script src='./script/core/locales-all.global.min.js'></script>
    <script src="./script/custom.js"></script>
</body>

</html>