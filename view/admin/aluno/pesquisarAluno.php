<?php
require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";

?>

<main>
    <h1>Pesquisar Administradores</h1>
    <a class="btn btn-voltar" href="index.php">Voltar</a>

        <form action="../../../control/Aluno/pesquisarAlunoController.php" method="POST" >
          Matricula: <input type="search" name="ID" placeholder="Digite um número de ID para pesquisar" required>
         <button class="btn" type="submit" >Pesquisar</button>

        </form>

</main>

<?php require_once __DIR__ . "/../../../layouts/footer.php"; ?>