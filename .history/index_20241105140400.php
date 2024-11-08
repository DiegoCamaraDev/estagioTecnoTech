<?php
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Devs do RN - Gerenciamento de Associados</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional: folha de estilos -->
</head>
<body>
    <h1>Devs do RN - Sistema de Gerenciamento de Associados</h1>
    <p>Bem-vindo ao sistema de gerenciamento de associados da associação Devs do RN.</p>

    <!-- Navegação para funcionalidades principais -->
    <nav>
        <ul>
            <li><a href="view/associado/cadastrar.php">Cadastrar Novo Associado</a></li>
            <li><a href="associado/listar.php">Listar Associados</a></li>
            <li><a href="anuidade/cadastrar.php">Cadastrar Nova Anuidade</a></li>
            <li><a href="anuidade/listar.php">Listar Anuidades</a></li>
            <li><a href="pagamento/checkout.php">Checkout de Anuidades</a></li>
            <li><a href="relatorio/status_pagamento.php">Status de Pagamento dos Associados</a></li>
        </ul>
    </nav>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Devs do RN - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
