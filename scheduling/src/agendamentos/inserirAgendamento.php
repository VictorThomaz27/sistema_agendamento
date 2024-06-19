<?php
/* 
    Title: inserirAgendamento.php
    Description: Programa responsável por inserir os dados na tabela tb_agendamento/tb_agendamento_servico
    Author: Victor Thomaz 
    Date: 25/05/2024
*/

include '../../../config.php';

// Declarando o objeto agendamento
$agendamento = new stdClass();

// Preenchendo os valores do objeto
$agendamento->id_servico = $_POST['servicos']; // array de serviços com id e duração
$agendamento->cliente = $_POST['id_usuario'];
$agendamento->data = $_POST['data'];
$agendamento->hora = $_POST['hora'];

foreach ($agendamento->id_servico as $servico) {
    // Busca o preço do serviço e o tempo médio para ele ser realizado 
    $selectServico = "SELECT valor_servico, tempo_servico FROM tb_servico WHERE id_servico = '" . $servico . "'";
    $result = mysqli_query($_SESSION['con'], $selectServico);
    $row = $result->fetch_assoc();

    $agendamento->valor = $row['valor_servico'];
    $tempoServico = $row['tempo_servico']; // Tempo de serviço em minutos

    // Validação do agendamento
    $valida = validaAgenda($agendamento);

    if ($valida == 1) {
        echo json_encode(array("success" => false, "error" => "Já existe um agendamento neste horário"));
        exit;
    } else {
        // Prepara e executa a consulta SQL para inserir o agendamento
        $sql = "INSERT INTO tb_agendamento (id_usuario, id_status, data_agendamento, hora_agendamento) 
                VALUES ('" . $agendamento->cliente . "','2','" . $agendamento->data . "','" . $agendamento->hora . "')";

        if (mysqli_query($_SESSION['con'], $sql)) {
            $agendamentoId = mysqli_insert_id($_SESSION['con']);
            // Insert na tabela tb_agendamento_servico com valores da tabela agendamento 
            $insertInter = "INSERT INTO tb_agendamento_servico (id_agendamento, id_servico, valor_total) 
                            VALUES(" . $agendamentoId . ", " . $servico . ", '" . $agendamento->valor . "')";
            
            if (!mysqli_query($_SESSION['con'], $insertInter)) {
                echo json_encode(array("success" => false, "error" => mysqli_error($_SESSION['con'])));
                exit;
            }
            // Adiciona o tempo de serviço à hora do agendamento
            $agendamento->hora = date('H:i:s', strtotime($agendamento->hora . ' +' . $tempoServico . ' minutes'));
        } else {
            echo json_encode(array("success" => false, "error" => mysqli_error($_SESSION['con'])));
            exit;
        }
    }
}

echo '<script type="text/javascript">';
echo 'alert("Cadastro efetuado com sucesso!");';
echo 'window.location.href="index.php";';
echo '</script>';

// Função que é responsável por validar o agendamento no banco de dados 
function validaAgenda($agendamento) {
    $selectAgendamento = "SELECT COUNT(*) as total FROM tb_agendamento 
                          WHERE data_agendamento ='" . $agendamento->data . "' 
                          AND hora_agendamento='" . $agendamento->hora . "'";
    $result = mysqli_query($_SESSION['con'], $selectAgendamento);
    $row = $result->fetch_assoc();

    return $row['total'];
}
?>
