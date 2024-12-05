<?php
require_once __DIR__ . "/../../../layouts/header.php";
require_once __DIR__ . "/../../../layouts/nav.php";

?>

<main>
    <h1>Pesquisar Alunos</h1>
    <a class="btn btn-voltar" href="index.php">Voltar</a>

        <form action="../../../control/pesquisarAlunoController.php" method="POST" >
          Matricula:<input type="search" name="Matricula" placeholder="Digite uma matrícula para pesquisar" required>
         <button class="btn" type="submit" >Pesquisar</button>

        </form>

</main>

<?php require_once __DIR__ . "/../../../layouts/footer.php"; ?>
