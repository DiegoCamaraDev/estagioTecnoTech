<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function confirmPayment($associado_id, $anuidade_id)
    {
        $stmt = $this->pdo
    }
}