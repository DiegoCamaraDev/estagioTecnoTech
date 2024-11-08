<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Associado</title>
</head>
<body>
    <form action="projetos/estagioTecnoTech/controllers/AssociadoController.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>
        
        <label>E-mail:</label>
        <input type="email" name="email" required><br>
        
        <label>CPF:</label>
        <input type="text" name="cpf" required><br>
        
        <label>Data de Filiação:</label>
        <input type="date" name="data_filiacao" required><br>
        
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
