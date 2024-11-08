<?php
class Associado {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($nome, $email, $cpf, $data_filiacao) {
        $stmt = $this->pdo->prepare("INSERT INTO associados (nome, email, cpf, data_filiacao) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $cpf, $data_filiacao]);
    }

    public function listar()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM associados");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um associado pelo ID
    public function listarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM associados WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um único registro
    }
}

