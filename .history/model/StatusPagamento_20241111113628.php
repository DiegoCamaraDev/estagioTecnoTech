// StatusPagamento.php
class StatusPagamento
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function list()
    {
        $sql = "SELECT 
                    p.id AS pagamento_id,
                    a.nome AS associado_nome,
                    an.descricao AS anuidade_descricao,
                    sp.descricao AS status_descricao
                FROM pagamentos p
                JOIN associados a ON p.associado_id = a.id
                JOIN anuidades an ON p.anuidade_id = an.id
                JOIN status_pagamento sp ON p.status_id = sp.id
                ORDER BY a.nome, an.descricao";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
