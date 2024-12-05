<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/adminDTO.php';

class AdminDAO
{
    public $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Administrador
    public function newInsert(AdminDTO $adminDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.usuario_sistema (ID, Nome, CPF, Telefone, Email, Senha, Perfil_ID)
               VALUES (:id, :nome, :cpf, :telefone, :email, :senha, :perfilId);";
            
            $stmt = $this->dbh->prepare($query);

            $idAdmin = $adminDTO->getId();
            $nomeAdmin = $adminDTO->getNome();
            $cpfAdmin = $adminDTO->getCpf();
            $telefoneAdmin = $adminDTO->getTelefone();
            $emailAdmin = $adminDTO->getEmail();
            $senhaAdmin = $adminDTO->getSenha();
            $perfilIdAdmin = $adminDTO->getperfil_Id();

            $stmt->bindParam(':id', $idAdmin);
            $stmt->bindParam(':nome', $nomeAdmin);
            $stmt->bindParam(':cpf', $cpfAdmin);
            $stmt->bindParam(':telefone', $telefoneAdmin);
            $stmt->bindParam(':email', $emailAdmin);
            $stmt->bindParam(':senha', $senhaAdmin);
            $stmt->bindParam(':perfilId', $perfilIdAdmin);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Administradores
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.usuario_sistema;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Administrador
    public function update(AdminDTO $adminDTO)
    {
        try{
            $query = "UPDATE jmtg_service.usuario_sistema SET
                Nome = :nome,
                CPF = :cpf,
                Telefone = :telefone,
                Email = :email,
                Senha = :senha,
                Perfil_ID = :perfilId
                WHERE ID = :id;";

            $stmt = $this->dbh->prepare($query);

            $idAdmin = $adminDTO->getId();
            $nomeAdmin = $adminDTO->getNome();
            $cpfAdmin = $adminDTO->getCpf();
            $telefoneAdmin = $adminDTO->getTelefone();
            $emailAdmin = $adminDTO->getEmail();
            $senhaAdmin = $adminDTO->getSenha();
            $perfilIdAdmin = $adminDTO->getperfil_Id();

            $stmt->bindParam(':id', $idAdmin);
            $stmt->bindParam(':nome', $nomeAdmin);
            $stmt->bindParam(':cpf', $cpfAdmin);
            $stmt->bindParam(':telefone', $telefoneAdmin);
            $stmt->bindParam(':email', $emailAdmin);
            $stmt->bindParam(':senha', $senhaAdmin);
            $stmt->bindParam(':perfilId', $perfilIdAdmin);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Administrador por ID
    public function getById($id)
    {
        try{
            $query = "SELECT * FROM jmtg_service.usuario_sistema WHERE ID = :id;";
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

    //Excluir Administrador
    public function delete($id)
    {
        try{
            $query = "DELETE FROM jmtg_service.usuario_sistema WHERE ID = :id;";

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
    public function login($cpf, $senha)
    {
        $query = "SELECT ID, Nome, CPF, Email, perfil_id FROM jmtg_service.usuario_sistema WHERE CPF = :cpf
        AND Senha = :senha;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':CPF', $cpf);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_BOTH);
        $this->dbh = null;

        return $row;
    }
}
?>
