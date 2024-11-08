<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Anuidade</title>
</head>
<body>
    <form action="../controllers/AnuidadeController.php" method="POST">
        <label>Ano:</label>
        <input type="number" name="ano" required><br>
        
        <label>Valor:</label>
        <input type="text" name="valor" required><br>
        
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
