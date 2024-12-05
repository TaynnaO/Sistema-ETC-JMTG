<?php
require_once '../src/conexao.php';

try {
    $conexao = Conexao::getConexao();
    $stmt = $conexao->query("SELECT * FROM aluno");
    $perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($perfil) > 0) {
        echo "Conexão bem-sucedida! Foram encontrados" . count ($perfil) . "ID";
    } else {
        echo "Nenhum perfil econtrado.";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>