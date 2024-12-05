<?php
header('Content-Type: text/html; charset=utf-8;');

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../model/DTO/alunoDTO.php';
require_once __DIR__ . '../../model/DAO/alunoDAO.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarCpf.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarEmail.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarSenha.php';

    // Função auxiliar para redirecionamento com mensagem de erro
    function redirecionarComErro($sessaoErro, $mensagemErro, $matricula) {
        $_SESSION[$sessaoErro] = $mensagemErro;
        header("Location: ../../view/admin/editarFuncionario.php?token=" . urlencode(base64_encode($matricula)));
        exit();
    }

    // Verificar se o ID foi passado (no GET) para carregar dados do funcionário
    $token = $_GET['token'] ?? null;
    $matricula = $token ? base64_decode($token) : null; // Decodifica o token

//Se for uma requisição POST, processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $sucesso = $alunoDAO->update($alunoDTO);
    //var_dump($usuarioDTO);

    // Validação de CPF
    if (!ValidadorCPF::validar($cpf)) {
        redirecionarComErro('cpf_error', "CPF inválido.", $matricula);
    }

    // Verifica se o CPF já está cadastrado
    if ($alunoDAO->cpfJaCadastrado($cpf, $matricula)) {
        redirecionarComErro('cpf_error', "O CPF já está cadastrado.", $matricula);
    }

    // Validação de e-mail
    if ($alunoDAO->verificarEmailExistente($email, $matricula)) {
        redirecionarComErro('email_error', "O e-mail já está cadastrado.", $matricula);
    }

    // Validação de senha
    if (!empty($novaSenha)) {
        if ($novaSenha !== $confirmarSenha) {
            redirecionarComErro('senha_error', "As senhas não coincidem.", $matricula);
        }

        $senhaValidacao = validarSenha($novaSenha);
        if ($senhaValidacao !== true) {
            redirecionarComErro('senha_error', $senhaValidacao, $matricula);
        }
    }

    // Atualiza a senha apenas se uma nova senha for fornecida
    if (!empty($novaSenha)) {
        $alunoDTO->setSenha(password_hash($novaSenha, PASSWORD_DEFAULT));
    }

    if ($sucesso) {
        //$msg = "Usuário alterado com sucesso!";
        header('location: ../../view/aluno/index.php?msg=Usuário alterado com sucesso!'); 
    } else {
        //$msg = "Aconteceu um problema na alteração de dados." . $sucesso;
        header('location: ../../view/aluno/index.php?msg=Aconteceu um problema na alteração de dados!');
    }
    //echo "{$msg}";
    try {
        // Atualiza o funcionário no banco de dados
        $alunoDAO->update($alunoDTO);
        $_SESSION['successeditFun'] = "Aluno atualizado com sucesso!";
        header("Location: ../../view/admin/listaFuncionarios.php");
        exit();
    } catch (Exception $e) {
        redirecionarComErro('email_error', $e->getMessage(), $matricula);
    }
}
// Redireciona para a página de edição
require_once '../../view/admin/editarFuncionario.php';
?>