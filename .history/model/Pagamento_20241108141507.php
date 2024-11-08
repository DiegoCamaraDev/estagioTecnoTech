<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerPayment($associado_id, $anuidade_id, $status_id)
{
    $stmt = $this->pdo->prepare("INSERT INTO pagamentos (associado_id, anuidade_id, status_id) VALUES (:associado_id, :anuidade_id, :status_id)");
    $stmt->bindParam(':associado_id', $associado_id, PDO::PARAM_INT);
    $stmt->bindParam(':anuidade_id', $anuidade_id, PDO::PARAM_INT);
    $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    return $stmt->execute();
}


    public function listarPagamentos($associado_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pagamentos WHERE associado_id = ?");
        $stmt->execute([$associado_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}