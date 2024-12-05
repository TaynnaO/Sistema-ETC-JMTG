<?php

// Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";

// Incluir o controlador que carrega os alunos
//require_once  "../../../control/aluno/readAlunoController.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <script src="../../../assets/js/CDNs/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/CDNs/dataTables.js"></script>
  <title>Administrar Alunos</title>
</head>
<body>
    <header></header>

    <div class="painelAdmin">
        <nav>
            <a href="#">Home</a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </nav>
    </div>
    <div class="homeAdmin">
        <main>
            <h1>Alunos</h1>
                <section class="section__btn">
                    <div class="alertaSucessoError">
                        <?php if (isset($_SESSION['msg'])): ?>
                            <div class="alerta success">
                                <?php echo htmlspecialchars($_SESSION['msg']); ?>
                            </div>
                            <?php unset($_SESSION['msg']); // Remove a mensagem da sessão ?>
                        <?php elseif (isset($_SESSION['error'])): ?>
                            <div class="alerta error">
                                <?php echo htmlspecialchars($_SESSION['error']); ?>
                            </div>
                            <?php unset($_SESSION['error']); // Remove a mensagem da sessão ?>
                        <?php endif; ?>
                    </div>
                        <a class="btnAdm" href="#" target="_blank">Imprimir</a>
                </section>
                <section>
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Cpf</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th class="gerenciarAdm">Gerenciar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($alunos) && is_array($alunos)): ?>
                            <?php foreach ($alunos as $aluno): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($aluno['Matricula']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($aluno['Nome']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($aluno['CPF']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($aluno['Email']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($aluno['Telefone']); ?>
                                </td>
                                <td class="tdOperacao">
                                        <div class="alterarExcluir">
                                            <a class="btnexcluir" href="../../../control/aluno/excluirAlunoController.php?id=<?= $aluno['Matricula']; ?>" onclick="return confirm('Deseja confirmar a operação?');">Excluir</a>
                                        </div>
                                </td>       
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        </tbody>
                        <tr>
                            <td colspan="6">Nenhum aluno encontrado.</td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </section>
        </main>
    </div>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable( {
                language: {
                    url: '../../assets/js/CDNs/dataTable-pt-BR.json',
                }
            } );
        } );
    </script>
</body>
</html>


<?php require_once __DIR__ . "/../../../layouts/footer.php"; ?>