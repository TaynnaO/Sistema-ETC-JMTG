<!-- views/aluno_list.php -->
<?php
require_once '../controller/AlunoController.php';

$alunoController = new AlunoController();
$alunos = $alunoController->listarAlunos();
?>
<h1>Lista de Alunos</h1>
<table>
    <tr>
        <th>Matrícula</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($alunos as $aluno): ?>
    <tr>
        <td><?php echo htmlspecialchars($aluno->getMatricula()); ?></td>
        <td><?php echo htmlspecialchars($aluno->getNome()); ?></td>
        <td><?php echo htmlspecialchars($aluno->getEmail()); ?></td>
        <td>
            <a href="aluno_edit.php?matricula=<?php echo $aluno->getMatricula(); ?>">Editar</a>
            <a href="aluno_delete.php?matricula=<?php echo $aluno->getMatricula(); ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
