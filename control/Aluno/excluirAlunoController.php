<?php

session_start();

require_once __DIR__ . '../../model/DTO/alunoDTO.php';
require_once __DIR__ . '../../model/DAO/alunoDAO.php';

    error_reporting(0);

        $matriculaAluno = $_GET['Matricula'];

        $alunoDAO = new AlunoDAO();
        $sucesso = $alunoDAO->delete($alunoDTO);
    
    if ($result > 0) {
        $_SESSION['msgAluno'] = "Aluno excluído com sucesso!";
    } else {
        $_SESSION['errorAluno'] = "Não foi possível excluir o aluno!";
    }
        
    header('Location: ../../view/admin/listaFuncionarios.php');
?>