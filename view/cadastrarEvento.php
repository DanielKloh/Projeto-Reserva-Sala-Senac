<?php

// Incluir o arquivo com a conexão com banco de dados
include_once '../model/conexao.php';


// Receber os dados enviado pelo JavaScript
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//definir a cor
$color = "";
if ($dados['periodo_id'] == 1) {
    $color = "#00FA9A";
} else if ($dados["periodo_id"] == 2) {
    $color = "#00BFFF";
} else {
    $color = "#FF6347";
}

$qtdDias = count($_POST["dias"]);

// Obtém a data e hora do formulário
$dataFormulario = $dados['cad_start'];

// Ajusta o formato da data e hora para o formato aceito pelo construtor de DateTime
$dataFormatada = date('Y-m-d H:i:s', strtotime($dataFormulario));

// Cria um objeto DateTime com a data e hora do formulário
$data = new DateTime($dataFormatada);

// Obtém a nova data formatada
$novaData = $data->format('Y-m-d H:i:s');

// Criar a QUERY cadastrar evento no banco de dados
$query_cad_event = "INSERT INTO reserva (sala_id, periodo_id,dataInicial,dia,professor_desc,disciplina_desc,status,observacao,data_final,color) VALUES (:sala_id, :periodo_id,:dataInicial,:dia, :professor_desc, :disciplina_desc,:status,:observacao,:data_final, :color)";

for ($i = 0; $i < $qtdDias; $i++) {

    while ($novaData < $dados['cad_end']) {

    // Prepara a QUERY
    $cad_event = $conn->prepare($query_cad_event);

    // Substituir o link pelo valor
    $cad_event->bindParam(':sala_id', $dados['sala_id']);
    $cad_event->bindParam(':periodo_id', $dados['periodo_id']);
    $cad_event->bindParam(':dataInicial', $dataFormulario);
    $cad_event->bindParam(':dia', $novaData);
    $cad_event->bindParam(':professor_desc', $dados['professor_desc']);
    $cad_event->bindParam(':disciplina_desc', $dados['disciplina_desc']);
    $cad_event->bindParam(':status', $dados['status']);
    $cad_event->bindParam(':observacao', $dados['observacao']);
    $cad_event->bindParam(':data_final', $dados['cad_end']);
    $cad_event->bindParam(':color', $color);
    $cad_event->execute();


    // Adiciona 7 dias à data
    $data->add(new DateInterval('P7D'));

    // Obtém a nova data formatada
    $novaData = $data->format('Y-m-d H:i:s');

    }
}




// Verificar se consegui cadastrar corretamente
// if ($cad_event->execute()) {
//     $retorna = ['status' => true, 'msg' => 'Evento cadastrado com sucesso!', 'id' => $conn->lastInsertId(), 'title' => $dados['disciplina_desc'], 'start' => $dados['cad_start'], 'end' => $dados['cad_end'], 'professor_desc' => $dados["professor_desc"], 'disciplina_desc' => $dados["disciplina_desc"], 'observacao' => $dados["observacao"], 'statusReserva' => $dados["status"], "color" => $color, 'periodo_id' => $dados["periodo_id"]];
// } else {
//     $retorna = ['status' => false, 'msg' => 'Erro: Evento não cadastrado!'];
// }
$retorna = ['status' => true, 'msg' => 'Evento cadastrado com sucesso!', 'id' => $conn->lastInsertId(), 'title' => $dados['disciplina_desc'], 'start' => $dados['cad_start'], 'end' => $dados['cad_end'], 'professor_desc' => $dados["professor_desc"], 'disciplina_desc' => $dados["disciplina_desc"], 'observacao' => $dados["observacao"], 'statusReserva' => $dados["status"], "color" => $color, 'periodo_id' => $dados["periodo_id"]];

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);
?>