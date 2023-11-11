<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';


$salaId = $_COOKIE["salaId"];

// QUERY para recuperar os eventos
$query_events = "SELECT id, disciplina_desc, dia, data_final, professor_desc,status,observacao,periodo_id, color FROM reserva where sala_id = ".$salaId."";

// Prepara a QUERY
$result_events = $conn->prepare($query_events);

// Executar a QUERY
$result_events->execute();

// Criar o array que recebe os eventos
$eventos = [];

// Percorrer a lista de registros retornado do banco de dados
while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){

    // Extrair o array
    extract($row_events);

    $eventos[] = [
        'id' => $id,
        'disciplina_desc' => $disciplina_desc,
        'start' => $dia,
        'end' => $data_final,
        'professor_desc' => $professor_desc,
        'status' => $status,
        'observacao' => $observacao,
        'turno' => $periodo_id,
        'title' => $disciplina_desc,
        'color' => $color,
    ];
}

echo json_encode($eventos);




// <?php

// // Incluir o arquivo com a conexão com banco de dados
// include_once './conexao.php';

// // QUERY para recuperar os eventos
// $query_events = "SELECT * FROM reserva";

// // Prepara a QUERY
// $result_events = $conn->prepare($query_events);

// // Executar a QUERY
// $result_events->execute();

// // Criar o array que recebe os eventos
// $eventos = [];

// // Percorrer a lista de registros retornado do banco de dados
// while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){

//     // Extrair o array
//     extract($row_events);

//     $eventos[] = [
//         // 'id' => $id,
//         // 'title' => $title,
//         // 'color' => $color,
//         // 'start' => $start,
//         // 'end' => $end,
//         'id' => $id,
//         'sala_id' => $sala_id,
//         'predio_id' => $predio_id,
//         'dia' => $dia,
//         'professor_desc' => $professor_desc,
//         'disciplina_desc' => $disciplina_desc,
//         'status' => $status,
//         'observacao' => $observacao,
//         'data_final' => $data_final,

//     ];
// }

// echo json_encode($eventos);