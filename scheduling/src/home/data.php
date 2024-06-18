<?php
include '../../../config.php';

function agendamentos(){

    $data_atual = date('Y-m-d');

    $select = "SELECT a.id_agendamento, 
    a.id_status,
    ag.id_servico,
    se.nome_servico,
    sts.descricao_status FROM tb_agendamento a
    left join tb_agendamento_servico ag on (ag.id_agendamento = a.id_agendamento)
    left join tb_servico se on (se.id_servico = ag.id_servico)
    left join tb_usuario us on (us.id_usuario = a.id_usuario)
    left join tb_status sts on (sts.id_status = a.id_status)
    where a.id_status in (1,2,3,4) 
    and data_agendamento= '".$data_atual."'";

    echo '<pre>';
    echo $select;
    $result = mysqli_query($_SESSION['con'], $select);
    $agendamentos = [];
    while ($row = $result->fetch_assoc()) {
        $agendamentos[] = $row;
    }
    return $agendamentos;
}

?>