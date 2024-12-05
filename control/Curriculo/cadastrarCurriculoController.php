<?php
header('Content-Type: text/html; charset=utf-8;');
require_once '../../model/DTO/alunoDTO.php';
require_once '../../model/DAO/alunoDAO.php';

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
    $alunoDTO = new AlunoDTO();
    $alunoDTO->setMatricula($matricula);
    $alunoDTO->setNome($nome);
    $alunoDTO->setDataNascimento($dataNascimento);
    $alunoDTO->setCpf($cpf);
    $alunoDTO->setEmail($email);
    $alunoDTO->setEndereco($endereco);
    $alunoDTO->setCep($cep);
    $alunoDTO->setTelefone($telefone);
    $alunoDTO->setSenha($senha);
    $alunoDTO->setFoto($foto);
    $alunoDTO->setUsuarioSistemaId($usuarioSistemaId);

    $alunoDAO = new AlunoDAO();
    $sucesso = $alunoDAO->newInsert($usuarioDTO);

    //echo '<pre>'; var_dump($usuarioDTO);exit;

    if($sucesso){
        // $msg = "usuário cadastrado com sucesso!";
        header('location: ../../view/aluno/loginAluno.php?msg=Usuário cadastrado com sucesso!');
    } else {
        //$msg = "Aconteceu um problema no cadastramento<br>".$sucesso;
        header('location: ../../view/aluno/loginAluno.php?error=Aconteceu um problema no cadastramento!');
    }
    //echo "{$msg}";
?>