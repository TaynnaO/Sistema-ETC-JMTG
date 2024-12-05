<?php

require_once __DIR__ . "../../src/conexao.php";

session_start();
$admin = $_SESSION['admin'] ?? null;
if (!$admin) {
    unset($_SESSION['admin']);
}
session_destroy();
header("location: ./index.php");
exit;
?>
