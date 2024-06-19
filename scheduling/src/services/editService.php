<?php
ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");

//print_r($_REQUEST);

   


if (isset($_REQUEST['id_servico'])) {
    $id_servico = $_REQUEST['id_servico'];

    // Recuperar os dados do serviço atual
    $query = "SELECT * FROM tb_servico WHERE id_servico = $id_servico";
    $result = mysqli_query($_SESSION['con'], $query);
    $servico = mysqli_fetch_assoc($result);
}

// Verificar se o formulário foi enviado para atualizar o serviço
if (isset($_REQUEST['update'])) {

    $servico = new stdClass();
    //print_r($_POST);exit;
    $servico->id = $_POST['id_servico'];
    $servico->nome = $_POST['nome_servico'];
    $servico->descricao = $_POST['descricao_servico'];
    $servico->valor =  str_replace('R$','',$_POST['valor_servico']);
    $servico->tempo = minutosHoras($_POST['tempo_servico']);

    //print_r($servico);exit;

    // Atualizar os dados do serviço no banco de dados
    $update_query = "UPDATE tb_servico SET 
                     nome_servico = '$servico->nome',
                     descricao_servico = '$servico->descricao',
                     valor_servico = '$servico->valor',
                     tempo_servico = '$servico->tempo'
                     WHERE id_servico = $servico->id";
    
    if (mysqli_query($_SESSION['con'], $update_query)) {
        echo '<script>alert("Serviço atualizado com sucesso!");</script>';
        echo '<script>window.location.href = "index.php";</script>'; // Redireciona para index.php
        exit;
    } else {
        echo '<script>alert("Erro ao atualizar serviço: ' . mysqli_error($_SESSION['con']) . '");</script>';
    }
}
//Transformando horas em minutos
$tempo = $servico['tempo_servico'];
$hora = substr($tempo, -7);
$min = ($hora * 60);
//$tempo_formatado = str_replace(':00', '', $tempo);

$timestamp = strtotime($servico['tempo_servico']);
$tempo_formatado = date('i:s', $timestamp);
$tempo_servico = $tempo_formatado +$min;
$servico['tempo_servico'] = $tempo_servico;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #b06e7f; /* Cor de fundo */
            color: white; /* Cor do texto */
        }
        .container {
            background-color: #fff; /* Cor de fundo do container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
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
        <div class="title">Editar Serviço</div>
        <form method="POST">
            <input type="hidden" name="id_servico" value="<?php echo $servico['id_servico']; ?>">
            <div class="form-group">
                <label for="nome_servico">Nome do Serviço</label>
                <input type="text" class="form-control" id="nome_servico" name="nome_servico" value="<?php echo $servico['nome_servico']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao_servico">Descrição do Serviço</label>
                <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="3"><?php echo $servico['descricao_servico']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="valorServico">Valor</label>
                <input type="text" class="form-control" id="valor_servico" name="valor_servico" placeholder="Digite o valor do serviço" value="<?php echo $servico['valor_servico']; ?>" oninput="formatCurrency(this)">
            </div>
            <div class="form-group">
                <label for="tempoServico">Tempo (em minutos)</label>
                <input type="text" class="form-control" id="tempo_servico" name="tempo_servico" placeholder="Digite o tempo necessário (em minutos)" maxlength="10" value="<?php echo $servico['tempo_servico']; ?>" oninput="formatarTempo(this)" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a> <!-- Botão de cancelar -->
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
        function formatarTempo(input) {
            // Remove qualquer caractere não numérico do valor inserido
            let valor = input.value.replace(/\D/g, '');

            // Atualiza o valor no campo de entrada
            input.value = valor + ' min';

            // Posiciona o cursor antes do " min"
            input.setSelectionRange(valor.length, valor.length);
        }

        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, '');
            value = (value / 100).toFixed(2) + '';
            value = value.replace(".", ",");
            value = value.replace(/(\d)(?=(\d{3})+(\D))/g, "$1.");
            input.value = 'R$ ' + value;
        }

      
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
</html>
