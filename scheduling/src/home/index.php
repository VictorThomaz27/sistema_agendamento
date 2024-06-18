<?php
ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

// Simulação de dados de agendamentos para o dia atual
$agendamentos = [
    ["id" => 1, "nome" => "Agendamento 1", "status" => "Realizado"],
    ["id" => 2, "nome" => "Agendamento 2", "status" => "Realizado"],
    ["id" => 3, "nome" => "Agendamento 3", "status" => "Aguardando"],
    ["id" => 4, "nome" => "Agendamento 4", "status" => "Aguardando"],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="title">Quadro de agendamentos</div>
        <div class="divider"></div>

        <!-- Cartões de resumo de agendamentos -->
        <div class="d-flex justify-content-around">
            <div class="card bg-light p-4">
                <div>Realizados</div>
                <h1><?php echo count(array_filter($agendamentos, function($agendamento) { return $agendamento['status'] == 'Realizado'; })); ?></h1>
            </div>
            <div class="card bg-light p-4">
                <div>Aguardando</div>
                <h1><?php echo count(array_filter($agendamentos, function($agendamento) { return $agendamento['status'] == 'Aguardando'; })); ?></h1>
            </div>
        </div>

        <!-- Data-grid de agendamentos do dia -->
        <div class="title mt-4">Agendamentos do Dia</div>
        <div class="divider"></div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <tr>
                        <td><?php echo $agendamento['id']; ?></td>
                        <td><?php echo $agendamento['nome']; ?></td>
                        <td><?php echo $agendamento['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
