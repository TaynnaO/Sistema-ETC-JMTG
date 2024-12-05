<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/cursoDTO.php';

class CursoDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Curso
    public function newInsert(CursoDTO $cursoDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.curso (ID, Nome, Instituicao, Conclusao, Curriculo_Codigo)
                    VALUES (:id, :nome, :instituicao, :conclusao, :curriculo_codigo);";
            
            $stmt = $this->dbh->prepare($query);

            $idCurso = $cursoDTO->getId();
            $nomeCurso = $cursoDTO->getNome();
            $instituicaoCurso = $cursoDTO->getInstituicao();
            $conclusaoCurso = $cursoDTO->getConclusao();
            $curriculo_codigoCurso = $cursoDTO->getCurriculo_Codigo();

            $stmt->bindParam(':id', $idCurso);
            $stmt->bindParam(':nome', $nomeCurso);
            $stmt->bindParam(':instituicao', $instituicaoCurso);
            $stmt->bindParam(':conclusao', $conclusaoCurso);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoCurso);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Curso
    public function update(CursoDTO $cursoDTO)
    {
        try{
            $query = "UPDATE jmtg_service.curso SET
                Nome = :nome,
                Instituicao = :instituicao
                Conclusao = :conclusao
                Curriculo_Codigo = :curriculo_codigo
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idCurso = $cursoDTO->getId();
            $nomeCurso = $cursoDTO->getNome();
            $instituicaoCurso = $cursoDTO->getInstituicao();
            $conclusaoCurso = $cursoDTO->getConclusao();
            $curriculo_codigoCurso = $cursoDTO->getCurriculo_Codigo();

            $stmt->bindParam(':id', $idCurso);
            $stmt->bindParam(':nome', $nomeCurso);
            $stmt->bindParam(':cpf', $instituicaoCurso);
            $stmt->bindParam(':conclusao', $conclusaoCurso);
            $stmt->bindParam(':curriculo_codigo', $curriculo_codigoCurso);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Curso
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.curso WHERE ID = :id;";

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