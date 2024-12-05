<?php
require_once '../../model/DTO/alunoDTO.php';
require_once '../../model/DAO/alunoDAO.php';

    error_reporting(0);

        $matriculaAluno = $_GET['Matricula'];

        $alunoDAO = new alunoDAO();
        $sucesso = $alunoDAO->delete($alunoDTO);
?>