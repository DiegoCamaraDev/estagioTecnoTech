<?php
// Carregar configurações e modelos necessários
require_once '../../config/config.php';
require_once '/../../model/Associado.php';
require_once '/../../model/Anuidade.php';
require_once '/../../model/Pagamento.php';

// Verifique se o ID do associado foi passado como parâmetro na URL
$associado_id = $_GET['id'] ?? null;
if (!$associado_id) {
    echo "ID do associado não fornecido.";
    exit();
}

// Instanciar o modelo Associado e buscar os dados do associado
$associadoModel = new Associado($pdo);
$associado = $associadoModel->listForId($associado_id);

if (!$associado) {
    echo "Associado não encontrado.";
    exit();
}

// Obter a data de filiação do associado
$dataFiliacao = $associado['data_filiacao'];

// Instanciar o modelo Anuidade e listar anuidades devidas com base na data de filiação
$anuidadeModel = new Anuidade($pdo);
$anuidadesDevidas = $anuidadeModel->calcularAnuidadesDevidas($dataFiliacao);

// Instanciar o modelo Pagamento e calcular o total devido
$pagamentoModel = new Pagamento($pdo);
$totalDevidoInfo = $pagamentoModel->calcularTotalDevido($associado_id, $anuidadesDevidas);
$anuidadesNaoPagas = $totalDevidoInfo['anuidadesNaoPagas'];
$totalDevido = $totalDevidoInfo['totalDevido'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout das Anuidades</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px 0; }
        table, th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Checkout das Anuidades de <?php echo htmlspecialchars($associado['nome']); ?></h1>
    <h2>Anuidades Devidas</h2>

    <?php if (count($anuidadesNaoPagas) > 0): ?>
        <table>
            <tr>
                <th>Ano</th>
                <th>Valor</th>
            </tr>
            <?php foreach ($anuidadesNaoPagas as $anuidade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($anuidade['ano']); ?></td>
                    <td>R$ <?php echo number_format($anuidade['valor'], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total Devido:</strong> R$ <?php echo number_format($totalDevido, 2, ',', '.'); ?></p>
    <?php else: ?>
        <p>O associado está em dia com as anuidades.</p>
    <?php endif; ?>
</body>
</html>
