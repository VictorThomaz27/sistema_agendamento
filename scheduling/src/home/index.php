<?php
ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

// Função para buscar os agendamentos do banco de dados
function getAgendamentos($conn) {
    $sql = "SELECT a.id_agendamento,
                   s.nome_servico,
                   us.nome_usuario,
                   ag.valor_total,
                   a.data_agendamento,
                   a.hora_agendamento,
                   sts.descricao_status
            FROM tb_agendamento a 
            JOIN tb_agendamento_servico ag ON a.id_agendamento = ag.id_agendamento
            JOIN tb_servico s ON s.id_servico = ag.id_servico
            JOIN tb_usuario us ON us.id_usuario = a.id_usuario
            JOIN tb_status sts ON sts.id_status = a.id_status";

    $result = $conn->query($sql);

    $agendamentos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $agendamentos[] = $row;
        }
    }
    return $agendamentos;
}

$agendamentos = getAgendamentos($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadro de agendamentos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
        .container {
            background-color: #f8f9fa; /* Cor de fundo mais clara */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 10px;
            border: 1px solid #dee2e6; / Cor da borda da tabela /
        }
        th, td {
            text-align: center;
            padding: 8px; / Espaçamento interno das células /
        }
        thead {
            background-color: #343a40; / Cor de fundo do cabeçalho /
            color: white; / Cor do texto no cabeçalho /
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; / Cor de fundo das linhas pares */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Quadro de agendamentos</div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Serviço</th>
                    <th>Nome do Cliente</th>
                    <th>Valor Total</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="dataGrid">
                <?php if (count($agendamentos) > 0): ?>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                            <td><?php echo htmlspecialchars($agendamento['nome_usuario']); ?></td>
                            <td>R$ <?php echo htmlspecialchars(number_format($agendamento['valor_total'], 2, ',', '.')); ?></td>
                            <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($agendamento['data_agendamento']))); ?></td>
                            <td><?php echo htmlspecialchars($agendamento['hora_agendamento']); ?></td>
                            <td><?php echo htmlspecialchars($agendamento['descricao_status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum agendamento encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>