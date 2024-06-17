<?php
/* 
        Title: index.php
        Description: Programa resposavel por carregar o grid de usuarios
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
    <title>Serviços</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="data-grid">
        <div class="title">Usuário</div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Selecionar</th>
                    <th>Tipo Usuario</th>
                    <th>Nome</th>
                    <th>Email</th>
                   
                </tr>
            </thead>
            <tbody id="dataGrid">
                <?php
                $select = "SELECT id_usuario, tipo_usuario, nome_usuario, email_usuario FROM tb_usuario ";

                $result = mysqli_query($_SESSION['con'], $select);

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><input type="radio" name="selectedRow" value="' . $row['id_servico'] . '"></td>';
                    echo '<td>' . $row['tipo_usuario'] . '</td>';
                    echo '<td>' . $row['nome_usuario'] . '</td>';
                    echo '<td>' . $row['email_usuario'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>

        </table>
           
        <button class="btn btn-primary" onclick="newUser()">Novo</button>
        <button class="btn btn-primary" onclick="editService()">Editar</button>
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

        //Função para chamar a tela de cadastro de usuario 
        function newUser() {

            window.location.href = '../register/';

        }
        function editService() {

            window.location.href = 'newUser.php';

}
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>