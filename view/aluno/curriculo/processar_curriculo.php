<?php
// Conectar ao banco de dados
require_once 'conexao.php';  // Supondo que você tenha uma conexão configurada

// Captura os dados do formulário
$matricula = $_POST['Aluno_Matricula'];
$sobre_mim = $_POST['Sobre_Mim'];
$atividades_extracurriculares = $_POST['Atividades_Extracurriculares'];
$interesses_profissionais = $_POST['Interesses_Profissionais'];
$grau_escolaridade_id = $_POST['Grau_Escolaridade_ID'];
$curso = $_POST['Curso'];
$ano_conclusao = $_POST['Ano_Conclusao'];
$instituicao = $_POST['Instituicao'];
$empresa = $_POST['Empresa'];
$funcao = $_POST['Funcao'];
$periodo = $_POST['Periodo'];
$atividade = $_POST['Atividade'];
$nome_curso = $_POST['Nome_Curso'];
$instituicao_curso = $_POST['Instituicao_Curso'];
$conclusao_curso = $_POST['Conclusao_Curso'];

// Inserir dados na tabela 'curriculo'
$query = "INSERT INTO curriculo (Aluno_Matricula, Sobre_Mim, Atividades_Extracurriculares, Interesses_Profissionais) 
          VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$matricula, $sobre_mim, $atividades_extracurriculares, $interesses_profissionais]);

// Captura o código gerado para o currículo
$curriculo_codigo = $pdo->lastInsertId();

// Inserir dados na tabela 'formacao'
$query = "INSERT INTO formacao (Curso, Ano_Conclusao, Instituicao, Curriculo_Codigo, Grau_Escolaridade_id) 
          VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$curso, $ano_conclusao, $instituicao, $curriculo_codigo, $grau_escolaridade_id]);

// Inserir dados na tabela 'experiencias_profissionais'
$query = "INSERT INTO experiencias_profissionais (Empresa, Funcao, Periodo, Atividade, Curriculo_Codigo) 
          VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$empresa, $funcao, $periodo, $atividade, $curriculo_codigo]);

// Inserir dados na tabela 'curso'
$query = "INSERT INTO curso (Nome, Instituicao, Conclusao, Curriculo_Codigo) 
          VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$nome_curso, $instituicao_curso, $conclusao_curso, $curriculo_codigo]);

echo "Currículo enviado com sucesso!";
?>
