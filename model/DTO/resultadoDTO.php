<?php
//Transferencia de dados do formulário (view)
class ResultadoDTO
{
    private $id;
    private $presenca;
    private $nota;
    private $observacao;
    private $entrevista_codigo;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setPresenca($presenca)
    {
        $this->presenca = $presenca;
    }
    public function getPresenca()
    {
        return $this->presenca;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }
    public function getNota()
    {
        return $this->nota;
    }

    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }
    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setEntrevista_Codigo($entrevista_codigo)
    {
        $this->entrevista_codigo = $entrevista_codigo;
    }
    public function getEntrevista_Codigo()
    {
        return $this->entrevista_codigo;
    }
}
?>
