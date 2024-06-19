<?php
/* 
    Title: inserirAgendamento.php
    Description: Programa responsável por inserir os dados na tabela tb_agendamento/tb_agendamento_servico
    Author: Victor Thomaz 
    Date: 25/05/2024
*/

include '../../../config.php';

$agendamento = new stdClass();

if ($_REQUEST['acao'] == 'atualizar') {
    // Debugging: Imprimir todos os dados recebidos
    //print_r($_REQUEST);

    // Obter os parâmetros da URL
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    $id_status = isset($_REQUEST['id_status']) ? intval($_REQUEST['id_status']) : null;

    // Verificar se id_status tem um valor específico (por exemplo, 2 ou 3)
    if ($id_status === 2) {
        $id_status += 1; // Incrementar id_status em 1
    }
    if ($id_status === 3) {
        $id_status += 1; // Incrementar id_status em 1
    }

    // Verificar se todos os dados necessários foram fornecidos
    if ($codigo !== null && $id_status !== null) {
        // Executar a consulta de atualização
        $query = "UPDATE tb_agendamento SET id_status = ? WHERE id_agendamento = ?";
        if ($stmt = mysqli_prepare($_SESSION['con'], $query)) {
            mysqli_stmt_bind_param($stmt, "ii", $id_status, $codigo);
            if (mysqli_stmt_execute($stmt)) {
                echo "Agendamento atualizado com sucesso!";
                // Redirecionar de volta para index.php
                header('Location: index.php');
                exit; // Certifique-se de que o script pare de executar após o redirecionamento
            } else {
                echo "Erro ao atualizar o agendamento: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a consulta: " . mysqli_error($_SESSION['con']);
        }
    } else {
        echo "Dados insuficientes para a atualização.";
    }
}
?>
