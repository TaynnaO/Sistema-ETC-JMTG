<?php
require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";
?>
<main>

<h1>Cadastro de Novo Aluno</h1>
        <a class="btn btn-voltar" href="index.php">Voltar</a>

        <form action="../../control/cadastrarUsuarioController.php" method="post">
        <label>E-mail</label><br>
        <input type="text" name="matricula" placeholder="Informe a matrícula." size="80" required autofocus><br>
        <label>Nome</label><br>
        <input type="text" name="nome" placeholder="Informe o nome do aluno." size="80" required><br>
        <label>Senha</label><br>
        <input type="password" name="senha" placeholder="Informe a senha." required><br>
        <input type="hidden" name="status" value="1">
        <label>Perfil</label>
        <button class="btn" type="submit">Salvar</button>
    </form>
</main>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>