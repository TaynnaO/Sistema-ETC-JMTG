<?php
//Transferencia de dados do formulário (view)
class PerfilDTO
{
    private $id;
    private $funcao;
    private $descricao;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
    }
    public function getFuncao()
    {
        return $this->funcao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
}
?>
