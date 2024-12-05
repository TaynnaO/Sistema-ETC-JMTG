<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/formacaoDTO.php';

class FormacaoDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Formação
    public function newInsert(FormacaoDTO $formacaoDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.formacao (ID, Cuso, Ano_Conclusao, Instituicao, Curriculo_Codigo, Grau_Escolaridade_Id)
               VALUES (:id, :curso, :ano_conclusao, :instituicao, :curriculo_codigo, :grau_escolaridade_id);";
            
            $stmt = $this->dbh->prepare($query);

            $idFormacao = $formacaoDTO->getId();
            $cursoFormacao = $formacaoDTO->getCurso();
            $ano_conclusaoFormacao = $formacaoDTO->getAno_Conclusao();
            $instituicaoFormacao = $formacaoDTO->getInstituicao();
            $curriculo_codigoFormacao = $formacaoDTO->getCurriculo_Codigo();
            $grau_escolaridade_idFormacao = $formacaoDTO->getGrau_Escolaridade_Id();

            $stmt->bindParam(':id', $idFormacao);
            $stmt->bindParam(':curso', $cursoFormacao);
            $stmt->bindParam(':ano_conclusao', $ano_conclusaoFormacao);
            $stmt->bindParam(':instituicao', $instituicaoFormacao);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoFormacao);
            $stmt->bindParam(':grau_escolaridade_id', $grau_escolaridade_idFormacao);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Formação
    public function update(FormacaoDTO $formacaoDTO)
    {
        try{
            $query = "UPDATE jmtg_service.formacao SET
                Cuso = :cuso,
                Ano_Conclusao = :ano_conclusao
                Instituicao = :instituicao
                Curriculo_Codigo = :curriculo_codigo
                Grau_Escolaridade_Id = :grau_escolaridade_id
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idFormacao = $formacaoDTO->getId();
            $cursoFormacao = $formacaoDTO->getCurso();
            $ano_conclusaoFormacao = $formacaoDTO->getAno_Conclusao();
            $instituicaoFormacao = $formacaoDTO->getInstituicao();
            $curriculo_codigoFormacao = $formacaoDTO->getCurriculo_Codigo();
            $grau_escolaridade_idFormacao = $formacaoDTO->getGrau_Escolaridade_Id();

            $stmt->bindParam(':id', $idFormacao);
            $stmt->bindParam(':curso', $cursoFormacao);
            $stmt->bindParam(':ano_conclusao', $ano_conclusaoFormacao);
            $stmt->bindParam(':instituicao', $instituicaoFormacao);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoFormacao);
            $stmt->bindParam(':grau_escolaridade_id', $grau_escolaridade_idFormacao);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Formacao
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.formacao WHERE ID = :id;";

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