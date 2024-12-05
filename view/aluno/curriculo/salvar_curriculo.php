<?php
require_once 'conexao.php';

// Captura os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$sobre_mim = $_POST['sobre_mim'];
$atividades_extracurriculares = $_POST['atividades_extracurriculares'];

// Salva as informações no banco de dados
$queryCurriculo = "INSERT INTO curriculo (Nome, Email, Telefone, Sobre_Mim, Atividades_Extracurriculares) 
                   VALUES (:nome, :email, :telefone, :sobre_mim, :atividades_extracurriculares)";
$stmt = $dbh->prepare($queryCurriculo);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':sobre_mim', $sobre_mim);
$stmt->bindParam(':atividades_extracurriculares', $atividades_extracurriculares);
$stmt->execute();

// Captura o ID do currículo inserido
$curriculoCodigo = $dbh->lastInsertId();

// Salva as formações
foreach ($_POST['formacao'] as $formacao) {
    $queryFormacao = "INSERT INTO formacao (Curso, Instituicao, Ano_Conclusao, Curriculo_Codigo) 
                      VALUES (:curso, :instituicao, :ano_conclusao, :curriculo_codigo)";
    $stmtFormacao = $dbh->prepare($queryFormacao);
    $stmtFormacao->bindParam(':curso', $formacao['curso']);
    $stmtFormacao->bindParam(':instituicao', $formacao['instituicao']);
    $stmtFormacao->bindParam(':ano_conclusao', $formacao['ano_conclusao']);
    $stmtFormacao->bindParam(':curriculo_codigo', $curriculoCodigo);
    $stmtFormacao->execute();
}

// Salva as experiências profissionais
foreach ($_POST['experiencia'] as $experiencia) {
    $queryExperiencia = "INSERT INTO experiencias_profissionais (Empresa, Funcao, Periodo, Atividade, Curriculo_Codigo) 
                         VALUES (:empresa, :funcao, :periodo, :atividade, :curriculo_codigo)";
    $stmtExperiencia = $dbh->prepare($queryExperiencia);
    $stmtExperiencia->bindParam(':empresa', $experiencia['empresa']);
    $stmtExperiencia->bindParam(':funcao', $experiencia['funcao']);
    $stmtExperiencia->bindParam(':periodo', $experiencia['periodo']);
    $stmtExperiencia->bindParam(':atividade', $experiencia['atividade']);
    $stmtExperiencia->bindParam(':curriculo_codigo', $curriculoCodigo);
    $stmtExperiencia->execute();
}

// Salva os cursos complementares
foreach ($_POST['curso'] as $curso) {
    $queryCurso = "INSERT INTO curso (Nome, Instituicao, Conclusao, Curriculo_Codigo) 
                   VALUES (:nome, :instituicao, :conclusao, :curriculo_codigo)";
    $stmtCurso = $dbh->prepare($queryCurso);
    $stmtCurso->bindParam(':nome', $curso['nome']);
    $stmtCurso->bindParam(':instituicao', $curso['instituicao']);
    $stmtCurso->bindParam(':conclusao', $curso['conclusao']);
    $stmtCurso->bindParam(':curriculo_codigo', $curriculoCodigo);
    $stmtCurso->execute();
}

echo "Currículo salvo com sucesso!";
?>
