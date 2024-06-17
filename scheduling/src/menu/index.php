<?php
ini_set("display_errors", false);

/* 
        Title: index.php
        Description: Programa responsavel por carregar o menu que flutua entre as telas do sistema
        Author: Victor Thomaz 
        Date: 25/05/2024
    */

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="menu.css">
  <link rel="stylesheet" href="../css/style.css">
  
  <style>
    .modal {
    width: 300px;
    position: fixed;
  }
  .modal-content {
    width: 300px;
  }
  .nav-link{
    color:white;
    border-radius: 5px;
  }
  .nav-link:hover{
    background-color: rgb(201, 169, 166) !important;
  }
  .navbar{
    margin-bottom: 10px;
  }
  </style>

<body style="background-color: #939393">
<nav class="navbar navbar-dark bg-dark" style="background-color: #C9A9A6;">
        <a class="nav-link"  href="../home/index.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-link" href="../agendamentos/index.php">Agendamentos</a>
        <a class="nav-link" href="../users/index.php">Usuários</a>
        <a class="nav-link" href="../services/index.php">Serviços</a>
        <a class="nav-link" href="../login/logout.php">Sair</a>
     
</nav>
