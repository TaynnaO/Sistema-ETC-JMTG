<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/candidaturaDTO.php';

class CandidaturaDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Candidatura
    public function newInsert(CandidaturaDTO $candidaturaDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.candidatura (Vaga_Numero, Aluno_Matricula, status)
               VALUES (:vaga_numero, :aluno_matricula, :status);";
            
            $stmt = $this->dbh->prepare($query);

            $vaga_numeroCandidatura = $candidaturaDTO->getVaga_Numero();
            $aluno_matriculaCandidatura = $candidaturaDTO->getAluno_Matricula();
            $statusCandidatura = $candidaturaDTO->getStatus();

            $stmt->bindParam(':vaga_numero', $vaga_numeroCandidatura);
            $stmt->bindParam(':aluno_matricula', $aluno_matriculaCandidatura);
            $stmt->bindParam(':status', $statusCandidatura);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Candidatura
    public function update(CandidaturaDTO $candidaturaDTO)
    {
        try{
            $query = "UPDATE jmtg_service.candidatura SET
                Vaga_Numero = :vaga_numero,
                Aluno_Matricula = :aluno_matricula
                WHERE status = :status;";

            $stmt = $this->dbh->prepare($query);

            $vaga_numeroCandidatura = $candidaturaDTO->getVaga_Numero();
            $aluno_matriculaCandidatura = $candidaturaDTO->getAluno_Matricula();
            $statusCandidatura = $candidaturaDTO->getStatus();

            $stmt->bindParam(':vaga_numero', $vaga_numeroCandidatura);
            $stmt->bindParam(':aluno_matricula', $aluno_matriculaCandidatura);
            $stmt->bindParam(':status', $statusCandidatura);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Candidatura
    public function delete($status)
    {
        try{
            $query = "DELETE FROM jmtg_service.candidatura WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            $result = $stmt->rowCount();

            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }
}
?>