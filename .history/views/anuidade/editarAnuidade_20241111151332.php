<?php
require_once '../../config/config.php';
require_once '../../model/Anuidade.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID da anuidade não fornecido.";
    exit;
}

$id = $_GET['id'];

// Instancia o modelo de Anuidade
$anuidadeModel = new Anuidade($pdo);

// Busca a anuidade pelo ID
$stmt = $pdo->prepare("SELECT * FROM anuidades WHERE id = ?");
$stmt->execute([$id]);
$anuidade = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se a anuidade existe
if (!$anuidade) {
    echo "Anuidade não encontrada.";
    exit;
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novoValor = $_POST['valor'];

    // Chama o método para editar o valor da anuidade
    if ($anuidadeModel->($id, $novoValor)) {
        echo "Anuidade atualizada com sucesso!";
        header("Location: listarAnuidade.php");
        exit;
    } else {
        echo "Erro ao atualizar a anuidade.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anuidade</title>
</head>
<body>
    <h1>Editar Anuidade</h1>

    <form action="editarAnuidade.php?id=<?php echo $id; ?>" method="post">
        <label for="valor">Novo Valor:</label>
        <input type="text" name="valor" id="valor" value="<?php echo $anuidade['valor']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
    
    <a href="listarAnuidade.php">Voltar para a lista</a>
</body>
</html>
