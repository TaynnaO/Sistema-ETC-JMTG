<?php
session_start();
$aluno = $_SESSION['aluno'] ?? null;
if (!$aluno) {
    unset($_SESSION['aluno']);
}
session_destroy();
header("location: ../index.html");
exit;
?>
