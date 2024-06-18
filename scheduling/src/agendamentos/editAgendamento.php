<?php

/* 
        Title: editAgendamento.php
        Description: Programa responsavel pelo layout do formulário para editar um agendamento 
        Author: Victor Thomaz 
        Date: 25/05/2024
    */

ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            /* Fundo claro */
            color: #343a40;
            /* Texto escuro */
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
            /* Cor principal */
        }

        .form-group label {
            color: #495057;
            /* Cor do texto do label */
            font-weight: 500;
        }

        .form-control {
            border-radius: 4px;
            border-color: #ced4da;
            /* Cor da borda do input */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .title {
            color: #545b62;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Editar agendamento</div>
        <form id="formularioAgendamento">
            <div class="row justify-content-center">
                <label for="nome_servico">Serviços</label>
                <select class="js-select2" multiple="multiple" name="servicos[]" onchange="somaServicos()">
                    <?php
                    $select_servicos = "SELECT id_servico, nome_servico, valor_servico  FROM tb_servico";
                    $result_servicos = mysqli_query($_SESSION['con'], $select_servicos);
                    while ($row = $result_servicos->fetch_assoc()) {
                        echo '<option value="' . $row['id_servico'] . '" data-nome="' . $row['nome_servico'] . '" data-valor="' . $row['valor_servico'] . '">' . $row['nome_servico'] . '</option>';
                    }
                    ?>
                </select>


            </div>
            <div class="form-group">
                <label for="nome_cliente">Cliente</label>
                <select class='form-control' name="id_usuario">
                    <option value=""></option>
                    <?php

                    $select_usuarios = "SELECT id_usuario, nome_usuario  FROM tb_usuario";

                    $result_usuarios = mysqli_query($_SESSION['con'], $select_usuarios);

                    while ($row = $result_usuarios->fetch_assoc()) {
                        echo '<option value="' . $row['id_usuario'] . '">' . $row['nome_usuario'] . '</option>';
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_agendamento">Data</label>
                <input type='date' class="form-control" id="data" name="data" onchange="buscarHorarios()"></input>
            </div>
            <div id="demo2">
                <label for="hora">Hora</label>
                <select id="selectHorarios" class="form-select" name="hora"></select>
            </div>


            <p id="totalAgendamento" class="mt-3 mb-5 font-weight-bold">Total do Agendamento: R$ 0.00</p>


            <button type="button" id="btnCadastrar" class="btn btn-primary" onclick="cadastrarServico()">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="index.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>