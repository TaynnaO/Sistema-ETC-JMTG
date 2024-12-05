<?php
header('Content-Type: text/html; charset=utf-8;');
require_once '../../model/DTO/vagaDTO.php';
require_once '../../model/DAO/vagaDAO.php';

    # recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dados
    $matricula = strip_tags($_POST["Matricula"]);
    $nome = strip_tags($_POST["Nome"]);
    $dataNascimento = strip_tags($_POST["Data_Nascimento"]);
    $cpf = strip_tags($_POST["CPF"]);
    $email = strip_tags($_POST["Email"]);
    $endereco = strip_tags($_POST["Endereco"]);
    $cep = strip_tags($_POST["CEP"]);
    $telefone = strip_tags($_POST["Telefone"]);
    $senha = strip_tags($_POST["Senha"]);
    $foto = strip_tags($_POST["Foto"]);
    $usuarioSistemaId = strip_tags($_POST["Usuario_Sistema_ID"]);

    //echo '<prev>'; var_dump($matricula, $nome, $dataNascimento, $cpf, $email, $endereco, $cep, $telefone, $senha, $foto, $usuarioSistemaId)
    $vagaDTO = new AlunoDTO();
    $vagaDTO->setMatricula($matricula);
    $vagaDTO->setNome($nome);
    $vagaDTO->setDataNascimento($dataNascimento);
    $vagaDTO->setCpf($cpf);
    $vagaDTO->setEmail($email);
    $vagaDTO->setEndereco($endereco);
    $vagaDTO->setCep($cep);
    $vagaDTO->setTelefone($telefone);
    $vagaDTO->setSenha($senha);
    $vagaDTO->setFoto($foto);
    $vagaDTO->setUsuarioSistemaId($usuarioSistemaId);

    $vagaDAO = new VagaDAO();
    $sucesso = $vagaDAO->newInsert($vagaDTO);

    //echo '<pre>'; var_dump($vagaDTO);exit;

    if($sucesso){
        // $msg = "usuário cadastrado com sucesso!";
        header('location: ../../view/vaga/index.php?msg=Usuário cadastrado com sucesso!');
    } else {
        //$msg = "Aconteceu um problema no cadastramento<br>".$sucesso;
        header('location: ../../view/vaga/index.php?error=Aconteceu um problema no cadastramento!');
    }
    //echo "{$msg}";
?>