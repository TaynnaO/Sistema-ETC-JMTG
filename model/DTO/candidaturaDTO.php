<?php
//Transferencia de dados do formulário (view)
class CandidaturaDTO
{
    private $vaga_numero;
    private $aluno_matricula;
    private $status;

    public function setVaga_Numero($vaga_numero)
    {
        $this->vaga_numero = $vaga_numero;
    }
    public function getVaga_Numero()
    {
        return $this->vaga_numero;
    }

    public function setAluno_Matricula($aluno_matricula)
    {
        $this->aluno_matricula = $aluno_matricula;
    }
    public function getAluno_Matricula()
    {
        return $this->aluno_matricula;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
}
?>
