<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerPayment($associado_id, $anuidade_id, $status_id) {
        // Verificar se o associado_id existe na tabela associados
        $sqlCheckAssociado = "SELECT COUNT(*) FROM associados WHERE id = :associado_id";
        $stmtCheckAssociado = $this->pdo->prepare($sqlCheckAssociado);
        $stmtCheckAssociado->execute([':associado_id' => $associado_id]);
        $associadoExists = $stmtCheckAssociado->fetchColumn();
        
        if ($associadoExists == 0) {
            throw new Exception("Erro: O associado com ID $associado_id não existe.");
        }

        // Verificar se o anuidade_id existe na tabela anuidades
        $sqlCheckAnuidade = "SELECT COUNT(*) FROM anuidades WHERE id = :anuidade_id";
        $stmtCheckAnuidade = $this->pdo->prepare($sqlCheckAnuidade);
        $stmtCheckAnuidade->execute([':anuidade_id' => $anuidade_id]);
        $anuidadeExists = $stmtCheckAnuidade->fetchColumn();

        if ($anuidadeExists == 0) {
            throw new Exception("Erro: A anuidade com ID $anuidade_id não existe.");
        }

        // Inserir o pagamento após validação
        $sql = "INSERT INTO pagamentos (associado_id, anuidade_id, status_id) VALUES (:associado_id, :anuidade_id, :status_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':associado_id' => $associado_id,
            ':anuidade_id' => $anuidade_id,
            ':status_id' => $status_id
        ]);
        return true;
        
    }



    public function listarPagamentos($associado_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pagamentos WHERE associado_id = :associado_id");
        $stmt->bindParam(':associado_id', $associado_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para calcular o total devido de anuidades não pagas
    public function calcularTotalDevido($associado_id, $anuidadesDevidas) {
        $pagamentos = $this->listarPagamentos($associado_id);

        // Filtrar anuidades que ainda não foram pagas
        $anuidadesNaoPagas = [];
        foreach ($anuidadesDevidas as $anuidade) {
            $pago = false;
            foreach ($pagamentos as $pagamento) {
                if ($pagamento['anuidade_id'] == $anuidade['id']) {
                    $pago = true;
                    break;
                }
            }
            if (!$pago) {
                $anuidadesNaoPagas[] = $anuidade;
            }
        }

        // Calcular o total devido
        $totalDevido = 0;
        foreach ($anuidadesNaoPagas as $anuidade) {
            $totalDevido += $anuidade['valor'];
        }

        return [
            'anuidadesNaoPagas' => $anuidadesNaoPagas,
            'totalDevido' => $totalDevido
        ];
    }
}