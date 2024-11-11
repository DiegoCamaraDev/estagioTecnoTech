<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'nome_do_banco'; // substitua pelo seu nome do banco de dados
$username = 'usuario'; // substitua pelo seu usuário do banco de dados
$password = 'senha'; // substitua pela sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
    exit;
}

// Consulta ao banco de dados para buscar anuidades
$sql = "SELECT id, ano, valor, status_pagamento FROM anuidades";
$stmt = $pdo->query($sql);
$anuidadesDevidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Anuidades</title>
    <link rel="stylesheet" href="styles.css"> <!-- Seu arquivo de estilo -->
</head>
<body>
    <h1>Checkout - Anuidades</h1>
    <table>
        <thead>
            <tr>
                <th>Ano</th>
                <th>Valor</th>
                <th>Status de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anuidadesDevidas as $anuidade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($anuidade['ano']); ?></td>
                    <td>R$ <?php echo number_format($anuidade['valor'], 2, ',', '.'); ?></td>
                    <td>
                        <?php
                        // Exibe 'Pago' ou 'Não Pago' dependendo do status
                        if ($anuidade['status_pagamento'] === 'pago') {
                            echo 'Pago';
                        } else {
                            echo 'Não Pago';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
