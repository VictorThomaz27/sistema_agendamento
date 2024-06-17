<?php

/*
    title: data.php
    Description: No data.php é onde vai ser feito o controle dos dados enviados pelos outros arquivos
    Author:  Victor Thomaz
    date: 30/05/2024
    */

include '../../../config.php';

$nome = $_POST['nome_usuario'];

//Função remove caracteres especiais 
$nome = formatString($nome);

$data = $_POST['data_usuario'];
$email = $_POST['email_usuario'];


//Select na tabela de usuarios para validar se o usuario já existe no sistema
$select = "SELECT COUNT(*) FROM tb_usuario where nome_usuario = '" . $nome . "'";
//echo '<pre>';
//echo $select;exit;

$result = mysqli_query($_SESSION['con'], $select);

$count = $result->fetch_assoc();
$count = $count['COUNT(*)'];

if ($count > 0) {
?>
    <script type="text/javascript">
        alert("Usuário já existe no sistema");
        window.location.href = "newUser.php";
    </script>
    <?php
} else {

    $sql =  "INSERT INTO tb_usuario (nome_servico, valor_servico, tempo_servico) VALUES ('" . $nome . "','" . $data . "','" . $email . "')";

    if (mysqli_query($_SESSION['con'], $sql)) {
    ?>
        <script type="text/javascript">
            alert("Cadastro efetuado com sucesso!");
            window.location.href = "newUser.php";
        </script>
<?php
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>