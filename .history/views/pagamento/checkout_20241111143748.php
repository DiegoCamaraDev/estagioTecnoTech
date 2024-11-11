<?php
require_once '../../config/config.php';
require_once '../../model/Associado.php';
require_once '../../model/Anuidade.php';
require_once '../../model/Pagamento.php';


$associadoModel = new Associado($pdo);
$anuidadeModel = new Anuidade($pdo);
$pagamentoModel = new Pagamento($pdo);


$associados = $associadoModel->list();

if (empty($associados)) {
    echo "Nenhum associado encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Associados</title>
</head>
    <body>
    <h1>Lista de Associados</h1>

    <?php foreach ($associados as $associado): ?>
        <h2>Associado: <?php echo htmlspecialchars($associado['nome']); ?></h2>
        <p><strong>E-mail:</strong> <?php echo htmlspecialchars($associado['email']); ?></p>
        <p><strong>CPF:</strong> <?php echo htmlspecialchars($associado['cpf']); ?></p>
        <p><strong>Data de Filiação:</strong> <?php echo htmlspecialchars($associado['data_filiacao']); ?></p>
        

        <?php
        $dataFiliacao = new DateTime($associado['data_filiacao']);
        $anoAtual = (int) date("Y");
        $anuidades = $anuidadeModel->listAll();
        $pagamentos = $pagamentoModel->listarPagamentos($associado['id']); 

        $anuidadesDevidas = [];
        $totalDevido = 0;

        foreach ($anuidades as $anuidade) {
            $ano = (int) $anuidade['ano'];

            if ($ano >= (int) $dataFiliacao->format('Y') && $ano <= $anoAtual) {
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

            <h3>Anuidades Devidas</h3>
                <?php if (count($anuidadesDevidas) > 0): ?>
                    <table border="1">
                        <tr>
                            <th>Ano</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($anuidadesDevidas as $anuidade): ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($anuidade['ano']); ?> </td>
                            <td>R$ <?php echo number_format($anuidade['valor'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($anuidade['status_pagamento']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                <p><strong>Total Devido:</strong> R$ <?php echo number_format($totalDevido, 2, ',', '.'); ?></p>
            
                <form action="pagar.php" method="POST">
    <!-- Campo oculto para o ID do Associado -->
                    <input type="hidden" name="associado_id" value="<?php echo htmlspecialchars($associado['id']); ?>">

                    <label for="anuidade_id">Selecione a Anuidade para Pagar:</label>
                    <select name="anuidade_id" id="anuidade_id">
                        <?php foreach ($anuidadesDevidas as $anuidade): ?>
                            <option value="<?php echo htmlspecialchars($anuidade['id']); ?>">
                                <?php echo htmlspecialchars($anuidade['ano'] . ' - R$ ' . number_format($anuidade['valor'], 2, ',', '.')); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

    <!-- Campo oculto para o Status do Pagamento -->
    <input  type="hidden" name="status_id" value="1"> <!-- Define como "Pendente" -->

    <button type="submit">Realizar Pagamento</button>
</form>
<?php else: ?>
    <p>O associado está em dia com as anuidades.</p>
<?php endif; ?>

        <hr>
    <?php endforeach; ?>
    </body>
</html>