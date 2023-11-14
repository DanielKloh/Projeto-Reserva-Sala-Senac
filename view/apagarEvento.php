<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Receber o id enviado pelo JavaScript
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Acessa o IF quando exite o id do evento
if (!empty($id)) {

    // Criar a QUERY apagar evento no banco de dados
    $query_apagar_reserva = "DELETE FROM reserva WHERE id=:id";

    // Prepara a QUERY
    $apagar_reserva = $conn->prepare($query_apagar_reserva);

    // Substituir o link pelo valor
    $apagar_reserva->bindParam(':id', $id);

    // Verificar se consegui apagar corretamente
    if($apagar_reserva->execute()){
        $retorna = ['status' => true, 'msg' => 'Reserva apagada com sucesso!'];
    }else{
        $retorna = ['status' => false, 'msg' => 'Erro: Reserva não apagada!'];
    }

} else { // Acessa o ELSE quando o id está vazio
    $retorna = ['status' => false, 'msg' => 'Erro: Necessário enviar o id da Reserva!'];
}

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);

