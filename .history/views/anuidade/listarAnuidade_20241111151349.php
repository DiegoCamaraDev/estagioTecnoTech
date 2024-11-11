<?php
require_once '../../config/config.php';
require_once '../../model/Anuidade.php';

// Instancia o modelo de Anuidade
$anuidadeModel = new Anuidade($pdo);

// Lista todas as anuidades
$anuidades = $anuidadeModel->listAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Anuidades</title>
</head>
<body>
    <h1>Listagem de Anuidades</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ano</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anuidades as $anuidade): ?>
                <tr>
                    <td><?php echo $anuidade['id']; ?></td>
                    <td><?php echo $anuidade['ano']; ?></td>
                    <td><?php echo 'R$ ' . number_format($anuidade['valor'], 2, ',', '.'); ?></td>
                    <td>
                        <!-- Botão de Editar -->
                        <a href="editarAnuidade.php?id=<?php echo $anuidade['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
