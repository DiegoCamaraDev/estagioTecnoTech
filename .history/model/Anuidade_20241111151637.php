<?php

class Anuidade
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    } 

    public function create($ano, $valor)
    {
        $stmt = $this->pdo->prepare("INSERT INTO anuidades (ano, valor) VALUES (?, ?)");
        return $stmt->execute([$ano, $valor]);
    }

    public function listAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM anuidades");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para calcular as anuidades devidas com base na data de filiação e no ano atual
    public function calcularAnuidadesDevidas($dataFiliacao) {
        $anoFiliacao = (int)(new DateTime($dataFiliacao))->format('Y');
        $anoAtual = (int)date('Y');

        $stmt = $this->pdo->prepare("SELECT * FROM anuidades WHERE ano >= :anoFiliacao AND ano <= :anoAtual");
        $stmt->bindParam(':anoFiliacao', $anoFiliacao, PDO::PARAM_INT);
        $stmt->bindParam(':anoAtual', $anoAtual, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar($id, $valor)
{
    $stmt = $this->pdo->prepare("UPDATE anuidades SET valor = ? WHERE id = ?");
    return $stmt->execute([$valor, $id]);
}

}