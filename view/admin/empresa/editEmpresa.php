<?php
require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";

require_once __DIR__ . "/../../model/dao/alunoDAO.php";

# cria a variavel $id com valor igual a 1 e evita sql injecton e validar o tipo de dados. 
$matricula = filter_input(INPUT_GET, 'Matricula', FILTER_VALIDATE_INT) ?? 0;

# cria um objeto da classe UsuarioDAO e chama método para realizar ação.
$dao = new AlunoDAO();
$usuario = $dao->getById($matricula);

if (!$usuario) {
    header('location: index.php?error=Usuário não encontrado!');
    exit;
}
?>
<main>

<h1>Atualizar Aluno</h1>
    <a class="btn btn-voltar" href="index.php">Voltar</a>
    
    <form action="../../../control/Aluno/alterarAlunoController.php" method="post">
        <input type="hidden" name="matricula" value="<?= $usuario['matricula'] ?>">
        <label>Nome</label><br>
        <input type="text" name="nome" placeholder="Informe seu nome." size="80" required value="<?= htmlspecialchars($usuario['Nome']) ?>"><br>
        <label>E-mail</label><br>
        <input type="email" name="email" placeholder="Informe seu e-mail." size="80" required autofocus value="<?= htmlspecialchars($usuario['Email']) ?>"><br>
        <label>Status</label><br>
        <select name="status">
            <option value="1">ATIVO</option>
            <option value="0">INATIVO</option>
        </select><br>
        <br>
        <button class="btn" type="submit">Salvar</button>
    </form>
</main>

<?php require_once __DIR__ . "/../../../layouts/footer.php"; ?>
