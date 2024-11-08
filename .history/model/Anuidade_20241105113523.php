<?php

class Anuidade
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    } 

    public function creat($ano, $valor)
    {
$stmt = $this->pdo->prepare("INSERT INTO anuidades (ano, valor)")
    }
}