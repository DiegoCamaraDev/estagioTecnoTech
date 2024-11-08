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
        $stmt = $this->pdo->prepare("INSERT INTO pagamentos(associado_id)")
    }
}