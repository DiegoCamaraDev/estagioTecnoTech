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
            <th>ID do Pagamento</th>
            <th>Nome do Associado</th>
            <th>Anuidade</th>
            <th>Status do Pagamento</th>
        </tr>
        <?php if (!empty($statusPagamentos)): ?>
            <?php foreach ($statusPagamentos as $status): ?>
                <tr>
                    <td><?php echo htmlspecialchars($status['pagamento_id']); ?></td>
                    <td><?php echo htmlspecialchars($status['associado_nome']); ?></td>
                    <td><?php echo htmlspecialchars($status['anuidade_descricao']); ?></td>
                    <td><?php echo htmlspecialchars($status['status_descricao']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhum pagamento encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
