<?php
require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";

require_once __DIR__ . "/../../../model/DAO/alunoDAO.php";

# cria a variavel $id com valor igual a 1 e evita sql injecton e validar o tipo de dados. 
$matricula = filter_input(INPUT_GET, 'Matricula', FILTER_VALIDATE_INT) ?? 0;

# cria um objeto da classe UsuarioDAO e chama método para realizar ação.
$dao = new AlunoDAO();
$result = $dao->delete($matricula);

if ($result > 0) {
    header('location: index.php?msg=Usuário excluído com sucesso!');
} else {
    header('location: index.php?error=Não foi possível excluir o usuário!');
}
?>
