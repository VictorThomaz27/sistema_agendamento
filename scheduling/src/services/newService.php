<?php
ini_set("display_errors", false);
include("../../../config.php");
include("../menu/index.php");


$servico = new stdClass();

// Verifica se é uma ação de edição e se há valores no $_REQUEST
if (isset($_REQUEST['acao']) && $_REQUEST['acao'] === 'editar' && !empty($_REQUEST['titulo']) && !empty($_REQUEST['valor']) && !empty($_REQUEST['tempo'])) {
    $servico->titulo = $_REQUEST['titulo'];
    $servico->valor = $_REQUEST['valor'];
    $servico->tempo = $_REQUEST['tempo'];
} else {
    // Se não for uma ação de edição ou se faltar algum parâmetro, define valores padrão vazios
    $servico->titulo = '';
    $servico->valor = '';
    $servico->tempo = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviço</title>
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
        <div class="title">Cadastro de Serviço</div>
        <form action="data.php?acao=cadastrar" method="POST">
            <div class="form-group">
                
                <label for="nomeServico">Nome do Serviço</label>
                <input type="text" class="form-control" id="nomeServico" name="titulo" placeholder="Digite o nome do serviço" value="<?php echo $servico->titulo ?>" required oninput="capitalizeFirstLetter(this)">

            </div>
            <div class="form-group">
                <label for="valorServico">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Digite o valor do serviço" value="<?php echo $servico->valor ?>" oninput="formatCurrency(this)">
            </div>
            <div class="form-group">
                <label for="tempoServico">Tempo (em minutos)</label>
                <input type="text" class="form-control" id="tempoServico" name="tempo" placeholder="Digite o tempo necessário (em minutos)" maxlength="10" value="<?php echo $servico->tempo ?>" oninput="formatarTempo(this)" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="acao" value="cadastrar" >Cadastrar Serviço</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
</body>
</html>
