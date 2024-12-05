<?php

//Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../model/DTO/empresaDTO.php';
require_once __DIR__ . '../../model/DAO/empresaDAO.php';

#recebe os valores enviados do formulário via método post e evita sql injection e valida o tipo de dado.
$id = filter_input(INPUT_POST, 'ID, FILTER_VALIDATE_INT');

$dao = new EmpresaDAO();
$idEmpresa = $dao->getById($id);

//echo '<pre>';
//var_dump($idEmpresa);
?>
<main>
    <section>
        <table>
            <tbody>
                <?php if (!$idEmpresa) : ?>
                    <tr>
                        <td colspan="4">Não existem usuários com ID = <?php echo $id; ?></td>
                    </tr>
                <?php else : ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                        <tr>
                            <td><?php echo $idEmpresa['ID']; ?></td>
                            <td><?= htmlspecialchars($idEmpresa['Nome']); ?></td>
                            <td><?= htmlspecialchars($idEmpresa['CNPJ']); ?></td>
                            <td><?= htmlspecialchars($idEmpresa['Email']); ?></td>
                        </tr>
                    <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>
<br>

<a class="btn btn-voltar" href="#">Voltar</a>