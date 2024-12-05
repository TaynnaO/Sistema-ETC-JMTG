<?php
session_start();
require_once __DIR__ . '../../../model/DAO/alunoDAO.php'; // Verifique o caminho correto para o DAO

// Recebe as entradas de formulário (matrícula e senha)
$matricula = filter_input(INPUT_POST, 'Matricula', FILTER_SANITIZE_NUMBER_INT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($matricula && $senha) {
    $dao = new AlunoDAO();
    $aluno = $dao->login($matricula, $senha);

    if ($aluno) {
        // Se aluno for encontrado e senha estiver correta
        $_SESSION['aluno'] = array(
            'Matricula' => $aluno['Matricula'],
            'Nome' => $aluno['Nome'],
            'Email' => $aluno['Email']
        );

        // Mensagem de sucesso na sessão
        $_SESSION['msg'] = [
            'tipo' => 'sucessoAluno',
            'mensagem' => 'Login realizado com sucesso!'
        ];

        // Redireciona para a página do dashboard do aluno
        header("Location: index.php"); // Corrija para o caminho correto
        exit;   
    } else {
        // Mensagem de erro para senha incorreta ou matrícula não encontrada
        $_SESSION['msg'] = [
            'tipo' => 'erroAluno',
            'mensagem' => 'Matrícula ou senha incorretos!'
        ];
        
        // Redireciona de volta para a página de login com erro
        header("Location: ../../view/aluno/loginAluno.php");
        exit;
    }
} else {
    // Mensagem de erro para campos obrigatórios vazios
    $_SESSION['msg'] = [
        'tipo' => 'erroAluno',
        'mensagem' => 'Por favor, preencha todos os campos!'
    ];

    // Redireciona de volta para a página de login com erro
    header("Location: ../../view/aluno/loginAluno.php");
    exit;
}
?>