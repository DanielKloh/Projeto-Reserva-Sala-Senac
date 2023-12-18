<?php
//Monday
//Tuesday
//Wednesday
//Thursday
//Friday
//Saturday
//Sunday
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

$arrayDias = $_POST["dias"];

$qtdDias = count($arrayDias);

// Obtenha a data e a hora do seu formulário HTML
$data_local = $dados['cad_start']; // Substitua 'data_hora_local' pelo nome do campo em seu formulário

// Converta a data e a hora local para um objeto DateTime do PHP
$data_hora = new DateTime($data_local);

// Obtendo o nome do dia da semana
$diaDaSemana = $data_hora->format('l');
$diaInicial = "";
if($diaDaSemana == "Monday"){
    $diaInicial = "seg";
}
else if($diaDaSemana == "Tuesday"){
    $diaInicial = "ter";
}
else if($diaDaSemana == "Wednesday"){
    $diaInicial = "quar";
}
else if($diaDaSemana == "Thursday"){
    $diaInicial = "quin";
}
else if($diaDaSemana == "Friday"){
    $diaInicial = "sex";
}
else if($diaDaSemana == "Saturday"){
    $diaInicial = "sab";
}
else if($diaDaSemana == "Sunday"){
    $diaInicial = "dom";
}

// Criar a QUERY cadastrar evento no banco de dados
$query_cad_event = "INSERT INTO reserva (sala_id, periodo_id,dataInicial,dia,professor_desc,disciplina_desc,status,observacao,data_final,color) VALUES (:sala_id, :periodo_id,:dataInicial,:dia, :professor_desc, :disciplina_desc,:status,:observacao,:data_final, :color)";
for ($i = 0; $i < $qtdDias; $i++) {

    for ($j = 0; $j < 7; $j++) {

        // Obtém a data e hora do formulário
        $dataFormulario = $dados['cad_start'];

        // Ajusta o formato da data e hora para o formato aceito pelo construtor de DateTime
        $dataFormatada = date('Y-m-d H:i:s', strtotime($dataFormulario));

        // Cria um objeto DateTime com a data e hora do formulário
        $data = new DateTime($dataFormatada);


        //Funciona so pra segunda feira como data inicial
        if ($diaInicial == 'seg') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P0D'));
                $j=7;

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P1D'));
                $j=7;

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P2D'));
                $j=7;

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P3D'));
                $j=7;

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P4D'));
                $j=7;

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P5D'));
                $j=7;

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P6D'));
                $j=7;

            }
        }

        //Funciona so pra terça feira como data inicial
        if ($diaInicial == 'ter') {
            if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P0D'));
                $j=7;

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P1D'));
                $j=7;
            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P2D'));
                $j=7;

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P3D'));
                $j=7;

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P4D'));
                $j=7;

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P5D'));
                $j=7;

            } else if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P6D'));
                $j=7;
            }

        }

        //Funciona so pra quarta feira como data inicial
        if ($diaInicial == 'quar') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P5D'));

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P6D'));

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P0D'));

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P1D'));

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P2D'));

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P3D'));

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P4D'));

            }
        }


        //Funciona so pra quinta feira como data inicial
        if ($diaInicial == 'quin') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P4D'));

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P5D'));

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P6D'));

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P0D'));

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P1D'));

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P2D'));

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P3D'));

            }
        }


        //Funciona so pra sexta feira como data inicial
        if ($diaInicial == 'sex') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P3D'));

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P4D'));

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P5D'));

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P6D'));

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P0D'));

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P1D'));

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P2D'));

            }
        }


        //Funciona so pra sabado feira como data inicial
        if ($diaInicial == 'sab') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P2D'));

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P3D'));

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P4D'));

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P5D'));

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P6D'));

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P0D'));

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P1D'));

            }
        }


        //Funciona so pra domingo como data inicial
        if ($diaInicial == 'dom') {
            if ($arrayDias[$i] == 'seg') {
                $data->add(new DateInterval('P1D'));

            } else if ($arrayDias[$i] == 'ter') {
                $data->add(new DateInterval('P2D'));

            } else if ($arrayDias[$i] == 'quar') {
                $data->add(new DateInterval('P3D'));

            } else if ($arrayDias[$i] == 'quin') {
                $data->add(new DateInterval('P4D'));

            } else if ($arrayDias[$i] == 'sex') {
                $data->add(new DateInterval('P5D'));

            } else if ($arrayDias[$i] == 'sab') {
                $data->add(new DateInterval('P6D'));

            } else if ($arrayDias[$i] == 'dom') {
                $data->add(new DateInterval('P0D'));

            }
        }

        // Obtém a nova data formatada
        $novaData = $data->format('Y-m-d H:i:s');


    }



    do {
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
    while ($novaData < $dados['cad_end']);



}





$retorna = ['status' => true, 'msg' => 'Evento cadastrado com sucesso!', 'id' => $conn->lastInsertId(), 'title' => $dados['disciplina_desc'], 'start' => $dados['cad_start'], 'end' => $dados['cad_end'], 'professor_desc' => $dados["professor_desc"], 'disciplina_desc' => $dados["disciplina_desc"], 'observacao' => $dados["observacao"], 'statusReserva' => $dados["status"], "color" => $color, 'periodo_id' => $dados["periodo_id"]];

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);

// $dias_semana = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
?>