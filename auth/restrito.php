<?php
    $usuario = $_SESSION['usuario'] ?? null;
    if (!$usuario) {
        session_destroy();
        header("location: ../../auth/index.php?error=Usuário sem permissão!");
        exit;
    }
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "../../src/conexao.php";

$conexao = Conexao::getConexao(); // Obter a instância de conexão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    $sqlAluno = "SELECT Matricula, Nome, Email, Senha FROM aluno WHERE Matricula = :matricula";
        $stmtAluno = $conexao->prepare($sqlAluno);
        $stmtAluno->bindParam(':matricula', $matricula);
        $stmtAluno->execute();

        if ($stmtAluno->rowCount() > 0) {
            // Aluno encontrado
            $aluno = $stmtAluno->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha fornecida corresponde ao hash no banco de dados
            if (password_verify($senha, $aluno['Senha'])) {
                $_SESSION['Matricula'] = $cliente['Matricula'];
                $_SESSION['Nome'] = $cliente['Nome'];

                // Redireciona para a página do cliente
                header("Location: ../pages/home.php");
                exit;
            } else {
                echo "<div class='mensagem-erro'>Senha incorreta</div>";
            }
        } else {
            echo "<div class='mensagem-erro'>Esta matrícula não está cadastrada no sistema!</div>";
        }
}
?>