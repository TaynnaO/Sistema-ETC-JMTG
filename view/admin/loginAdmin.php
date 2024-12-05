<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../assets/css/styleLoginAdmin.css" />
    <title>Login do Administrador</title>
  </head>
  <body>
    <main>
        <div class="logo">
          <img src="../../assets/img/jmtgBRANCO-removebg-preview.png" alt="logo">
        </div>
        <form action="../../auth/loginAdmin.php" method="post">
          <h1>LOGIN</h1>
          <div class="textfield">
            <label for="cpf">Usuário:</label>
            <input type="text" name="cpf" placeholder="CPF" required />
            <i class="bx bxs-user"></i>
          </div>
          <div class="textfield">
            <label for="senha">Senha: </label>
            <input type="password" name="senha" placeholder="Senha" required />
            <i class="bx bxs-lock-alt"></i>
          </div>
          <div class="forgot_password">
            <label><input type="checkbox" />Lembrar</label>
          </div>
          <div class="forgot_password">
            <a href="#"> Esqueci minha senha! </a>
          </div>
          <button type="submit" class="btn-login" onclick="login()">Login</button>
          <div class="register-link">
            <p>Não tem acesso? <a href="../view/perfis/cadastroAdmin.html">Registre-se</a></p>
          </div>
          <div class="voltar">
            <p><a href="#">Voltar</a></p>
          </div>
        </form>
    </main>
  </body>
</html>

<style>
.logo{
  width: 120px;
  height: 190px;
}
</style>