<?php
require_once '../../config/config.php';
require_once '../../model/Pagamento.php';


// Verifica se as variáveis foram enviadas via GET ou POST
$associado_id = isset($_POST['associado_id']) ? $_POST['associado_id'] : null;
$anuidade_id = isset($_POST['anuidade_id']) ? $_POST['anuidade_id'] : null;
$status_id = isset($_POST['status_id']) ? $_POST['status_id'] : null;

if ($associado_id === null || $anuidade_id === null || $status_id === null) {
    die('Erro: Todos os parâmetros (associado_id, anuidade_id, status_id) devem ser fornecidos.');
}

// Instanciando o modelo Pagamento
$pagamentoModel = new Pagamento($pdo);

try {
    $pagamentoModel->registerPayment($associado_id, $anuidade_id, $status_id);
    echo "Pagamento registrado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao registrar pagamento: " . $e->getMessage();
}

