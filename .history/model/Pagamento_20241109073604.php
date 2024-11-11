<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerPayment($associado_id, $anuidade_id, $status_id = 1)
    {
    $stmt = $this->pdo->prepare("INSERT INTO pagamentos (associado_id, anuidade_id, status_id) VALUES (?, ?, ?)");
    $stmt->execute([$associado_id, $anuidade_id, $status_id]);
    return $stmt->rowCount();
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