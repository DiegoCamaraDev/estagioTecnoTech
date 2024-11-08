<?php
require_once '../config/config.php';
require_once '../models/Anuidade.php';

$anuidade = new Anuidade($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];

    if ($anuidade->cadastrar($ano, $valor)) {
        echo "Anuidade cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar anuidade.";
    }
}
?>
