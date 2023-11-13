<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Receber os dados enviado pelo JavaScript
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$color = "";
if($dados['editarPeriodo'] == 1){
    $color = "#00FA9A";
}
else if($dados["editarPeriodo"] == 2){
    $color = "#00BFFF";
}
else{
    $color = "#FF6347";
}


// Criar a QUERY editar evento no banco de dados
$query_edit_event = "UPDATE reserva SET sala_id=:sala_id, periodo_id=:periodo_id,dia=:dia, professor_desc=:professor_desc, disciplina_desc=:disciplina_desc,status=:status,observacao=:observacao,data_final=:data_final, color=:color WHERE id=:id";

// Prepara a QUERY
$edit_event = $conn->prepare($query_edit_event);

// Substituir o link pelo valor
$edit_event->bindParam(':id', $dados['edit_id']);
$edit_event->bindParam(':sala_id', $dados['sala_id']);
$edit_event->bindParam(':periodo_id', $dados['editarPeriodo']);
$edit_event->bindParam(':dia', $dados['editar_start']);
$edit_event->bindParam(':professor_desc', $dados['editar_professor_desc']);
$edit_event->bindParam(':disciplina_desc', $dados['editar_disciplina_desc']);
$edit_event->bindParam(':status', $dados['editarStatus']);
$edit_event->bindParam(':observacao', $dados['editar_observacao']);
$edit_event->bindParam(':data_final', $dados['editar_end']);
$edit_event->bindParam(':color', $color);



// Verificar se consegui editar corretamente
if ($edit_event->execute()) {
    $retorna = ['status' => true, 'msg' => 'Evento cadastrado com sucesso!', 'id' => $dados['edit_id'], 'title' => $dados['editar_disciplina_desc'],'start' => $dados['editar_start'], 'end' => $dados['editar_end']];
} else {
    $retorna = ['status' => false, 'msg' => 'Erro: Evento não editado!'];
}

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);
