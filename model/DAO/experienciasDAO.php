<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/experienciasDTO.php';

class ExperienciasDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Experiencias
    public function newInsert(ExperienciasDTO $experienciasDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.experiencias (ID, Empresa, Funcao, Periodo, Atividade, Curriculo_Codigo)
               VALUES (:id, :empresa, :funcao, :periodo, :atividade, :curriculo_codigo);";
            
            $stmt = $this->dbh->prepare($query);

            $idExperiencias = $experienciasDTO->getId();
            $empresaExperiencias = $experienciasDTO->getEmpresa();
            $funcaoExperiencias = $experienciasDTO->getFuncao();
            $periodoExperiencias = $experienciasDTO->getPeriodo();
            $atividadeExperiencias = $experienciasDTO->getAtividade();
            $curriculo_codigoExperiencias = $experienciasDTO->getCurriculo_Codigo();

            $stmt->bindParam(':id', $idExperiencias);
            $stmt->bindParam(':empresa', $empresaExperiencias);
            $stmt->bindParam(':funcao', $funcaoExperiencias);
            $stmt->bindParam(':periodo', $periodoExperiencias);
            $stmt->bindParam(':atividade', $atividadeExperiencias);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoExperiencias);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Experiencias
    public function update(ExperienciasDTO $experienciasDTO)
    {
        try{
            $query = "UPDATE jmtg_service.experiencias SET
                Empresa = :empresa,
                Funcao = :funcao
                Periodo = :periodo
                Atividade = :atividade
                Curriculo_Codigo = :curriculo_codigo
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idExperiencias = $experienciasDTO->getId();
            $empresaExperiencias = $experienciasDTO->getEmpresa();
            $funcaoExperiencias = $experienciasDTO->getFuncao();
            $periodoExperiencias = $experienciasDTO->getPeriodo();
            $atividadeExperiencias = $experienciasDTO->getAtividade();
            $curriculo_codigoExperiencias = $experienciasDTO->getCurriculo_Codigo();

            $stmt->bindParam(':id', $idExperiencias);
            $stmt->bindParam(':empresa', $empresaExperiencias);
            $stmt->bindParam(':funcao', $funcaoExperiencias);
            $stmt->bindParam(':periodo', $periodoExperiencias);
            $stmt->bindParam(':atividade', $atividadeExperiencias);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoExperiencias);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Experiencias
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.experiencias WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $id);
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