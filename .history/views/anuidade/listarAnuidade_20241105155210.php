<?php
// Inclui a configuração do banco de dados
require_once '../../config/config.php';
require_once '../../model/Associado.php';

$anuidadeModel = new Anuidade($pdo);

$anuidadeModel = $anuidadeModel->list();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Anuidades</title>
</head>
<body>
    
</body>
</html>