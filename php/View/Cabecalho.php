<?php  
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Message/MensagemAlerta.php');
?>
<html>
<head>
    <title>Minha loja</title>   
    <meta charset="utf-8">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/main.css" rel="stylesheet" />
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">            
            <div>
                <ul class="nav navbar-nav">
                    <li><a href="Ifeel.php">Prepara arquivo ifeel</a></li>
                    <li><a href="SalvaMysql.php">Ler o txt do python e salva no mysql</a></li>
                    <li><a href="Exel.php">Ler o exel e salva no mysql</a></li>                    
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="principal">
<?php
MensagemAlerta::mostraAlerta("success");
MensagemAlerta::mostraAlerta("danger");
?>