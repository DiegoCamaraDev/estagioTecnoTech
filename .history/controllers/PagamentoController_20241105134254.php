<?php
require_once '../config/config.php';
require_once '../models/Pagamento.php';

$pagamento = new Pagamento($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $associado_id = $_POST['associado_id'];
    $anuidade_id = $_POST['anuidade_id'];

    if ($pagamento->registrarPagamento($associado_id, $anuidade_id)) {
        echo "Pagamento registrado com sucesso!";
    } else {
        echo "Erro ao registrar pagamento.";
    }
}
?>
