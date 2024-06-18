<?php
/*
    Title: data.php
    Description: No data.php é onde vai ser feito os processos de execução projeto
    Author: Victor Thomaz
    Date: 30/05/2024
*/

include '../../../config.php';

if ($_GET['acao'] == 'horarios' && isset($_GET['data'])) {
    // Adicione lógica para verificar horários disponíveis para a data fornecida, se necessário
    // Por enquanto, vamos apenas gerar os horários de 09:00 a 18:00 para qualquer data
    $inicio = "09:00";
    $fim = "18:00";
    $intervalo = 30;
    $data = $_GET['data'];

    $horarios = gerarHorarios($inicio, $fim, $intervalo);

    $horarioReservados = buscaHorarios($data);

    $result = array_diff($horarios, $horarioReservados);

    // Certifique-se de definir o cabeçalho Content-Type para JSON
    header('Content-Type: application/json');
    echo json_encode(array_values($result));
}



function gerarHorarios($inicio, $fim, $intervalo) {
    $horarios = [];
    $horaAtual = strtotime($inicio);
    $horaFim = strtotime($fim);

    while ($horaAtual <= $horaFim) {
        $horarios[] = date('H:i', $horaAtual);
        $horaAtual = strtotime('+' . $intervalo . ' minutes', $horaAtual);
    }

    return $horarios;
}

//função responsavel por buscar os horarios que ja existem no
function buscaHorarios($data) {
    global $_SESSION;

    $horarios = [];
    $select = "SELECT hora_agendamento FROM tb_agendamento WHERE data_agendamento = '$data'";
    $result = mysqli_query($_SESSION['con'], $select);
    while ($row = $result->fetch_assoc()) {
        // Formatar a hora no formato H:i
        $horarios[] = date('H:i', strtotime($row['hora_agendamento']));
    }
    return $horarios;
}
?>
