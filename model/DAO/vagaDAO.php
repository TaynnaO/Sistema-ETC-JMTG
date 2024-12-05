<?php
require_once __DIR__ . '/../../src/conexao.php';
require_once __DIR__ . '/../DTO/vagaDTO.php';

class VagaDAO
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    //Inserir Vaga
    public function newInsert(VagaDTO $vagaDTO)
    {
        try{
            $query = "INSERT INTO jmtg_service.vaga (Numero, Funcao, Quantidade_Vagas, Salario, Beneficios, Descricao_Atividades, Requisitos, Empresa_ID, usuario_sistema_Id)
               VALUES (:numero, :funcao, :quantidade_vagas, :salario, :beneficios, :descricao_atividades, :requisitos, :empresa_id, :usuario_sistema_id);";
            
            $stmt = $this->dbh->prepare($query);

            $numeroVaga = $vagaDTO->getNumero();
            $funcaoVaga = $vagaDTO->getFuncao();
            $quantidade_vagas = $vagaDTO->getQuantidade_Vagas();
            $salarioVaga = $vagaDTO->getSalario();
            $beneficiosVaga = $vagaDTO->getBeneficios();
            $descricao_atividadesVaga = $vagaDTO->getDescricao_Atividades();
            $requisitosVaga = $vagaDTO->getRequisitos();
            $empresa_idVaga = $vagaDTO->getEmpresa_Id();
            $usuario_sistema_idVaga = $vagaDTO->getUsuario_Sistema_Id();

            $stmt->bindParam(':numero', $numeroVaga);
            $stmt->bindParam(':funcao', $funcaoVaga);
            $stmt->bindParam(':quantidade_vagas', $quantidade_vagas);
            $stmt->bindParam(':salario', $salarioVaga);
            $stmt->bindParam(':beneficios', $beneficiosVaga);
            $stmt->bindParam(':descricao_atividades', $descricao_atividadesVaga);
            $stmt->bindParam(':requisitos', $requisitosVaga);
            $stmt->bindParam(':empresa_id', $empresa_idVaga);
            $stmt->bindParam(':usuario_sistema_id', $usuario_sistema_idVaga);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Listar Vagas
    public function getAll()
    {
        try {
            $query = "SELECT * FROM jmtg_service.vaga;";

            $stmt = $this->dbh->prepare($query);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Alterar Vaga
    public function update(VagaDTO $vagaDTO)
    {
        try{
            $query = "UPDATE jmtg_service.vaga SET
                Funcao = :funcao,
                Quantidade_Vagas = :quantidade_vagas,
                Salario = :salario,
                Beneficios = :beneficios,
                Descricao_Atividades = :descricao_atividades,
                Requisitos = :requisitos,
                Empresa_ID = :empresa_id,
                usuario_sistema_ID = :usuario_sistema_id,
                WHERE Numero = :numero;";

            $stmt = $this->dbh->prepare($query);

            $numeroVaga = $vagaDTO->getNumero();
            $funcaoVaga = $vagaDTO->getFuncao();
            $quantidade_vagas = $vagaDTO->getQuantidade_Vagas();
            $salarioVaga = $vagaDTO->getSalario();
            $beneficiosVaga = $vagaDTO->getBeneficios();
            $descricao_atividadesVaga = $vagaDTO->getDescricao_Atividades();
            $requisitosVaga = $vagaDTO->getRequisitos();
            $empresa_idVaga = $vagaDTO->getEmpresa_Id();
            $usuario_sistema_idVaga = $vagaDTO->getUsuario_Sistema_Id();

            $stmt->bindParam(':numero', $numeroVaga);
            $stmt->bindParam(':funcao', $funcaoVaga);
            $stmt->bindParam(':quantidade_vagas', $quantidade_vagas);
            $stmt->bindParam(':salario', $salarioVaga);
            $stmt->bindParam(':beneficios', $beneficiosVaga);
            $stmt->bindParam(':descricao_atividades', $descricao_atividadesVaga);
            $stmt->bindParam(':requisitos', $requisitosVaga);
            $stmt->bindParam(':empresa_id', $empresa_idVaga);
            $stmt->bindParam(':usuario_sistema_id', $usuario_sistema_idVaga);

            $result = $stmt->execute();
            return $result;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Pesquisar Vaga por Numero
    public function getById($numero)
    {
        try{
            $query = "SELECT * FROM jmtg_service.vaga WHERE Numero = :numero;";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':numero', $numero);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_BOTH);
            return $row;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $this->dbh = null;
    }

    //Excluir Vaga
    public function delete($numero)
    {
        try{
            $query = "DELETE FROM jmtg_service.vaga WHERE Numero = :numero;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':numero', $numero);
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
