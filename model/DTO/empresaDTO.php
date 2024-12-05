<?php
//Transferencia de dados do formulário (view)
class EmpresaDTO
{
    private $id;
    private $nome;
    private $cnpj;
    private $endereco;
    private $cep;
    private $email;
    private $telefone;
    private $senha;
    private $entrevista_codigo;

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

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }
    public function getCep()
    {
        return $this->cep;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
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
