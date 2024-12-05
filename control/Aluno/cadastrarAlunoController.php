<?php
header('Content-Type: text/html; charset=utf-8;');

//Habilitar exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Incluir arquios necessários "DAO e DTO"
require_once __DIR__ . '../../../model/DTO/alunoDTO.php';
require_once __DIR__ . '../../../model/DAO/alunoDAO.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarCpf.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarEmail.php';
require_once __DIR__ . '../../../model/DTO/validacoes/validarSenha.php';

//Função para coletar e sanitizar dados de entrada com strip_tags
function getPostData($key) {
    return isset($_POST[$key]) ? strip_tags($_POST[$key]) : null;
}
    
    # recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dados
    $matricula = strip_tags($_POST["Matricula"]);
    $nome = strip_tags($_POST["Nome"]);
    $dataNascimento = strip_tags($_POST["Data_Nascimento"]);
    $cpf = strip_tags($_POST["CPF"]);
    $email = strip_tags($_POST["Email"]);
    $endereco = strip_tags($_POST["Endereco"]);
    $cep = strip_tags($_POST["CEP"]);
    $telefone = strip_tags($_POST["Telefone"]);
    $senha = isset($_POST["Senha"]) ? $_POST["Senha"] : null; //A senha só vai ser criptografada após a verificação.
    
    //Salvar Foto
    $diretorioFotos = "../../view/aluno/fotos/";
    $diretorioENomeFoto = $diretorioFotos . htmlspecialchars( basename($_FILES["Foto"]["name"]) );
    $tipoArquivoSelecionado = getimagesize($_FILES["Foto"]["tmp_name"]);
    if ($_FILES["Foto"]["size"] > 500000) {
        $_SESSION['erro_alert'] = "Arquivo da foto muito grande, selecione um arquivo menor do que 500KB.";
        header("Location: ../../view/aluno/cadastroAluno.php");
        exit();
    }
    if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $diretorioENomeFoto)) {
        $nomeFoto = htmlspecialchars( basename( $_FILES["Foto"]["name"]));
    } else {
        $_SESSION['erro_alert'] = "Erro ao realizar o upload da foto no diretório de fotos.";
        header("Location: ../../view/aluno/cadastroAluno.php");
        exit();
    }
    //Normaliza o CPF removendo pontos e traços
    $cpf = str_replace(['.','-'], '', $cpf);
    $telefone = str_replace(['(',')','','-'], '', $telefone);
    
    // Validação do CPF
    if (!ValidadorCPF::validar($cpf)) {
        $_SESSION['erro_alert'] = "CPF inválido.";
        $_SESSION['cpf_error'] = "CPF inválido.";
        header("Location: ../../view/aluno/cadastroAluno.php");
        exit();
    }

    //verifica se o CPF já está cadastrado
    $alunoDAO = new AlunoDAO();
    if (ValidadorCPF::cpfJaCadastradoAluno($cpf, $alunoDAO->dbh)) {
        $_SESSION['erro_alert'] = "o CPF já está cadastrado!";
        $_SESSION['cpf_error'] = "o CPF já está cadastrado!";
        header("Location: ../../view/aluno/cadastroAluno.php");
        exit();
    }

    //verifica se o e-mail já está cadastrado
    if (ValidadorEmail::emailJaCadastradoAluno($cpf,$alunoDAO->dbh)) {
        $_SESSION['erro_alert'] = "o e-mail já está cadastrado!";
        $_SESSION['cpf_error'] = "o e-mail já está cadastrado!";
        header("Location: ../../view/aluno/cadastroAluno.php");
        exit();
    }

     // Validação da senha
     $senhaValidacao = validarSenha($senha);
     if ($senhaValidacao !== true) {
         $_SESSION['senha_error'] = $senhaValidacao;
         header("Location: ../../view/aluno/cadastroAluno.php");
         exit();
     }
 
     // Criptografa a senha após validação
     $senha = password_hash($senha, PASSWORD_DEFAULT);

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
    $alunoDTO->setSenha(MD5($senha));
    $alunoDTO->setFoto($nomeFoto);
    //$alunoDTO->setUsuarioSistemaId($usuarioSistemaId);

    $alunoDAO = new AlunoDAO();
    $sucesso = $alunoDAO->newInsert($alunoDTO);

    if($sucesso){
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso. <br> Seja bem-vindo ao JMTG Service. <br> Encontre aqui o emprego ideal para você!";
        header('location: ../../view/aluno/loginAluno.php?msg=Usuário cadastrado com sucesso!');
    } else {
        $_SESSION['erro'] = "Aconteceu um problema no cadastramento. <br> Por favor, tente novamente.";
        header('location: ../../view/aluno/loginAluno.php?error=Aconteceu um problema no cadastramento!');
    }
    //echo "{$msg}";
    exit();
?>