<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/entrevistaDTO.php';

class EntrevistaDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Entrevista
    public function newInsert(EntrevistaDTO $entrevistaDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.entrevista (Codigo, Data, Hora, Endereco, Link, Candidatura_Vaga_Numero, Candidatura_Aluno_Matricula)
               VALUES (:codigo, :data, :hora, :endereco, :link, :candidatura_vaga_numero, :candidatura_aluno_matricula);";
            
            $stmt = $this->dbh->prepare($query);

            $codigoEntrevista = $entrevistaDTO->getCodigo();
            $dataEntrevista = $entrevistaDTO->getData();
            $horaEntrevista = $entrevistaDTO->getHora();
            $enderecoEntrevista = $entrevistaDTO->getEndereco();
            $linkEntrevista = $entrevistaDTO->getLink();
            $candidatura_vaga_numeroEntrevista = $entrevistaDTO->getCandidatura_Vaga_Numero();
            $candidatura_aluno_matriculaEntrevista = $entrevistaDTO->getCandidatura_Aluno_Matricula();

            $stmt->bindParam(':codigo', $codigoEntrevista);
            $stmt->bindParam(':data', $dataEntrevista);
            $stmt->bindParam(':hora', $horaEntrevista);
            $stmt->bindParam(':endereco', $enderecoEntrevista);
            $stmt->bindParam(':link', $linkEntrevista);
            $stmt->bindParam(':candidatura_vaga_numero', $candidatura_vaga_numeroEntrevista);
            $stmt->bindParam(':candidatura_aluno_matricula', $candidatura_aluno_matriculaEntrevista);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Entrevista
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.entrevista;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Entrevista
    public function update(EntrevistaDTO $entrevistaDTO)
    {
        try{
            $query = "UPDATE jmtg_service.entrevista SET
                Data = :data,
                Hora = :hora
                Endereco = :endereco
                Link = :link
                Candidatura_Vaga_Numero = :candidatura_vaga_numero
                Candidatura_Aluno_Matricula = :candidatura_aluno_matricula
                WHERE Codigo = :codigo;";

            $stmt = $this->dbh->prepare($query);

            $codigoEntrevista = $entrevistaDTO->getCodigo();
            $dataEntrevista = $entrevistaDTO->getData();
            $horaEntrevista = $entrevistaDTO->getHora();
            $enderecoEntrevista = $entrevistaDTO->getEndereco();
            $linkEntrevista = $entrevistaDTO->getLink();
            $candidatura_vaga_numeroEntrevista = $entrevistaDTO->getCandidatura_Vaga_Numero();
            $candidatura_aluno_matriculaEntrevista = $entrevistaDTO->getCandidatura_Aluno_Matricula();

            $stmt->bindParam(':codigo', $codigoEntrevista);
            $stmt->bindParam(':data', $dataEntrevista);
            $stmt->bindParam(':hora', $horaEntrevista);
            $stmt->bindParam(':endereco', $enderecoEntrevista);
            $stmt->bindParam(':link', $linkEntrevista);
            $stmt->bindParam(':candidatura_vaga_numero', $candidatura_vaga_numeroEntrevista);
            $stmt->bindParam(':candidatura_aluno_matricula', $candidatura_aluno_matriculaEntrevista);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Entrevista por Codigo
    public function getById($codigo)
    {
        try{
            $query = "SELECT * FROM jmtg_service.entrevista WHERE Codigo = :codigo;";
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

    //Excluir Entrevista
    public function delete($codigo)
    {
        try{
            $query = "DELETE FROM jmtg_service.entrevista WHERE Codigo = :codigo;";

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