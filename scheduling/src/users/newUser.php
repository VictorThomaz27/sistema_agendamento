<?php
/* 
        Title: newUser.php
        Description: Programa responsavel pelo (cadastro / edição)  de usuarios 
        Author: Victor Thomaz 
        Date: 25/05/2024
*/

ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");


$usuario = new stdClass();

// Verifica se é uma ação de edição e se há valores no $_REQUEST
if (isset($_REQUEST['acao']) && $_REQUEST['acao'] === 'editar' && !empty($_REQUEST['titulo']) && !empty($_REQUEST['valor']) && !empty($_REQUEST['tempo'])) {
    $usuario->titulo = $_REQUEST['titulo'];
    $usuario->valor = $_REQUEST['valor'];
    $usuario->tempo = $_REQUEST['tempo'];
} else {
    // Se não for uma ação de edição ou se faltar algum parâmetro, define valores padrão vazios
    $usuario->titulo = '';
    $usuario->valor = '';
    $usuario->tempo = '';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuario</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-fluid {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 70%;
            max-width: 1000px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 70%;
            max-width: 600px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #800080;
            border-color: #800080;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Botão Voltar -->
        <button type="button" class="btn btn-default" onclick="goBack()" aria-label="Left Align">
            <span class="fa fa-arrow-left" aria-hidden="true"></span> Voltar
        </button>
        <div class="title">Cadastro Usuario</div>
        <form action="data.php?acao=cadastrar" method="POST">
            <div class="form-group">
                
                <label for="nomeUsuario">Nome Usuario</label>
                <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Digite o nome do usuario" value="<?php echo $usuario->titulo ?>" required oninput="capitalizeFirstLetter(this)">

            </div>
            <div class="form-group">
                
                <label for="tipo_usuario">Tipo Usuario</label>
                <select  class="form-control" id="tipo_usuario" name="tipo_usuario" value="<?php echo $usuario->tipo ?>" required >
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="cliente">Cliente</option>
    </select>
            </div>
            <div class="form-group">
                <label for="emailUsuario">Email</label>
                <input type="text" class="form-control" id="email_usuario" name="email_usuario" placeholder="Digite o email do usuario" value="<?php echo $usuario->email ?>" >
            </div>
            <div class="form-group">
                <label for="senhaUsuario">Senha</label>
                <input type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Digite o senha necessário (em minutos)" maxlength="10" value="<?php echo $usuario->senha ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="acao" value="cadastrar" >Cadastrar Usuario</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

      
        function capitalizeFirstLetter(input) {
        // Pega o valor atual do campo
        let valor = input.value;

        // Converte apenas a primeira letra para maiúscula, mantendo o restante do texto
        input.value = valor.charAt(0).toUpperCase() + valor.slice(1);
        }

        function goBack() {
			window.location.href="index.php";
		}
    </script>
</body>
</html>
