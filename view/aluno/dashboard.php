<?php
session_start();
if (array_key_exists('usuario', $_SESSION) && !isset($_SESSION['usuario']) && !isset($_SESSION['aluno']) ) {
    header('Location: login.php?error=UsuarioNaoAutenticado');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Aluno</title>
</head>
<body>
    <h1>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['aluno']['Nome']); ?></h1>
    <p><a href="aluno_list.php">Gerenciar Alunos</a></p>
    <p><a href="../../auth/logoutAluno.php">Sair</a></p>
</body>
</html>
