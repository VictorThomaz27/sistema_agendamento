<?php
ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

// Definindo o número de itens por página
$itens_por_pagina = 10;

// Determinando a página atual
$pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calculando o offset
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Consulta SQL com paginação
$select = "SELECT id_servico, nome_servico, descricao_servico, valor_servico, tempo_servico FROM tb_servico LIMIT $offset, $itens_por_pagina";

$result = mysqli_query($_SESSION['con'], $select);

$total_registros = mysqli_num_rows(mysqli_query($_SESSION['con'], "SELECT * FROM tb_servico"));
$total_paginas = ceil($total_registros / $itens_por_pagina);

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

        th {
            text-align: center;
            background-color: #C9A9A6
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="data-grid">
            <h3 class="text-center mb-4" style=" font-weight: bold;">Serviços</h3>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Selecionar</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Tempo</th>
                    </tr>
                </thead>
                <tbody id="dataGrid">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><input type="radio" name="selectedRow" value="' . $row['id_servico'] . '"></td>';
                        echo '<td>' . $row['nome_servico'] . '</td>';
                        echo '<td>' . $row['descricao_servico'] . '</td>';
                        echo '<td> R$ ' . $row['valor_servico'] . '</td>';
                        echo '<td>' . $row['tempo_servico'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                        <li class="page-item <?php if ($i == $pagina_atual) echo 'active'; ?>"><a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <button class="btn btn-primary" onclick="newService()">Novo</button>
            <button class="btn btn-primary" onclick="editService()">Editar</button>
            <button class="btn btn-primary" onclick="deleteService()">Excluir</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
