<?php
/* 
        Title: index.php
        Description: Programa faz a validação no banco de dados se o usuario existe ou não, caso ele exista realizar login
        Author: Victor Thomaz 
        Date: 25/05/2024
    */
include '../../../config.php';
//print_r($_POST);

//Caso as variaveis venha preenchidas faça a logica  de login 
if (isset($_POST['email']) || isset($_POST['password'])) {

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email' AND senha_usuario = '$senha'";
    $result = $conn->query($sql) or die("Falha na execução do código SQL: " . $conn->error);

    if ($result->num_rows > 0) {

        $usuario = $result->fetch_assoc();

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

?>
        <script type="text/javascript">
            alert("Seja bem vindo!");
            window.location.href = "../home/index.php";
        </script>

    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Usuario ou senha invalidos!");
            window.location.href = "index.php";
        </script>

<?php

    }
}
?>