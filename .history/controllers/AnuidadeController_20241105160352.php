<?php
require_once '../config/config.php';
require_once '../model/Anuidade.php';

$anuidade = new Anuidade($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];

    if ($anuidade->create($ano, $valor)) {
        echo "Anuidade cadastrada com sucesso!";
        echo "";
    } else {
        echo "Erro ao cadastrar anuidade.";
    }
}
?>
