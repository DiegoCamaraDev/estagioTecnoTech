<?php

class Pagamento 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerPayment($associadoId, $anuidadeId, $statusId)
{
    // Verifique se o pagamento já existe
    $sql = "SELECT COUNT(*) FROM pagamentos WHERE associado_id = :associadoId AND anuidade_id = :anuidadeId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['associadoId' => $associadoId, 'anuidadeId' => $anuidadeId]);
    $pagamentoExiste = $stmt->fetchColumn();

    if ($pagamentoExiste) {
        // Atualize o pagamento existente para "Pago"
        $sql = "UPDATE pagamentos SET status_id = :statusId WHERE associado_id = :associadoId AND anuidade_id = :anuidadeId";
    } else {
        // Insira um novo registro de pagamento
        $sql = "INSERT INTO pagamentos (associado_id, anuidade_id, status_id) VALUES (:associadoId, :anuidadeId, :statusId)";
    }

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        'associadoId' => $associadoId,
        'anuidadeId' => $anuidadeId,
        'statusId' => $statusId
    ]);
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