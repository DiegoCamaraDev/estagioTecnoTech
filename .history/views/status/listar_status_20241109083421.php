<?php
require_once '../../config/config.php';
require_once '../../model/StatusPagamento.php';

// Instanciando o modelo StatusPagamento
$statusPagamentoModel = new StatusPagamento($pdo);

// Obtendo todos os status de pagamento
$statusPagamentos = $statusPagamentoModel->list();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Status de Pagamento</title>
</head>
<body>
    <h1>Lista de Status de Pagamento</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
        </tr>
        <?php foreach ($statusPagamentos as $status): ?>
            <tr>
                <td><?php echo htmlspecialchars($status['id']); ?></td>
                <td><?php echo htmlspecialchars($status['descricao']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
