<?php
header('Content-Type: text/html; charset=utf-8;');

//Habilitar exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../../model/DTO/adminDTO.php';
require_once __DIR__ . '../../../model/DAO/adminDAO.php';
require_once __DIR__ . '../../../model/DTO/perfilDTO.php';
require_once __DIR__ . '../../../model/DAO/perfilDAO.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarCpf.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarEmail.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarSenha.php';

//Função para coletar e sanitizar dados de entrada com strip_tags
function getPostData($key) {
    return isset($_POST[$key]) ? strip_tags($_POST[$key]) : null;
}

    # recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dados
    $nome = strip_tags($_POST["Nome"]);
    $cpf = strip_tags($_POST["CPF"]);
    $telefone = strip_tags($_POST["Telefone"]);
    $email = strip_tags($_POST["Email"]);
    $senha = strip_tags($_POST["Senha"]);
    $funcao = strip_tags($_POST["Funcao"]);

    //Normaliza o CPF removendo pontos e traços
    $cpf = str_replace(['.','-'], '', $cpf);
    $telefone = str_replace(['(',')','','-'], '', $telefone);

    // Validação do CPF
    if (!ValidadorCPF::validar($cpf)) {
        $_SESSION['erro_alert'] = "CPF inválido.";
        $_SESSION['cpf_error'] = "CPF inválido.";
        header("Location: ../../view/dmin/cadastroAdmin.php");
        exit();
    }

    //verifica se o CPF já está cadastrado
    $adminDAO = new AdminDAO();
    if (ValidadorCPF::cpfJaCadastradoAdmin($cpf,$adminDAO->dbh)) {
        $_SESSION['erro_alert'] = "o CPF já está cadastrado!";
        $_SESSION['cpf_error'] = "o e-mail já está cadastrado!";
        header("Location: ../../view/admin/cadastroAdmin.php");
        exit();
    }

    //verifica se o e-mail já está cadastrado
    if (ValidadorEmail::emailJaCadastradoAdmin($cpf,$adminDAO->dbh)) {
        $_SESSION['erro_alert'] = "o e-mail já está cadastrado!";
        $_SESSION['cpf_error'] = "o e-mail já está cadastrado!";
        header("Location: ../../view/admin/cadastroAdmin.php");
        exit();
    }

     // Validação da senha
     $senhaValidacao = validarSenha($senha);
     if ($senhaValidacao !== true) {
         $_SESSION['senha_error'] = $senhaValidacao;
         header("Location: ../../view/admin/cadastroAdmin.php");
         exit();
     }
 
     // Criptografa a senha após validação
     $senha = password_hash($senha, PASSWORD_DEFAULT);

    //echo '<prev>'; var_dump($id, $nome, $cpf, $telefone, $email, $senha, $perfil_Id)
    $adminDTO = new AdminDTO();
    $adminDTO->setNome($nome);
    $adminDTO->setCpf($cpf);
    $adminDTO->setTelefone($telefone);
    $adminDTO->setEmail($email);
    $adminDTO->setSenha($senha);

    $adminDAO = new AdminDAO();
    
    $sucesso = $adminDAO->newInsert($adminDTO);

    var_dump($adminDTO);exit;

    if($sucesso){
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso. <br> Seja bem-vindo à família JMTG Service.";
        header('location: ../../view/admin/loginAdmin.php?msg=Usuário cadastrado com sucesso!');
    } else {
        $_SESSION['erro'] = "Aconteceu um problema no cadastramento. <br> Por favor, tente novamente.";
        header('location: ../../view/admin/loginAdmin.php?error=Aconteceu um problema no cadastramento!');
    }
    //echo "{$msg}";
    exit();
?>