<?php
require_once '../../config/config.php';
require_once '../../model/Associado.php';
require_once '../../model/Anuidade.php';
require_once '../../model/Pagamento.php';

// Verifique se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $associado_id = $_POST['associado_id'];
    $anuidade_id = $_POST['anuidade_id'];

    // Verifica se o ID da anuidade foi enviado corretamente
    if (!empty($associado_id) && !empty($anuidade_id)) {
        
        // Instancia os modelos
        $associadoModel = new Associado($pdo);
        $anuidadeModel = new Anuidade($pdo);
        $pagamentoModel = new Pagamento($pdo);

        // Atualiza o status do pagamento na tabela de anuidades para "pago"
        $sqlUpdate = "UPDATE anuidades SET status_pagamento = 'pago' WHERE id = :anuidade_id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':anuidade_id', $anuidade_id, PDO::PARAM_INT);
        $stmtUpdate->execute();

        // Registra o pagamento na tabela de pagamentos
        $sqlInsertPagamento = "INSERT INTO pagamentos (associado_id, anuidade_id, pago) VALUES (:associado_id, :anuidade_id, 1)";
        $stmtInsertPagamento = $pdo->prepare($sqlInsertPagamento);
        $stmtInsertPagamento->bindParam(':associado_id', $associado_id, PDO::PARAM_INT);
        $stmtInsertPagamento->bindParam(':anuidade_id', $anuidade_id, PDO::PARAM_INT);
        $stmtInsertPagamento->execute();

        // Redireciona de volta para a página de checkout ou onde necessário
        header("Location: checkout.php?sucesso=1"); // Você pode personalizar o redirecionamento conforme necessário
        exit;
    } else {
        echo "Erro: Dados insuficientes.";
        exit;
    }
} else {
    echo "Método de requisição inválido.";
    exit;
}
?>
