<?php

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../model/DTO/adminDTO.php';
require_once __DIR__ . '../../model/DAO/adminDAO.php';

#recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dado.
$id = filter_input(INPUT_POST, 'ID, FILTER_VALIDATE_INT');

$dao = new AdminDAO();
$idAdmin = $dao->getById($id);

//echo '<pre>';
//var_dump($idAdmin);
?>
<main>
    <section>
        <table>
            <tbody>
                <?php if (!$idAdmin) : ?>
                    <tr>
                        <td colspan="4">Não existem usuários com ID = <?php echo $id; ?></td>
                    </tr>
                <?php else : ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                        <tr>
                            <td><?php echo $idAdmin['ID']; ?></td>
                            <td><?= htmlspecialchars($idAdmin['Nome']); ?></td>
                            <td><?= htmlspecialchars($idAdmin['CPF']); ?></td>
                            <td><?= htmlspecialchars($idAdmin['Email']); ?></td>
                        </tr>
                    <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>
<br>

<a class="btn btn-voltar" href="#">Voltar</a>