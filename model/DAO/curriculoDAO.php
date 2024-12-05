<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/curriculoDTO.php';

class CurriculoDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Curriculo
    public function newInsert(CurriculoDTO $curriculoDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.curriculo (Codigo, Sobre_Mim, Atividaes_Extracurriculares, Interesses_Profissionais, Aluno_Matricula)
               VALUES (:codigo, :sobre_mim, :atividaes_extracurriculares, :interesses_profissionais, :aluno_matricula);";
            
            $stmt = $this->dbh->prepare($query);

            $codigoCurriculo = $curriculoDTO->getCodigo();
            $sobre_mimCurriculo = $curriculoDTO->getSobre_Mim();
            $atividades_extracurricularesCurriculo = $curriculoDTO->getAtividades_Extracurriculares();
            $interesses_profissionaisCurriculo = $curriculoDTO->getInteresses_Profissionais();
            $aluno_matriculaCurriculo = $curriculoDTO->getAluno_Matricula();

            $stmt->bindParam(':codigo', $codigoCurriculo);
            $stmt->bindParam(':sobre_mim', $sobre_mimCurriculo);
            $stmt->bindParam(':atividades_extracurriculares', $atividades_extracurricularesCurriculo);
            $stmt->bindParam(':interesses_profissionais', $interesses_profissionaisCurriculo);
            $stmt->bindParam(':aluno_matricula', $aluno_matriculaCurriculo);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Curriculo
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.curriculo;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Curriculo
    public function update(CurriculoDTO $curriculoDTO)
    {
        try{
            $query = "UPDATE jmtg_service.curriculo SET
                Codigo = :codigo,
                Sobre_Mim = :sobre_mim
                Atividades_Extracurriculares = :atividades_extracurriculares
                Interesses_Profissionais = :interesses_profissionais
                Aluno_Matricula = :aluno_matricula
                WHERE Codigo = :codigo;";

            $stmt = $this->dbh->prepare($query);

            $codigoCurriculo = $curriculoDTO->getCodigo();
            $sobre_mimCurriculo = $curriculoDTO->getSobre_Mim();
            $atividades_extracurricularesCurriculo = $curriculoDTO->getAtividades_Extracurriculares();
            $interesses_profissionaisCurriculo = $curriculoDTO->getInteresses_Profissionais();
            $aluno_matriculaCurriculo = $curriculoDTO->getAluno_Matricula();

            $stmt->bindParam(':codigo', $codigoCurriculo);
            $stmt->bindParam(':sobre_mim', $sobre_mimCurriculo);
            $stmt->bindParam(':atividades_extracurriculares', $atividades_extracurricularesCurriculo);
            $stmt->bindParam(':interesses_profissionais', $interesses_profissionaisCurriculo);
            $stmt->bindParam(':aluno_matricula', $aluno_matriculaCurriculo);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Curriculo por Codigo
    public function getById($codigo)
    {
        try{
            $query = "SELECT * FROM jmtg_service.curriculo WHERE Codigo = :codigo;";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_BOTH);
            return $row;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Curriculo
    public function delete($codigo)
    {
        try{
            $query = "DELETE FROM jmtg_service.curriculo WHERE Codigo = :codigo;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':codigo', $codigo);
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
