<?php
session_start();
require_once __DIR__ . '../../model/DAO/adminDAO.php';
//include 'conexao.php';

$admin = filter_input(INPUT_POST, 'CPF', FILTER_SANITIZE_NUMBER_INT);
$senha = filter_input(INPUT_POST, 'Senha', FILTER_SANITIZE_SPECIAL_CHARS);

$passwordCrypto = md5($senha);

$dao = new AdminDAO();
$admin = $dao->login($cpf, $passwordCrypto);

if (!$admin) {
    header("location: ../../view/admin/loginAdmin.php?error=CPF ou senha inválidos!");
    exit;
}
//echo "Usuário logado: ", $_SESSION["usuario"];
//echo "<br>";
//echo "Perfil: ", $_SESSION["perfil"];
$_SESSION['admin'] = array(
    'ID' => $admin['ID'],
    'Nome' => $admin['Nome'],
    'CPF' => $admin['CPF'],
    'Email' => $admin['Email']
);

header("location: ../index.php");

?>