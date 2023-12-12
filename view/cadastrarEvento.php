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

$diasQueEufiz = array(0, 2);

$qtdDias = count($diasQueEufiz);


// Obtenha a data e a hora do seu formulário HTML
$data_local = $dados['cad_start']; // Substitua 'data_hora_local' pelo nome do campo em seu formulário

// Converta a data e a hora local para um objeto DateTime do PHP
$data_hora = new DateTime($data_local);

// Obtenha o dia da semana
// $dia_da_semana = $data_hora->format('w');

// Array de nomes dos dias da semana
$nomes_dias_semana = array(0, 1, 2, 3, 4, 5, 6);

// Imprime o dia da semana
//echo "A data {$data_local} é um {$nomes_dias_semana[$dia_da_semana]}.";

$arrayDias = array();

//retorna um array com o value dos dias da cemana
for ($i = 0; $i < count($nomes_dias_semana); $i++) {

    for ($j = 0; $j < count($nomes_dias_semana); $j++) {
        if ($diasQueEufiz[$i] == $j) {
            $arrayDias[$i] = $nomes_dias_semana[$j];
        }
    }

}


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

    for ($j = 0; $j < 7; $j++) {

        if ($arrayDias[$i] == $j) {

            // Obtém a data e hora do formulário
            $dataFormulario = $dados['cad_start'];

            // Ajusta o formato da data e hora para o formato aceito pelo construtor de DateTime
            $dataFormatada = date('Y-m-d H:i:s', strtotime($dataFormulario));

            // Cria um objeto DateTime com a data e hora do formulário
            $data = new DateTime($dataFormatada);
            
            if ($j == 0) {
                $data->add(new DateInterval('P0D'));
            } else if ($j == 1) {
                $data->add(new DateInterval('P1D'));
            } else if ($j == 2) {
                $data->add(new DateInterval('P2D'));
            } else if ($j == 3) {
                $data->add(new DateInterval('P3D'));
            } else if ($j == 4) {
                $data->add(new DateInterval('P4D'));
            } else if ($j == 5) {
                $data->add(new DateInterval('P5D'));
            } else if ($j == 6) {
                $data->add(new DateInterval('P6D'));
            }

            // Obtém a nova data formatada
            $novaData = $data->format('Y-m-d H:i:s');

        }
    }



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





$retorna = ['status' => true, 'msg' => 'Evento cadastrado com sucesso!', 'id' => $conn->lastInsertId(), 'title' => $dados['disciplina_desc'], 'start' => $dados['cad_start'], 'end' => $dados['cad_end'], 'professor_desc' => $dados["professor_desc"], 'disciplina_desc' => $dados["disciplina_desc"], 'observacao' => $dados["observacao"], 'statusReserva' => $dados["status"], "color" => $color, 'periodo_id' => $dados["periodo_id"]];

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);

// $dias_semana = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
?>