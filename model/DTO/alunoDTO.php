<?php
//Transferencia de dados do formulário (view)
class AlunoDTO
{
    private $matricula;
    private $nome;
    private $dataNascimento;
    private $cpf;
    private $email;
    private $endereco;
    private $cep;
    private $telefone;
    private $senha;
    private $foto;
    private $usuarioSistemaId;

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }
    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
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

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function getFoto()
    {
        return $this->foto;
    }

    public function setUsuarioSistemaId($usuarioSistemaId)
    {
        $this->usuarioSistemaId = $usuarioSistemaId;
    }
    public function getUsuarioSistemaId()
    {
        return $this->usuarioSistemaId;
    }
}
?>
