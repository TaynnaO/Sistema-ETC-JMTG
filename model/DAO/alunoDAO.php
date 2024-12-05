<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/alunoDTO.php';

class AlunoDAO
{
    public $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Alunos
    public function newInsert(AlunoDTO $alunoDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.aluno (Matricula, Nome, Data_Nascimento, CPF, Email, Endereco, CEP, Telefone, Senha, Foto, usuario_sistema_ID)
               VALUES (:matricula, :nome, :dataNascimento, :cpf, :email, :endereco, :cep, :telefone, :senha, :foto, :usuarioSistemaId);";
            
            $stmt = $this->dbh->prepare($query);

            $matriculaAluno = $alunoDTO->getMatricula();
            $nomeAluno = $alunoDTO->getNome();
            $dataNascimentoAluno = $alunoDTO->getDataNascimento();
            $cpfAluno = $alunoDTO->getCpf();
            $emailAluno = $alunoDTO->getEmail();
            $enderecoAluno = $alunoDTO->getEndereco();
            $cepAluno = $alunoDTO->getCep();
            $telefoneAluno = $alunoDTO->getTelefone();
            $senhaAluno = $alunoDTO->getSenha();
            $fotoAluno = $alunoDTO->getFoto();
            $usuarioSistemaIdAluno = $alunoDTO->getUsuarioSistemaId();

            $stmt->bindParam(':matricula', $matriculaAluno);
            $stmt->bindParam(':nome', $nomeAluno);
            $stmt->bindParam(':dataNascimento', $dataNascimentoAluno);
            $stmt->bindParam(':cpf', $cpfAluno);
            $stmt->bindParam(':email', $emailAluno);
            $stmt->bindParam(':endereco', $enderecoAluno);
            $stmt->bindParam(':cep', $cepAluno);
            $stmt->bindParam(':telefone', $telefoneAluno);
            $stmt->bindParam(':senha', $senhaAluno);
            $stmt->bindParam(':foto', $fotoAluno);
            $stmt->bindParam(':usuarioSistemaId', $usuarioSistemaIdAluno);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Alunos
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.aluno;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Alunos
    public function update(AlunoDTO $alunoDTO)
    {
        try{
            $query = "UPDATE jmtg_service.aluno SET
                Nome = :nome,
                Data_Nascimento = :dataNascimento,
                CPF = :cpf,
                Email = :email,
                Endereco = :endereco,
                CEP = :cep,
                Telefone = :telefone,
                Senha = :senha,
                Foto = :foto,
                usuario_sistema_ID = :usuarioSistemaId
                WHERE Matricula = :matricula;";

            $stmt = $this->dbh->prepare($query);

            $matriculaAluno = $alunoDTO->getMatricula();
            $nomeAluno = $alunoDTO->getNome();
            $dataNascimentoAluno = $alunoDTO->getDataNascimento();
            $cpfAluno = $alunoDTO->getCpf();
            $emailAluno = $alunoDTO->getEmail();
            $enderecoAluno = $alunoDTO->getEndereco();
            $cepAluno = $alunoDTO->getCep();
            $telefoneAluno = $alunoDTO->getTelefone();
            $senhaAluno = $alunoDTO->getSenha();
            $fotoAluno = $alunoDTO->getFoto();
            $usuarioSistemaIdAluno = $alunoDTO->getUsuarioSistemaId();

            $stmt->bindParam(':matricula', $matriculaAluno);
            $stmt->bindParam(':nome', $nomeAluno);
            $stmt->bindParam(':dataNascimento', $dataNascimentoAluno);
            $stmt->bindParam(':cpf', $cpfAluno);
            $stmt->bindParam(':email', $emailAluno);
            $stmt->bindParam(':endereco', $enderecoAluno);
            $stmt->bindParam(':cep', $cepAluno);
            $stmt->bindParam(':telefone', $telefoneAluno);
            $stmt->bindParam(':senha', $senhaAluno);
            $stmt->bindParam(':foto', $fotoAluno);
            $stmt->bindParam(':usuarioSistemaId', $usuarioSistemaIdAluno);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Aluno por Matrícula
    public function getById($matricula)
    {
        try{
            $query = "SELECT * FROM jmtg_service.aluno WHERE Matricula = :matricula;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_BOTH);
            return $row;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Aluno
    public function delete($matricula)
    {
        try{
            $query = "DELETE FROM jmtg_service.aluno WHERE Matricula = :matricula;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->execute();

            $result = $stmt->rowCount();

            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }


    public function login($matricula, $senha)
{
    try {
        $query = "SELECT Matricula, Nome, Email, Senha FROM jmtg_service.aluno WHERE Matricula = :matricula AND Senha=:senha";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Retorna o aluno se a senha estiver correta
            return $row;
        }

        return null; // Retorna null se a senha estiver incorreta
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    } finally {
        $this->dbh = null;
    }
}
}
?>
