<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout de Pagamento</title>
</head>
<body>
    <h1>Checkout de Pagamento</h1>
    <form action="pagar.php" method="get">
        <!-- Campo para o ID do Associado -->
        <label for="associado_id">ID do Associado:</label>
        <input type="number" id="associado_id" name="associado_id" required><br>

        <!-- Campo para o ID da Anuidade -->
        <label for="anuidade_id">ID da Anuidade:</label>
        <input type="number" id="anuidade_id" name="anuidade_id" required><br>

        <!-- Campo para o Status do Pagamento -->
        <label for="status_id">Status do Pagamento:</label>
        <input type="number" id="status_id" name="status_id" required><br>

        <!-- Botão para enviar o formulário -->
        <button type="submit">Registrar Pagamento</button>
    </form>
</body>
</html>
