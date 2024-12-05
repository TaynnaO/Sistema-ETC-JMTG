<?php

class ValidadorEmail{

    public static function emailJaCadastradoAluno($email, $dbh) {
        $query = "SELECT COUNT(*) FROM aluno WHERE Email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0; // Retorna true se o e-mail já estiver cadastrado
    }
    public static function emailJaCadastradoEmpresa($email, $dbh) {
        $query = "SELECT COUNT(*) FROM empresa WHERE Email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0; // Retorna true se o e-mail já estiver cadastrado
    }
    public static function emailJaCadastradoAdmin($email, $dbh) {
        $query = "SELECT COUNT(*) FROM usuario_sistema WHERE Email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0; // Retorna true se o e-mail já estiver cadastrado
    }
}

?>