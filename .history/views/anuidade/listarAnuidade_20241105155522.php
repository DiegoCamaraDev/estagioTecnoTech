<?php
// Inclui a configuração do banco de dados
require_once '../../config/config.php';
require_once '../../model/Associado.php';

$anuidadeModel = new Anuidade($pdo);

$anuidades = $anuidadeModel->list();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Anuidades</title>
</head>
<body>
    <h1>Lista de Anuidades</h1>
    <table border="1">
        <tr>
            <th>Ano</th>
            <th>Valor</th>
        </tr>
        <?php foreach ($anuidades as $anuidade): ?>
            <tr>
                <td><?php echo htmlspecialchars($anuidade ['ano']); ?> </td>
                <td><?php echo htmlspecialchars($anuidade ['va']); ?> </td>
            </tr>

    </table>
</body>
</html>