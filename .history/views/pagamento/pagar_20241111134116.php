<?php
require_once '../../config/config.php';
require_once '../../model/Pagamento.php';

// Verifique se os dados foram enviados corretamente
if (isset($_POST['associado_id'], $_POST['anuidade_id'], $_POST['status_id'])) {
    $associadoId = $_POST['associado_id'];
    $anuidadeId = $_POST['anuidade_id'];
    $statusId = $_POST['status_id']; // Status "1" para "Pago" ou "2" para "Pendente"

    $pagamentoModel = new Pagamento($pdo);

    try {
        // Tente registrar o pagamento no banco de dados
        $pagamentoEfetuado = $pagamentoModel->registrarPagamento($associadoId, $anuidadeId, $statusId);

        if ($pagamentoEfetuado) {
            echo "Pagamento efetuado com sucesso!";
        } else {
            echo "Erro ao registrar o pagamento. Verifique se os dados estão corretos.";
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Dados incompletos para o pagamento.";
}
?>
