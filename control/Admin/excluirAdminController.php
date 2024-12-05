<?php

session_start();

require_once __DIR__ . '../../model/DTO/adminDTO.php';
require_once __DIR__ . '../../model/DAO/adminDAO.php';

    error_reporting(0);

        $idAdmin = $_GET['ID'];

        $adminDAO = new adminDAO();
        $sucesso = $adminDAO->delete($adminDTO);

    if ($result > 0) {
        $_SESSION['msgAdmin'] = "Administrador excluído com sucesso!";
    } else {
        $_SESSION['errorAdmin'] = "Não foi possível excluir o Administrador!";
    }
            
    header('Location: ../../view/admin/listaFuncionarios.php');
?>