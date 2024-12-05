<?php
//Transferencia de dados do formulário (view)
class EntrevistaDTO
{
    private $codigo;
    private $data;
    private $hora;
    private $endereco;
    private $link;
    private $candidatura_vaga_numero;
    private $candidatura_aluno_matricula;

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }
    public function getHora()
    {
        return $this->hora;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
    public function getLink()
    {
        return $this->link;
    }

    public function setCandidatura_Vaga_Numero($candidatura_vaga_numero)
    {
        $this->candidatura_vaga_numero = $candidatura_vaga_numero;
    }
    public function getCandidatura_Vaga_Numero()
    {
        return $this->candidatura_vaga_numero;
    }

    public function setCandidatura_Aluno_Matricula($candidatura_aluno_matricula)
    {
        $this->candidatura_aluno_matricula = $candidatura_aluno_matricula;
    }
    public function getCandidatura_Aluno_Matricula()
    {
        return $this->candidatura_aluno_matricula;
    }
}
?>
