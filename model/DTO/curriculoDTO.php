<?php
//Transferencia de dados do formulário (view)
class CurriculoDTO
{
    private $codigo;
    private $sobre_mim;
    private $atividades_extracurriculares;
    private $interesses_profissionais;
    private $aluno_matricula;

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setSobre_Mim($sobre_mim)
    {
        $this->sobre_mim = $sobre_mim;
    }
    public function getSobre_Mim()
    {
        return $this->sobre_mim;
    }

    public function setAtividades_Extracurriculares($atividades_extracurriculares)
    {
        $this->atividades_extracurriculares = $atividades_extracurriculares;
    }
    public function getAtividades_Extracurriculares()
    {
        return $this->atividades_extracurriculares;
    }

    public function setInteresses_Profissionais($interesses_profissionais)
    {
        $this->interesses_profissionais = $interesses_profissionais;
    }
    public function getInteresses_Profissionais()
    {
        return $this->interesses_profissionais;
    }

    public function setAluno_Matricula($aluno_matricula)
    {
        $this->aluno_matricula = $aluno_matricula;
    }
    public function getAluno_Matricula()
    {
        return $this->aluno_matricula;
    }
}
?>
