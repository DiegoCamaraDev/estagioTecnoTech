<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerPayment($associado_id, $anuidade_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pagamentos(associado_id, anuidade_id, pago) VALUES (?, ?, true)");
        return $stmt->execute([$associado_id, $anuidade_id] );
    }

    public function listarPagamentos($associado_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pagamentos WHERE associado_id = ?");
        $stmt->execute([$associado_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}