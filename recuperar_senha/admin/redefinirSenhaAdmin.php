<?php
include '../../recuperar_senha/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $newPassword = $_POST['new_password'];

    // Verifica se o código é válido
    $stmt = $pdo->prepare("SELECT * FROM usuario_sistema WHERE reset_token = ?");
    $stmt->execute([$codigo]);
    $usuarios = $stmt->fetch();

    if ($usuarios) {
        // Atualiza a senha usando md5
        $hashedPassword = md5($newPassword); // Aqui usamos md5 para hash da nova senha
        $stmt = $pdo->prepare("UPDATE usuario_sistema SET senha = ?, reset_token = NULL WHERE reset_token = ?");
        if ($stmt->execute([$hashedPassword, $codigo])) {
            echo "Senha redefinida com sucesso!";
        } else {
            echo "Erro ao atualizar a senha.";
        }
    } else {
        echo "Código de recuperação inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login</title>
    <link rel="stylesheet" href="../css/styles_login.css" />
</head>
<header class="header">
    <a href="../../index.html" class="logo"><span>JMTG</span>Service</a>

    <div id="menu-btn" class="fas fa-bars"></div>
        </header>


    <title>Redefinir Senha</title>
</head>
<body>
    <div>
    <h2>Redefinir Senha</h2>
    <form action="" method="POST">
        <label for="codigo">Código de Recuperação:</label>
        <input type="text" id="codigo" name="codigo" required>
        
        <label for="new_password">Nova Senha:</label>
        <input type="password" id="new_password" name="new_password" required>
        
        <button type="submit">Redefinir Senha</button>
    </form>
    <p><a href="../../view/admin/loginAdmin.php">Voltar à página de login</a></p>
    </div>
</body>
</html>
