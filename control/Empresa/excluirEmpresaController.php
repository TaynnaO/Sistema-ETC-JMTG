<?php

session_start();

require_once __DIR__ . '../../model/DTO/empresaDTO.php';
require_once __DIR__ . '../../model/DAO/empresaDAO.php';

    error_reporting(0);

        $idEmpresa = $_GET['ID'];

        $empresaDAO = new empresaDAO();
        $sucesso = $empresaDAO->delete($empresaDTO);

        if ($result > 0) {
            $_SESSION['msgAluno'] = "Aluno excluído com sucesso!";
        } else {
            $_SESSION['errorAluno'] = "Não foi possível excluir o aluno!";
        }
            
        header('Location: ../../view/admin/listaFuncionarios.php');
?>