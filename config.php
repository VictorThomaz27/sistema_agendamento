<?php
session_start();

$servername = "127.0.0.1";
$username =  "admin";
$password = "admin";
$dbname = "sistema_agendamento";


//Criando a conexão com o banco 
$conn = new mysqli($servername, $username, $password, $dbname);

//Verificando a conexão 
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {

    //echo "Conexão efetuada com sucesso!";
    $_SESSION['con'] = $conn;
}

function formatString($string)
{
    
    $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
    $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
    $nova_string = str_replace($comAcentos, $semAcentos, $string);

    return $nova_string;
}

function minutosHoras($minutos) {
    // Calcula as horas e minutos
    $horas = floor($minutos / 60);
    $minutosRestantes = $minutos % 60;

    // Formata as horas e minutos para dois dígitos
    $horasFormatadas = str_pad($horas, 2, '0', STR_PAD_LEFT);
    $minutosFormatados = str_pad($minutosRestantes, 2, '0', STR_PAD_LEFT);

    // Retorna o valor formatado
    return $horasFormatadas . ':' . $minutosFormatados .':00';
}


