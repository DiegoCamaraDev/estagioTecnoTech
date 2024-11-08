<?php
class Associado {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $email, $cpf, $data_filiacao) {
        $stmt = $this->pdo->prepare("INSERT INTO associados (nome, email, cpf, data_filiacao) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $cpf, $data_filiacao]);
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM associados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
