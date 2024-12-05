<?php
// index.php
require_once '../../control/AlunoController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$controller = new AlunoController($pdo);

switch ($action) {
    case 'create':
        $controller->createAluno();
        break;
    case 'showForm':
        $controller->showForm();
        break;
    case 'list':
    default:
        $controller->listAlunos();
        break;
}
?>
