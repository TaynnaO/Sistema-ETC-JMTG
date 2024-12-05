<?php
// Iniciar a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../assets/css/styleLoginAluno.css" />
    <title>Login do Aluno</title>
  </head>
  <body>
    <div class="main-login">
      <div class="logo-texto">
          <div class="logo">
            <img src="../../assets/img/jmtgBRANCO-removebg-preview.png" alt="logo">
          </div>
          <div class="left-login">
            <h1>Faça login<br>E descubra um<br>Mundo de Possibilidades</h1>
          </div> 
      </div>
      <div class="right-login">
        <div class="form">
        <form class="card-login" action="../../auth/loginAluno.php" method="post">
          <h1>LOGIN</h1>
          
          <!-- Exibição das mensagens de erro ou sucesso -->
          <?php
              if (isset($_SESSION['msg'])) {
                  echo "<div class='msg " . $_SESSION['msg']['tipo'] . "' id='#'>" . $_SESSION['msg']['mensagem'] . "</div>";
                  unset($_SESSION['msg']);
              }
          ?> 
          <div class="textfield">
            <label for="Matricula">Matrícula:</label>
            <input type="text" name="Matricula" id="Matricula" placeholder="Matrícula" required autocomplete="off" />
            <i class="bx bxs-user"></i>
          </div>
          <div class="textfield">
            <label for="Senha">Senha:</label>
            <input type="password" name="Senha" id="Senha" placeholder="Senha" required autocomplete="off" />
            <i class="bx bxs-lock-alt"></i>
          </div>
          <div class="forgot_password">
            <label><input type="checkbox" />Lembrar</label>
          </div>
          <div class="forgot_password">
            <a href="../../recuperar_senha/aluno/recover.html">Esqueci minha senha!</a>
          </div>
          <button type="submit" class="btn-login">Login</button>
          <div class="register-link">
            <p>Não tem acesso? <a href="../aluno/cadastroAluno.php">Registre-se</a></p>
          </div>
          <div class="admin-login">
            <a href="../admin/loginAdmin.php">Entrar como Administrador</a>
          </div>
          <div class="voltar">
            <p><a href="../../index.html">Voltar</a></p>
          </div>
        </form>

        </div>
      </div>
    </div>
  </body>
</html>
