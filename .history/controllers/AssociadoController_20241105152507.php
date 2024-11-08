<?php
require_once '../config/config.php';
require_once 'C:/xampp/htdocs/projetos/estagioTecnoTech/models/Associado.php';



$associado = new Associado($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_filiacao = $_POST['data_filiacao'];

    if ($associado->create($nome, $email, $cpf, $data_filiacao)) {
        echo "Associado cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar associado.";
    }
}
