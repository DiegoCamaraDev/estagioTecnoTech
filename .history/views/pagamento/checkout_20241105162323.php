<?php
require_once '../../config/config.php';
require_once '../../model/Associado.php';
require_once '../../model/Anuidade.php';
require_once '../../model/Pagamento.php';

$associado_id = $_GET['id'] ?? null; // ID do associado passado via URL

// Instanciando os modelos necessários
$associadoModel = new Associado($pdo);
$anuidadeModel = new Anuidade($pdo);
$pagamentoModel = new Pagamento($pdo);

// Obtendo informações do associado
$associado = $associadoModel->listForId$id);
if (!$associado) {
    echo "Associado não encontrado.";
    exit();
}

// Calculando as anuidades devidas a partir da data de filiação
$dataFiliacao = new DateTime($associado['data_filiacao']);
$anoAtual = (int) date("Y");
$anuidades = $anuidadeModel->list(); // Listando todas as anuidades cadastradas
$pagamentos = $pagamentoModel->listarPagamentos($associado_id); // Listando pagamentos feitos pelo associado

// Calcula quais anuidades ainda estão devidas
$anuidadesDevidas = [];
$totalDevido = 0;

foreach ($anuidades as $anuidade) {
    $ano = (int) $anuidade['ano'];

    // Verificar se o ano está dentro do período de filiação do associado
    if ($ano >= (int) $dataFiliacao->format('Y') && $ano <= $anoAtual) {
        // Verifica se a anuidade já foi paga
        $pago = false;
        foreach ($pagamentos as $pagamento) {
            if ($pagamento['anuidade_id'] == $anuidade['id'] && $pagamento['pago'] == 1) {
                $pago = true;
                break;
            }
        }

        if (!$pago) {
            $anuidadesDevidas[] = $anuidade;
            $totalDevido += $anuidade['valor'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout de Anuidades - Associado <?php echo htmlspecialchars($associado['nome']); ?></title>
</head>
<body>
    <h1>Checkout de Anuidades de <?php echo htmlspecialchars($associado['nome']); ?></h1>
    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($associado['email']); ?></p>
    <p><strong>Data de Filiação:</strong> <?php echo htmlspecialchars($associado['data_filiacao']); ?></p>

    <h2>Anuidades Devidas</h2>
    <?php if (count($anuidadesDevidas) > 0): ?>
        <table border="1">
            <tr>
                <th>Ano</th>
                <th>Valor</th>
                <th>Status</th>
            </tr>
            <?php foreach ($anuidadesDevidas as $anuidade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($anuidade['ano']); ?></td>
                    <td>R$ <?php echo number_format($anuidade['valor'], 2, ',', '.'); ?></td>
                    <td>Não Pago</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total Devido:</strong> R$ <?php echo number_format($totalDevido, 2, ',', '.'); ?></p>
    <?php else: ?>
        <p>O associado está em dia com as anuidades.</p>
    <?php endif; ?>

    <!-- Link para realizar o pagamento (página de pagamento) -->
    <form action="pagar.php" method="POST">
        <input type="hidden" name="associado_id" value="<?php echo htmlspecialchars($associado_id); ?>">
        <label for="anuidade_id">Selecione a Anuidade para Pagar:</label>
        <select name="anuidade_id" id="anuidade_id">
            <?php foreach ($anuidadesDevidas as $anuidade): ?>
                <option value="<?php echo htmlspecialchars($anuidade['id']); ?>">
                    <?php echo htmlspecialchars($anuidade['ano'] . ' - R$ ' . number_format($anuidade['valor'], 2, ',', '.')); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Realizar Pagamento</button>
    </form>
</body>
</html>
