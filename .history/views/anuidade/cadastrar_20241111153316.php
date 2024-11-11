<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Anuidade</title>
</head>
<body>
    <form action="/projetos/estagioTecnoTech/controllers/AnuidadeController.php" method="POST">
        <label>Ano:</label>
        <input type="number" name="ano" required><br>
        
        <label>Valor:</label>
        <input type="text" name="valor" required><br>
        
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="../../index.php">Voltar à página inicial</a>
</body>
</html>
