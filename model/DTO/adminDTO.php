<?php
//Transferencia de dados do formulário (view)
class AdminDTO
{
    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $senha;
    private $perfil_id;

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

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setPerfil_Id($perfil_id)
    {
        $this->perfil_id = $perfil_id;
    }
    public function getPerfil_Id()
    {
        return $this->perfil_id;
    }
}
?>
