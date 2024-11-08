<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Anuidade</title>
</head>
<body>
<form action="/raiz_do_projeto/controllers/AssociadoController.php" method="POST">
        <label>Ano:</label>
        <input type="number" name="ano" required><br>
        
        <label>Valor:</label>
        <input type="text" name="valor" required><br>
        
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
