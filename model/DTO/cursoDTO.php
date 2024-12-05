<?php
//Transferencia de dados do formulário (view)
class CursoDTO
{
    private $id;
    private $nome;
    private $instituicao;
    private $conclusao;
    private $curriculo_codigo;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    public function setConclusao($conclusao)
    {
        $this->conclusao = $conclusao;
    }
    public function getConclusao()
    {
        return $this->conclusao;
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