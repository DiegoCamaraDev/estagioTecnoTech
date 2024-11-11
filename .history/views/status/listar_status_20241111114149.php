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
            <th>Ano da Anuidade</th>
            <th>Valor da Anuidade</th>
            <th>Status do Pagamento</th>
        </tr>
        <?php if (!empty($statusPagamentos)): ?>
            <?php foreach ($statusPagamentos as $status): ?>
                <tr>
                    <td><?php echo htmlspecialchars($status['pagamento_id']); ?></td>
                    <td><?php echo htmlspecialchars($status['associado_nome']); ?></td>
                    <td><?php echo htmlspecialchars($status['anuidade_ano']); ?></td>
                    <td>R$ <?php echo number_format($status['anuidade_valor'], 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($status['status_descricao']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhum pagamento encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
