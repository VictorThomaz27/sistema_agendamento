<?php

/*
    title: data.php
    Description: No data.php é onde vai ser feito o controle dos dados enviados pelos outros arquivos
    Author:  Victor Thomaz
    date: 30/05/2024
    */

include '../../../config.php';
//cria objeto servico
$usuario = new stdClass();

//execeuta a ação de deletar, ação é definida na index.php
if($_REQUEST['acao'] == 'deletar'){

    //recebe o valor id_servico
    $usuario->codigo = $_REQUEST['codigo'];

    if($usuario->codigo){

        //Cria query de delete na tabela agendamento
        $delAgendamento = "DELETE FROM tb_agendamento WHERE id_usuario =".$usuario->codigo;

        //Se der erro, mostrar o erro
        if(!mysqli_query($_SESSION['con'], $delAgendamento)){

            printf("Error message: %s\n", mysqli_error($_SESSION['con']));
    
        } else {

            //Cria query de delete na tabela usuario
            $delete = "DELETE FROM tb_usuario where id_usuario = ".$usuario->codigo;

            if(!mysqli_query($_SESSION['con'], $delete)){

            printf("Error message: %s\n", mysqli_error($_SESSION['con']));

            }else{
            ?>
            <script type="text/javascript">
                alert("Usuario excluido com sucesso");
                window.location.href = "index.php";
            </script>
            <?php
            }
        }
    }
}


if($_POST['acao'] == 'cadastrar'){
    
//Declarando Objeto
$cadastro = new stdClass();


//print_r($_POST);exit;
$cadastro->nome = $_POST['nome_usuario'];
$cadastro->email = $_POST['email_usuario'];
$cadastro->senha = $_POST['senha_usuario'];
$cadastro->tipoUsuario = $_POST['tipo_usuario'];
$cadastro->confSenha = $_POST['senha_usuario'];

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

        $sql =  "INSERT INTO tb_usuario (nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES ('" . $cadastro->nome . "','" . $cadastro->email . "','" . $cadastro->senha . "', '".$cadastro->tipoUsuario."')";

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
}
?>