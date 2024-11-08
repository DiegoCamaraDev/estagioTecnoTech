<!DOCTYPE html>
<html>
<head>
    <title>Registrar Pagamento</title>
</head>
<body>
    <form action="../controllers/PagamentoController.php" method="POST">
        <label>ID do Associado:</label>
        <input type="number" name="associado_id" required><br>
        
        <label>ID da Anuidade:</label>
        <input type="number" name="anuidade_id" required><br>
        
        <button type="submit">Registrar Pagamento</button>
    </form>
</body>
</html>
