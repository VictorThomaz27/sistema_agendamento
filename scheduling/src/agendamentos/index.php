<?php
/* 
        Title: index.php
        Description: Programa responsavel pelo grid de agendamentos
        Author: Victor Thomaz 
        Date: 25/05/2024
    */


ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Contar o número total de registros
$countQuery = "SELECT COUNT(*) AS total FROM tb_agendamento a
               JOIN tb_agendamento_servico ag ON (a.id_agendamento = ag.id_agendamento)
               JOIN tb_servico s ON (s.id_servico = ag.id_servico)
               JOIN tb_usuario us ON (us.id_usuario = a.id_usuario)
               JOIN tb_status sts ON (sts.id_status = a.id_status)";
$countResult = mysqli_query($_SESSION['con'], $countQuery);
$countRow = $countResult->fetch_assoc();
$total = $countRow['total'];
$totalPages = ceil($total / $limit);

// Consulta para buscar registros com limite
$select = "SELECT a.id_agendamento,
           s.nome_servico,
           us.nome_usuario,
           ag.valor_total,
           a.data_agendamento,
           a.hora_agendamento,
           sts.descricao_status
           FROM tb_agendamento a
           JOIN tb_agendamento_servico ag ON (a.id_agendamento = ag.id_agendamento)
           JOIN tb_servico s ON (s.id_servico = ag.id_servico)
           JOIN tb_usuario us ON (us.id_usuario = a.id_usuario)
           JOIN tb_status sts ON (sts.id_status = a.id_status)
           LIMIT $offset, $limit";

$result = mysqli_query($_SESSION['con'], $select);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="service.js"></script>
    <style>
        .container-fluid {
            padding: 20px;
        }

        .data-grid {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
        }

        tr {
            background-color: gray;
        }

        th{
            text-align: center;
            background-color:#C9A9A6
        }

        td {
            text-align: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="data-grid">
            <div class="title">Agendamentos</div>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Selecionar</th>
                        <th>Serviço</th>
                        <th>Nome do Cliente</th>
                        <th>Valor Total</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="dataGrid">
                    <?php
                    while($row = $result->fetch_assoc()){
                        echo '<tr>';
                        echo '<td><input type="radio" name="selectedRow" value="'.$row['id_agendamento'].'">'.$row['titulo'].'</td>';
                        echo '<td>'.$row['nome_servico'].'</td>';
                        echo '<td>'.$row['nome_usuario'].'</td>';
                        echo '<td>'.$row['valor_total'].'</td>';
                        echo '<td>'.$row['data_agendamento'].'</td>';
                        echo '<td>'.$row['hora_agendamento'].'</td>';
                        echo '<td>'.$row['descricao_status'].'</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="?page=' . $i . '" class="' . ($i == $page ? 'active' : '') . '">' . $i . '</a>';
                }
                ?>
            </div>
            <button class="btn btn-primary" onclick="newAgendamento()">Novo</button>
            <button class="btn btn-primary" onclick="editAgendamento()">Editar</button>
            <button class="btn btn-primary" onclick="getSelectedData()">Excluir</button>
        </div>
    </div>
    <script>
        function getSelectedData() {
            const radios = document.getElementsByName('selectedRow');
            let selectedValue;
            for (const radio of radios) {
                if (radio.checked) {
                    selectedValue = radio.value;
                    break;
                }
            }
            if (selectedValue) {
                const row = document.querySelector(`#dataGrid tr:nth-child(${selectedValue})`);
                const title = row.cells[1].textContent;
                const value = row.cells[2].textContent;
                const time = row.cells[3].textContent;
                alert(`Título: ${title}\nValor: ${value}\nTempo: ${time}`);
            } else {
                alert('Nenhuma linha selecionada.');
            }
        }
        function newAgendamento(){
            window.location.href = 'newAgendamento.php';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
