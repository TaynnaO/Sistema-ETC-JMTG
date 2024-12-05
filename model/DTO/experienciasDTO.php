<?php
//Transferencia de dados do formulário (view)
class ExperienciasDTO
{
    private $id;
    private $empresa;
    private $funcao;
    private $periodo;
    private $atividade;
    private $curriculo_codigo;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
    }
    public function getFuncao()
    {
        return $this->funcao;
    }

    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }
    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;
    }
    public function getAtividade()
    {
        return $this->atividade;
    }

    public function setCurriculo_Codigo($curriculo_codigo)
    {
        $this->curriculo_codigo = $curriculo_codigo;
    }
    public function getCurriculo_Codigo()
    {
        return $this->curriculo_codigo;
    }
}
?>
