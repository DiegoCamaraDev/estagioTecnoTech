<?php

require_once '../../config/config.php';
require_once '../../model/Associado.php';

// Cria uma instância da classe Associado
$associadoModel = new Associado($pdo);

// Obtém a lista de associados
$associados = $associadoModel->list();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Associados</title>
</head>
<body>
    <h1>Lista de Associados</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Data de Filiação</th>            
        </tr>
        <?php foreach ($associados as $associado): ?>
            <tr>
                <td><?php echo htmlspecialchars($associado['id']); ?></td>
                <td><?php echo htmlspecialchars($associado['nome']); ?></td>
                <td><?php echo htmlspecialchars($associado['email']); ?></td>
                <td><?php echo htmlspecialchars($associado['cpf']); ?></td>
                <td><?php echo htmlspecialchars($associado['data_filiacao']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../../index.php">Voltar à página inicial</a>
</body>
</html>
