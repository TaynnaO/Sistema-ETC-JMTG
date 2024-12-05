<?php

//var_dump($alunos);

// Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir os arquivos necessários "DAO"
require_once __DIR__ . "../../model/DAO/alunoDAO.php";

// Criar DAO e buscar Alunos
$alunoDAO = new AlunoDAO();
$alunos = $alunoDAO->getAll(); 

// Exibir a lista de Alunos
require_once __DIR__ . "../../view/admin/aluno/pesquisarAluno.php";

?>