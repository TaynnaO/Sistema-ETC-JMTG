<?php
header('Content-Type: text/html; charset=utf-8;');

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../model/DTO/adminDTO.php';
require_once __DIR__ . '../../model/DAO/adminDAO.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarCpf.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarEmail.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarSenha.php';

    // Função auxiliar para redirecionamento com mensagem de erro
    function redirecionarComErro($sessaoErro, $mensagemErro, $id) {
        $_SESSION[$sessaoErro] = $mensagemErro;
        header("Location: ../../view/admin/editarFuncionario.php?token=" . urlencode(base64_encode($id)));
        exit();
    }

    // Verificar se o ID foi passado (no GET) para carregar dados do funcionário
    $token = $_GET['token'] ?? null;
    $id = $token ? base64_decode($token) : null; // Decodifica o token

//Se for uma requisição POST, processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    #recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dado.
    $nome = strip_tags($_POST["Nome"]);
    $cpf = strip_tags($_POST["CPF"]);
    $telefone = strip_tags($_POST["Telefone"]);
    $email = strip_tags($_POST["Email"]);
    $senha = strip_tags($_POST["Senha"]);
    $perfil_Id = strip_tags($_POST["Perfil_ID"]);

    //echo '<pre>'; var_dump($nome, $cpf, $telefone, $email, $senha, $perfil_Id); exit;
    $adminDTO = new AdminDTO();
    $adminDTO->setNome($nome);
    $adminDTO->setCpf($cpf);
    $adminDTO->setTelefone($telefone);
    $adminDTO->setEmail($email);
    $adminDTO->setSenha($senha);
    $adminDTO->setperfil_Id($perfil_Id);

    $adminDAO = new AdminDAO();
    $sucesso = $adminDAO->update($adminDTO);
    //var_dump($adminDTO);

    // Validação de CPF
    if (!ValidadorCPF::validar($cpf)) {
        redirecionarComErro('cpf_error', "CPF inválido.", $id);
    }

    // Verifica se o CPF já está cadastrado
    if ($adminDAO->cpfJaCadastradoAdmin($cpf, $id)) {
        redirecionarComErro('cpf_error', "O CPF já está cadastrado.", $id);
    }

    // Validação de e-mail
    if ($adminDAO->verificarEmailExistente($email, $id)) {
        redirecionarComErro('email_error', "O e-mail já está cadastrado.", $id);
    }

    // Validação de senha
    if (!empty($novaSenha)) {
        if ($novaSenha !== $confirmarSenha) {
            redirecionarComErro('senha_error', "As senhas não coincidem.", $id);
        }

        $senhaValidacao = validarSenha($novaSenha);
        if ($senhaValidacao !== true) {
            redirecionarComErro('senha_error', $senhaValidacao, $id);
        }
    }

    // Atualiza a senha apenas se uma nova senha for fornecida
    if (!empty($novaSenha)) {
        $adminDTO->setSenha(password_hash($novaSenha, PASSWORD_DEFAULT));
    }

    if ($sucesso) {
        //$msg = "Usuário alterado com sucesso!";
        header('location: ../../view/admin/index.php?msg=Usuário alterado com sucesso!'); 
    } else {
        //$msg = "Aconteceu um problema na alteração de dados." . $sucesso;
        header('location: ../../view/admin/index.php?msg=Aconteceu um problema na alteração de dados!');
    }
    //echo "{$msg}";
    try {
        // Atualiza o funcionário no banco de dados
        $adminDAO->atualizarAdmin($adminDTO);
        $_SESSION['successeditFun'] = "Administrador atualizado com sucesso!";
        header("Location: ../../view/admin/listaFuncionarios.php");
        exit();
    } catch (Exception $e) {
        redirecionarComErro('email_error', $e->getMessage(), $id);
    }
}
?>