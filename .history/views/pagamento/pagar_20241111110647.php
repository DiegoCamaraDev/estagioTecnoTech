<?php
require_once '../../config/config.php';
require_once '../../model/Pagamento.php';
require_once '../../model/StatusPagamento.php';

// Verificar se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $associado_id = $_POST['associado_id'] ?? null;
    $anuidade_id = $_POST['anuidade_id'] ?? null;
    $status_id = isset($_GET['status_id']) ? $_GET['status_id'] : null;

    if ($associado_id && $anuidade_id) {
        // Instanciar o modelo de Pagamento
        $pagamentoModel = new Pagamento($pdo);

        // Inserir um novo pagamento no banco de dados com status de "Pago"
        $status_pago = 2; // Vamos assumir que o ID 2 corresponde ao status "Pago"
        $resultado = $pagamentoModel->registerPayment($associado_id,$anuidade_id,$status_id);

        if ($resultado) {
            echo "Pagamento realizado com sucesso!";
            // Redirecionar para uma página de confirmação ou para a página do associado
            header("Location: checkout.php?id=" . $associado_id);
            exit();
        } else {
            echo "Erro ao registrar o pagamento.";
        }
    } else {
        echo "Dados insuficientes para processar o pagamento.";
    }
} else {
    echo "Método de requisição inválido.";
}
