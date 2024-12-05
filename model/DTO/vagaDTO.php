<?php
//Transferencia de dados do formulário (view)
class VagaDTO
{
    private $numero;
    private $funcao;
    private $quantidade_vagas;
    private $salario;
    private $beneficios;
    private $descricao_atividades;
    private $requisitos;
    private $empresa_id;
    private $usuario_sistema_id;

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getNumero()
    {
        return $this->numero;
    }

    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
    }
    public function getFuncao()
    {
        return $this->funcao;
    }

    public function setQuantidade_vagas($quantidade_vagas)
    {
        $this->quantidade_vagas = $quantidade_vagas;
    }
    public function getQuantidade_vagas()
    {
        return $this->quantidade_vagas;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }
    public function getSalario()
    {
        return $this->salario;
    }

    public function setBeneficios($beneficios)
    {
        $this->beneficios = $beneficios;
    }
    public function getBeneficios()
    {
        return $this->beneficios;
    }

    public function setDescricao_Atividades($descricao_atividades)
    {
        $this->descricao_atividades = $descricao_atividades;
    }
    public function getDescricao_Atividades()
    {
        return $this->descricao_atividades;
    }

    public function setRequisitos($requisitos)
    {
        $this->requisitos = $requisitos;
    }
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    public function setEmpresa_Id($empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }
    public function getEmpresa_Id()
    {
        return $this->empresa_id;
    }

    public function setUsuario_Sistema_Id($usuario_sistema_id)
    {
        $this->usuario_sistema_id = $usuario_sistema_id;
    }
    public function getUsuario_Sistema_Id()
    {
        return $this->usuario_sistema_id;
    }
}
?>
