<?php
include '../../../config.php';

//Declarando Objeto
$cadastro = new stdClass();

$cadastro->nome = $_POST['nome'];
$cadastro->email = $_POST['email'];
$cadastro->senha = $_POST['senha'];
$cadastro->confSenha = $_POST['confSenha'];

if ($cadastro->senha != $cadastro->confSenha) {
?>
    <script type="text/javascript">
        alert("Erro confirma senha!");
        window.location.href = "index.php";
    </script>

    <?php
} else {
    $select = "SELECT COUNT(*) FROM tb_usuario where email_usuario = '" . $cadastro->email . "'";

    $result = mysqli_query($_SESSION['con'], $select);

    $count = $result->fetch_assoc();

    if ($count['COUNT(*)'] == 0) {

        $sql =  "INSERT INTO tb_usuario (nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES ('" . $cadastro->nome . "','" . $cadastro->email . "','" . $cadastro->senha . "', 'cliente')";

        if (mysqli_query($_SESSION['con'], $sql)) {
    ?>
            <script type="text/javascript">
                alert("Cadastro efetuado com sucesso!");
                window.history.back();
            </script>
        <?php
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Usuario ja cadastrado!");
            window.location.href = "index.php";
        </script>
<?php
    }
}
