<?php
include '../../recuperar_senha/conexao.php'; ?>


<!DOCTYPE html>
<html lang="pt-br">
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
    <div class="container"> 

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];

    // Verifica se o email existe no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuario_sistema WHERE Email = ?");
    $stmt->execute([$email]);
    $usuarios = $stmt->fetch();

    if ($usuarios) {
        // Gera um código de recuperação de 6 dígitos
        $codigo = rand(100000, 999999);
        $stmt = $pdo->prepare("UPDATE usuario_sistema SET reset_token = ? WHERE Email = ?");
        $stmt->execute([$codigo, $email]);

        // Exibe o código na tela para fins de teste
        echo "Código de recuperação: $codigo";
        echo "<br><a href='redefinirSenhaAdmin.php'>Redefinir senha</a>";
    } else {
        echo "Email não encontrado.";
    }

}
?>
</div>
</html>