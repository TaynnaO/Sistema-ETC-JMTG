<?php
//Transferencia de dados do formulário (view)
class FormacaoDTO
{
    private $id;
    private $curso;
    private $ano_conclusao;
    private $instituicao;
    private $curriculo_codigo;
    private $grau_escolaridade_id;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
    public function getCurso()
    {
        return $this->curso;
    }

    public function setAno_Conclusao($ano_conclusao)
    {
        $this->ano_conclusao = $ano_conclusao;
    }
    public function getAno_Conclusao()
    {
        return $this->ano_conclusao;
    }

    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    public function setCurriculo_Codigo($curriculo_codigo)
    {
        $this->curriculo_codigo = $curriculo_codigo;
    }
    public function getCurriculo_Codigo()
    {
        return $this->curriculo_codigo;
    }

    public function setGrau_Escolaridade_Id($grau_escolaridade_id)
    {
        $this->grau_escolaridade_id = $grau_escolaridade_id;
    }
    public function getGrau_Escolaridade_Id()
    {
        return $this->grau_escolaridade_id;
    }
}
?>
