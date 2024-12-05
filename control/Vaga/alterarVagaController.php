<?php
header('Content-Type: text/html; charset=utf-8;');
require_once '../../model/DTO/alunoDTO.php';
require_once '../../model/DAO/alunoDAO.php';

    #recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dado.
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

    //echo '<pre>'; var_dump($nome, $dataNascimento, $cpf, $email, $endereco, $cep, $telefone, $senha, $foto, $usuarioSistemaId); exit;
    $alunoDTO = new AlunoDTO();
    $alunoDTO->setNome($nome);
    $alunoDTO->setNome($dataNascimento);
    $alunoDTO->setNome($cpf);
    $alunoDTO->setNome($email);
    $alunoDTO->setNome($endereco);
    $alunoDTO->setNome($cep);
    $alunoDTO->setNome($telefone);
    $alunoDTO->setNome($senha);
    $alunoDTO->setNome($foto);
    $alunoDTO->setNome($usuarioSistemaId);

    $alunoDAO = new AlunoDAO();
    $sucesso = $alunoDAO->update($alunoDTO);
    //var_dump($usuarioDTO);

    if ($sucesso) {
        //$msg = "Usuário alterado com sucesso!";
        header('location: ../../view/aluno/index.php?msg=Usuário alterado com sucesso!'); 
    } else {
        //$msg = "Aconteceu um problema na alteração de dados." . $sucesso;
        header('location: ../../view/aluno/index.php?msg=Aconteceu um problema na alteração de dados!');
    }
    //echo "{$msg}";
?>