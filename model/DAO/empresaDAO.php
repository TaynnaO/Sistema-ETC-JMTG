<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/empresaDTO.php';

class EmpresaDAO
{
    public $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Empresa
    public function newInsert(EmpresaDTO $empresaDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.empresa (ID, Nome, CNPJ, Endereco, CEP, Email, Telefone, Senha, Entrevista_Codigo)
               VALUES (:id, :nome, :cnpj, :endereco, :cep, :email, :telefone, :senha, :entrevista_codigo);";
            
            $stmt = $this->dbh->prepare($query);

            $idEmpresa = $empresaDTO->getId();
            $nomeEmpresa = $empresaDTO->getNome();
            $cnpjEmpresa = $empresaDTO->getCnpj();
            $enderecoEmpresa = $empresaDTO->getEndereco();
            $cepEmpresa = $empresaDTO->getCep();
            $telefoneEmpresa = $empresaDTO->getTelefone();
            $emailEmpresa = $empresaDTO->getEmail();
            $senhaEmpresa = $empresaDTO->getSenha();
            $entrevistaCodigoEmpresa = $empresaDTO->getEntrevista_Codigo();

            $stmt->bindParam(':id', $idEmpresa);
            $stmt->bindParam(':nome', $nomeEmpresa);
            $stmt->bindParam(':cnpj', $cnpjEmpresa);
            $stmt->bindParam(':endereco', $enderecoEmpresa);
            $stmt->bindParam(':cep', $cepEmpresa);
            $stmt->bindParam(':telefone', $telefoneEmpresa);
            $stmt->bindParam(':email', $emailEmpresa);
            $stmt->bindParam(':senha', $senhaEmpresa);
            $stmt->bindParam(':entrevista_codigo', $entrevistaCodigoEmpresa);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Empresa
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.empresa;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Empresa
    public function update(EmpresaDTO $empresaDTO)
    {
        try{
            $query = "UPDATE jmtg_service.empresa SET
                Nome = :nome,
                CNPJ = :cnpj
                Endereco = :endereco
                Cep = :cep
                Email = :email
                Telefone = :telefone
                Senha = :senha
                Entrevista_Codigo = :entrevista_codigo
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idEmpresa = $empresaDTO->getId();
            $nomeEmpresa = $empresaDTO->getNome();
            $cnpjEmpresa = $empresaDTO->getCnpj();
            $enderecoEmpresa = $empresaDTO->getEndereco();
            $cepEmpresa = $empresaDTO->getCep();
            $emailEmpresa = $empresaDTO->getEmail();
            $telefoneEmpresa = $empresaDTO->getTelefone();
            $senhaEmpresa = $empresaDTO->getSenha();
            $entrevistaCodigoEmpresa = $empresaDTO->getEntrevista_Codigo();

            $stmt->bindParam(':id', $idEmpresa);
            $stmt->bindParam(':nome', $nomeEmpresa);
            $stmt->bindParam(':cnpj', $cnpjEmpresa);
            $stmt->bindParam(':endereco', $enderecoEmpresa);
            $stmt->bindParam(':cep', $cepEmpresa);
            $stmt->bindParam(':email', $emailEmpresa);
            $stmt->bindParam(':telefone', $telefoneEmpresa);
            $stmt->bindParam(':senha', $senhaEmpresa);
            $stmt->bindParam(':entrevistaCodigo', $entrevistaCodigoEmpresa);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Empresa por ID
    public function getById($id)
    {
        try{
            $query = "SELECT * FROM jmtg_service.empresa WHERE ID = :id;";
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

    //Excluir Empresa
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.empresa WHERE ID = :id;";

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

    //MD5('123') Validar Login
    public function login($cnpj, $senha)
    {
        $query = "SELECT ID, Nome, CNPJ, Email FROM jmtg_service.empresa WHERE CNPJ = :cnpj
        AND Senha = :senha;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_BOTH);
        $this->dbh = null;

        return $row;
    }
}
?>
