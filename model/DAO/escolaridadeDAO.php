<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/escolaridadeDTO.php';

class EscolaridadeDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Escolaridade
    public function newInsert(EscolaridadeDTO $escolaridadeDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.escolaridade (ID, Nome)
               VALUES (:id, :nome);";
            
            $stmt = $this->dbh->prepare($query);

            $idEscolaridade = $escolaridadeDTO->getId();
            $nomeEscolaridade = $escolaridadeDTO->getNome();

            $stmt->bindParam(':id', $idEscolaridade);
            $stmt->bindParam(':nome', $nomeEscolaridade);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Escolaridade
    public function update(EscolaridadeDTO $escolaridadeDTO)
    {
        try{
            $query = "UPDATE jmtg_service.escolaridade SET
                Nome = :nome,
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idEscolaridade = $escolaridadeDTO->getId();
            $nomeEscolaridade = $escolaridadeDTO->getNome();

            $stmt->bindParam(':id', $idEscolaridade);
            $stmt->bindParam(':nome', $nomeEscolaridade);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Escolaridade
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.escolaridade WHERE ID = :id;";

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