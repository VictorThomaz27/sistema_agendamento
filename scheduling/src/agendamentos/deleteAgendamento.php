<?php

/*
    title: deleteAgendamento.php
    Description: No deleteAgendamento.php é onde vai ser feito o controle dos dados enviados pelos outros arquivos
    Author:  Victor Thomaz
    date: 30/05/2024
    */

include '../../../config.php';
//cria objeto agendamento
$agendamento = new stdClass();

print_r($_REQUEST);
//execeuta a ação de deletar, ação é definida na index.php
if($_REQUEST['acao'] == 'deletar'){

    //recebe o valor agendamento
    $agendamento->codigo = $_REQUEST['codigo'];

    if($agendamento->codigo){

        //Cria query de delete na tabela agendamento agendamento
        $delAgendamento = "DELETE FROM tb_agendamento_servico WHERE id_agendamento =".$agendamento->codigo;

        //Se der erro, mostrar o erro
        if(!mysqli_query($_SESSION['con'], $delAgendamento)){

            printf("Error message: %s\n", mysqli_error($_SESSION['con']));
    
        } else {

            //Cria query de delete na tabela agendamento
            $delete = "DELETE FROM tb_agendamento where id_agendamento = ".$agendamento->codigo;

            if(!mysqli_query($_SESSION['con'], $delete)){

            printf("Error message: %s\n", mysqli_error($_SESSION['con']));

            }else{
            ?>
            <script type="text/javascript">
                alert("Agendamento excluido com sucesso");
                window.location.href = "index.php";
            </script>
            <?php
            }
        }
    }
}