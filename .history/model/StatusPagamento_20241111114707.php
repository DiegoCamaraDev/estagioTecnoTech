<?php

class StatusPagamento
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para listar todos os status de pagamento
    public function list()
        {
            $sql = "SELECT 
                        a.nome AS associado_nome,
                        an.id AS anuidade_id,
                        an.ano AS anuidade_ano,
                        an.valor AS anuidade_valor,
                        COALESCE(sp.descricao, 'Pendente') AS status_descricao
                    FROM associados a
                    CROSS JOIN anuidades an
                    LEFT JOIN pagamentos p ON a.id = p.associado_id AND an.id = p.anuidade_id
                    LEFT JOIN status_pagamento sp ON p.status_id = sp.id
                    ORDER BY a.nome, an.ano";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    // Método para obter um status de pagamento pelo ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM status_pagamento WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para criar um novo status de pagamento
    public function create($descricao)
    {
        $stmt = $this->pdo->prepare("INSERT INTO status_pagamento (descricao) VALUES (:descricao)");
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Método para atualizar um status de pagamento
    public function update($id, $descricao)
    {
        $stmt = $this->pdo->prepare("UPDATE status_pagamento SET descricao = :descricao WHERE id = :id");
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Método para excluir um status de pagamento
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM status_pagamento WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

