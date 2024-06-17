<?php

/*
    title: data.php
    Description: No data.php é onde vai ser feito os processos de execução projeto
    Author:  Victor Thomaz
    date: 30/05/2024
    */

include '../../../config.php';

//cria objeto servico
$servico = new stdClass();



//execeuta a ação de deletar, ação é definida na index.php
if($_REQUEST['acao'] == 'deletar'){

    $servico->codigo = $_REQUEST['codigo'];
    $delete = "DELETE FROM tb_servico where id_servico = ".$servico->codigo;

    if(!mysqli_query($_SESSION['con'], $delete)){
        printf("Error message: %s\n", mysqli_error($_SESSION['con']));
    }else{
        ?>
            <script type="text/javascript">
                alert("Servico excluido com sucesso");
                window.location.href = "index.php";
            </script>
    <?php
    }
}

//Executa a acao de cadastrar um novo servico 
if($_POST['acao'] == 'cadastrar'){

    $servico->titulo = $_POST['titulo'];
    //Função remove caracteres especiais 
    $servico->titulo = formatString($servico->titulo);

    //Remove indicador de real da string
    $servico->valor = str_replace('R$','',$_POST['valor']);
    $servico->tempo = minutosHoras($_POST['tempo']);
    //print_r($servico);exit;

    $select = "SELECT COUNT(*) FROM tb_servico where nome_servico = '" . $servico->titulo . "'";
    //echo '<pre>';
    //echo $select;exit;
    $result = mysqli_query($_SESSION['con'], $select);
    $count = $result->fetch_assoc();
    
    echo 'Count: ';
    $count = $count['COUNT(*)'];
    
    if ($count > 0) {
    ?>
        <script type="text/javascript">
            alert("Serviço já existe no sistema");
            window.location.href = "newService.php";
        </script>
        <?php
    } else {
    
        $sql =  "INSERT INTO tb_servico (nome_servico, valor_servico, tempo_servico) VALUES ('" . $servico->titulo . "','" . $servico->valor  . "','" . $servico->tempo . "')";
    
        //valida retorno do banco de dados 
        if(!mysqli_query($_SESSION['con'], $sql)){
            printf("Error message: %s\n", mysqli_error($_SESSION['con']));
        }else{
            ?>
                <script type="text/javascript">
                    alert("Cadastro efetuado com sucesso!");
                    window.location.href = "newService.php";
                </script>
        <?php
        }
    }
}

?>