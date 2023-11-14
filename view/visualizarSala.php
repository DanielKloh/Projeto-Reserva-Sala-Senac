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
require_once("../controller/detalhesReserva.php");
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

$salaId = $_GET["salaId"];
setcookie("salaId", $salaId, time() + 360, "/");

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

    <script src="js/jquery.js"></>
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


    <span id="msgResposta"></span>

    <div id='calendar'></div>

    <!-- Modal Visualizar -->
    <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel"
        aria-hidden="true"="">
        <div class="modal-dialog">
            <div class="modal-content container">
                <div class="modal-header text-center">
                    <h3 class="mt-3" id="labelVisualizar">Visualizar Dados</h3>
                    <h3 class="mt-3" id="labelEditar" style="display: none;">Editar Dados</h3>
                    <button id="btnFecharModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div id="reservaId" class="display: none;"></div>

                <div id="visualizarReserva">
                

                    <div class="row mb-3 mt-3">
                        <label for="visualizar_start" class="col-sm-3 col-form-label">Início</label>
                        <div class="col-sm-8">
                            <span type="datetime-local" class="form-control" id="visualizar_start"> </sp>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="visualizar_end" class="col-sm-3 col-form-label">Fim</label>
                        <div class="col-sm-8">
                            <span type="datetime-local" class="form-control" id="visualizar_end"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="periodo_id" class="col-sm-3 col-form-label">Turno</label>
                        <div class="col-sm-8">
                            <span class="form-control" id="turno"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="professor_desc" class="col-sm-3 col-form-label">Professor</label>
                        <div class="col-sm-8" id="porfessor_desc">
                            <span class="form-control" id="professor_desc"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="disciplina_desc" class="col-sm-3 col-form-label">Disciplina</label>
                        <div class="col-sm-8">
                            <span class="form-control" id="disciplina_desc"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <span class="form-control" id="status"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="observacao" class="col-sm-3 col-form-label">Observacao</label>
                        <div class="col-sm-8">
                            <span class="form-control" id="observacao"></span>
                        </div>
                    </div>

                    <div class="text-center mt-3 mb-5">
                        <button type="submit" class="btn btn-warning" id="btnViewEditEvento">Editar</button>
                        <button type="submit" class="btn btn-danger" id="btnDeletar" name="btnDeletar">Deletar</button>
                    </div>

                </div>

                <div id="editarReserva" style="display: none;">
                    <span id="msgEditReserva"></span>
                    <span id="msgDeletar"></span>

                    <form method="POST" id="formEditReserva">

                        <input type="hidden" id="edit_id" name="edit_id">

                        <input type="hidden" id="sala_id" name="sala_id" value="<?php echo $salaId ?>">

                        <div class="row mb-3 mt-3">
                            <label for="editar_start" class="col-sm-3 col-form-label">Início</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="editar_start" name="editar_start">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="editar_end" class="col-sm-3 col-form-label">Fim</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="editar_end" name="editar_end">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="editarPeriodo" class="col-sm-2 col-form-label">Turno</label>
                            <div class="col-sm-10">
                                <select id="editarPeriodo" class="form-select" name="editarPeriodo" required>
                                    <option selected value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="professor_desc" class="col-sm-3 col-form-label">Professor</label>
                            <div class="col-sm-8" id="porfessor_desc">
                                <input type="text" class="form-control" id="editar_professor_desc"
                                    name="editar_professor_desc">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="disciplina_desc" class="col-sm-3 col-form-label">Disciplina</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editar_disciplina_desc"
                                    name="editar_disciplina_desc">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="editarStatus" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select id="editarStatus" class="form-select" name="editarStatus" required>
                                    <option selected value="1">Reservado</option>
                                    <option value="2">Confirmada</option>
                                    <option value="3">Cancelada</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="observacao" class="col-sm-3 col-form-label">Observacao</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editar_observacao" name="editar_observacao">
                            </div>
                        </div>

                        <div class="text-center mt-3 mb-5">
                            <button type="button" name="btnViewEvento" id="btnViewEvento" class="btn-primary">Voltar</button>
                            <button type="submit" name="btnEditReserva" id="btnEditReserva" class="btn btn-success">Confirmar</button>
                        </div>

                    </form>

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

                    <span id="msg"></span>

                    <form method="POST" id="formCadEvento" class="needs-validation">

                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Início</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_start" class="form-control" id="cad_start"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_end" class="col-sm-2 col-form-label">Fim</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_end" class="form-control" id="cad_end" required>
                            </div>
                        </div>

                        <?php echo '<input type="hidden" name="sala_id" id="sala_id" value=' . $salaId . '>' ?>

                        <div class="row mb-3">
                            <label for="periodo_id" class="col-sm-2 col-form-label">Turno</label>
                            <div class="col-sm-10">
                                <select id="periodo_id" class="form-select" name="periodo_id" required>
                                    <option selected value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="professor_desc" class="col-sm-3 col-form-label">Professor</label>
                            <div class="col-sm-9">
                                <input type="text" name="professor_desc" class="form-control" id="professor_desc"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="disciplina_desc" class="col-sm-3 col-form-label">Disciplina</label>
                            <div class="col-sm-9">
                                <input type="text" name="disciplina_desc" class="form-control" id="disciplina_desc"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select id="status" class="form-select" name="status" required>
                                    <option selected value="1">Reservado</option>
                                    <option value="2">Confirmada</option>
                                    <option value="3">Cancelada</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="observacao" class="col-sm-3 col-form-label">Observacao</label>
                            <div class="col-sm-9">
                                <input type="text" name="observacao" class="form-control" id="observacao" required>
                            </div>
                        </div>



                        <button type="submit" name="btnCadEvento" class="btn btn-success"
                            id="btnCadEvento">Cadastrar</button>

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