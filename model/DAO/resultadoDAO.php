<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/resultadoDTO.php';

class ResultadoDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Resultado
    public function newInsert(ResultadoDTO $resultadoDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.resultado (ID, Presenca, Nota, Observacao, Entrevista_Codigo)
               VALUES (:id, :presenca, :nota, :observacao, :entrevista_codigo);";
            
            $stmt = $this->dbh->prepare($query);

            $idResultado = $resultadoDTO->getId();
            $presencaResultado = $resultadoDTO->getPresenca();
            $notaResultado = $resultadoDTO->getNota();
            $observacaoResultado = $resultadoDTO->getObservacao();
            $entrevista_codigoResultado = $resultadoDTO->getEntrevista_Codigo();

            $stmt->bindParam(':id', $idResultado);
            $stmt->bindParam(':presenca', $presencaResultado);
            $stmt->bindParam(':nota', $notaResultado);
            $stmt->bindParam(':observacao', $observacaoResultado);
            $stmt->bindParam(':entrevista_codigo', $entrevista_codigoResultado);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Resultado
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.resultado;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Resultado
    public function update(ResultadoDTO $resultadoDTO)
    {
        try{
            $query = "UPDATE jmtg_service.resultado SET
                Presenca = :presenca,
                Nota = :nota,
                Observacao = :observacao,
                Entervista_Codigo = :entrevista_codigo
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idResultado = $resultadoDTO->getId();
            $presencaResultado = $resultadoDTO->getPresenca();
            $notaResultado = $resultadoDTO->getNota();
            $observacaoResultado = $resultadoDTO->getObservacao();
            $entrevista_codigoResultado = $resultadoDTO->getEntrevista_Codigo();

            $stmt->bindParam(':id', $idResultado);
            $stmt->bindParam(':presenca', $presencaResultado);
            $stmt->bindParam(':nota', $notaResultado);
            $stmt->bindParam(':observacao', $observacaoResultado);
            $stmt->bindParam(':entrevista_codigo', $entrevista_codigoResultado);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Resultado por ID
    public function getById($id)
    {
        try{
            $query = "SELECT * FROM jmtg_service.resultado WHERE ID = :id;";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_BOTH);
            return $row;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Resultado
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.resultado WHERE ID = :id;";

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