<?php
session_start();
require_once __DIR__ . '../../model/DAO/alunoDAO.php';
//include 'conexao.php';

$matricula = filter_input(INPUT_POST, 'Matricula', FILTER_SANITIZE_NUMBER_INT);
$senha = filter_input(INPUT_POST, 'Senha', FILTER_SANITIZE_SPECIAL_CHARS);

$passwordCrypto = md5($senha);
$dao = new AlunoDAO();
$aluno = $dao->login($matricula, $passwordCrypto);

if (!$aluno) {
    header("location: ../view/aluno/loginAluno.php?error=Matrícula ou senha inválidos!");
    exit;
}
//echo "Usuário logado: ", $_SESSION["usuario"];
//echo "<br>";
//echo "Perfil: ", $_SESSION["perfil"];
$_SESSION['aluno'] = array(
    'Matricula' => $aluno['Matricula'],
    'Nome' => $aluno['Nome'],
    'CPF' => $aluno['CPF'],
    'Email' => $aluno['Email'],
);

header("location: ../view/aluno/dashboard.php");

?>