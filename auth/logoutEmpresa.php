<?php
session_start();
$empresa = $_SESSION['empresa'] ?? null;
if (!$empresa) {
    unset($_SESSION['empresa']);
}
session_destroy();
header("location: ./index.php");
exit;
?>
