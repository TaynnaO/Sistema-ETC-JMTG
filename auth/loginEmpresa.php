<?php
session_start();
require_once __DIR__ . '../../model/DAO/empresaDAO.php';
require_once __DIR__ . '';
//include 'conexao.php';

$matricula = filter_input(INPUT_POST, 'CNPJ', FILTER_SANITIZE_NUMBER_INT);

$passwordCrypto = md5($senha);

$dao = new EmpresaDAO();
$empresa = $dao->login($cnpj, $passwordCrypto);

if (!$empresa) {
    header("location: ../../view/empresa/loginEmpresa.php?error=Matrícula ou senha inválidos!");
    exit;
}
//echo "Usuário logado: ", $_SESSION["usuario"];
//echo "<br>";
//echo "Perfil: ", $_SESSION["perfil"];
$_SESSION['empresa'] = array(
    'ID' => $empresa['ID'],
    'Nome' => $empresa['Nome'],
    'CNPJ' => $empresa['CNPJ'],
    'Email' => $empresa['Email'],
);

header("location: ../index.php");

?>
