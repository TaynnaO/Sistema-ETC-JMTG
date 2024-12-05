<?php
header('Content-Type: text/html; charset=utf-8;');

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../model/DTO/empresaDTO.php';
require_once __DIR__ . '../../model/DAO/empresaDAO.php';
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
    $cnpj = strip_tags($_POST["CNPJ"]);
    $endereco = strip_tags($_POST["Endereco"]);
    $cep = strip_tags($_POST["CEP"]);
    $email = strip_tags($_POST["Email"]);
    $telefone = strip_tags($_POST["Telefone"]);
    $senha = strip_tags($_POST["Senha"]);
    $entrevista_codigo = strip_tags($_POST["Entrevista_Codigo"]);

    //echo '<pre>'; var_dump($nome, $cnpj, $endereco, $cep, $email, $telefone, $senha, $entrevista_codigo); exit;
    $empresaDTO = new EmpresaDTO();
    $empresaDTO->setNome($nome);
    $empresaDTO->setCnpj($cnpj);
    $empresaDTO->setEndereco($endereco);
    $empresaDTO->setCep($cep);
    $empresaDTO->setEmail($email);
    $empresaDTO->setTelefone($telefone);
    $empresaDTO->setSenha($senha);
    $empresaDTO->setEntrevista_Codigo($entrevista_codigo);

    $empresaDAO = new EmpresaDAO();
    $sucesso = $empresaDAO->update($empresaDTO);
    //var_dump($empresaDTO);

    // Validação de e-mail
    if ($empresaDAO->verificarEmailExistente($email, $id)) {
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
        $empresaDTO->setSenha(password_hash($novaSenha, PASSWORD_DEFAULT));
    }


    if ($sucesso) {
        //$msg = "Usuário alterado com sucesso!";
        header('location: ../../view/empresa/index.php?msg=Usuário alterado com sucesso!'); 
    } else {
        //$msg = "Aconteceu um problema na alteração de dados." . $sucesso;
        header('location: ../../view/empresa/index.php?msg=Aconteceu um problema na alteração de dados!');
    }
    //echo "{$msg}";
    try {
        // Atualiza o funcionário no banco de dados
        $empresaDAO->atualizarEmpresa($empresaDTO);
        $_SESSION['successeditFun'] = "Empresa atualizada com sucesso!";
        header("Location: ../../view/admin/listaFuncionarios.php");
        exit();
    } catch (Exception $e) {
        redirecionarComErro('email_error', $e->getMessage(), $id);
    }
}
// Redireciona para a página de edição
require_once '../../view/admin/editarFuncionario.php';

?>