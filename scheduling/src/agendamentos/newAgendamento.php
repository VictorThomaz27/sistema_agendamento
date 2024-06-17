<?php

/* 
        Title: newAgendamento.php
        Description: Programa resposavel por cadastrar um novo agendamento
        Author: Victor Thomaz 
        Date: 25/05/2024
*/

ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

//print_r($_REQUEST);

if (isset($_REQUEST['id_agendamento'])) {
    $id_agendamento = $_REQUEST['id_agendamento'];

    // Recuperar os dados do serviço atual
    $query = "SELECT * FROM tb_agendamento WHERE id_agendamento = $id_agendamento";
    $result = mysqli_query($_SESSION['con'], $query);
    $agendamento = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo agendamento</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.0.0/styles/choices.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #b06e7f;
            color: black;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }
        label {
            color: black;
            font-weight: bold;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Novo agendamento</div>
        <form method="POST" action="processa_agendamento.php">
            <input type="hidden" name="id_agendamento" value="<?php echo isset($agendamento['id_agendamento']) ? $agendamento['id_agendamento'] : ''; ?>">
            <div class="form-group">
                <label for="servicos">Serviços</label>
                <select id="servicos" name="id_servicos[]" multiple>
                    <option value="select_all">Selecionar todos</option>
                    <?php 
                        $services = "SELECT id_servico, nome_servico FROM tb_servico";
                        $result = mysqli_query($_SESSION['con'], $services);
                        while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['id_servico'].'">'.$row['nome_servico'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_cliente">Cliente</label>
                <textarea class="form-control" id="id_cliente" name="id_cliente" rows="3"><?php echo isset($agendamento['id_cliente']) ? $agendamento['id_cliente'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="data_agendamento">Data</label>
                <input type="text" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo isset($agendamento['data_agendamento']) ? $agendamento['data_agendamento'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="hora_agendamento">Hora agendamento</label>
                <input type="text" class="form-control" id="hora_agendamento" name="hora_agendamento" value="<?php echo isset($agendamento['hora_agendamento']) ? $agendamento['hora_agendamento'] : ''; ?>" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.0.0/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.getElementById('servicos');
            const choices = new Choices(element, {
                removeItemButton: true,
                maxItemCount: -1,
                searchResultLimit: 10,
                renderChoiceLimit: -1,
                searchEnabled: true
            });

            element.addEventListener('change', function(event) {
                if (event.target.value === 'select_all') {
                    const allChoices = choices._store.activeChoices.map(choice => choice.value);
                    choices.setChoiceByValue(allChoices);
                }
            });
        });
    </script>
</body>
</html>
