<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/perfilDTO.php';

class PerfilDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Perfil
    public function newInsert(PerfilDTO $perfilDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.perfil (ID, Funcao, Descricao)
               VALUES (:id, :funcao, :descricao);";
            
            $stmt = $this->dbh->prepare($query);

            $idPerfil = $perfilDTO->getId();
            $funcaoPerfil = $perfilDTO->getFuncao();
            $descricaoPerfil = $perfilDTO->getDescricao();

            $stmt->bindParam(':id', $idPerfil);
            $stmt->bindParam(':funcao', $funcaoPerfil);
            $stmt->bindParam(':descricao', $descricaoPerfil);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Perfil
    public function update(PerfilDTO $perfilDTO)
    {
        try{
            $query = "UPDATE jmtg_service.perfil SET
                Funcao = :funcao,
                Descricao = :descricao
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idPerfil = $perfilDTO->getId();
            $funcaoPerfil = $perfilDTO->getFuncao();
            $descricaoPerfil = $perfilDTO->getDescricao();

            $stmt->bindParam(':id', $idPerfil);
            $stmt->bindParam(':funcao', $funcaoPerfil);
            $stmt->bindParam(':descricao', $descricaoPerfil);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Perfil
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.perfil WHERE ID = :id;";

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