<?php
// Conectar ao banco de dados
require_once 'conexao.php';  // Supondo que você tenha uma conexão configurada

// Captura o código do currículo, passado como parâmetro na URL
$curriculo_codigo = $_GET['curriculo_codigo'];

// Buscar os dados do currículo
$query = "SELECT * FROM curriculo WHERE Codigo = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$curriculo_codigo]);
$curriculo = $stmt->fetch();

// Buscar a formação do aluno
$query = "SELECT * FROM formacao WHERE Curriculo_Codigo = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$curriculo_codigo]);
$formacao = $stmt->fetch();

// Buscar as experiências profissionais do aluno
$query = "SELECT * FROM experiencias_profissionais WHERE Curriculo_Codigo = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$curriculo_codigo]);
$experiencias = $stmt->fetchAll();

// Buscar os cursos do aluno
$query = "SELECT * FROM curso WHERE Curriculo_Codigo = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$curriculo_codigo]);
$cursos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo - Visualização</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .curriculo {
            margin-bottom: 30px;
        }
        .curriculo h1 {
            text-align: center;
            color: #007bff;
        }
        .curriculo section {
            margin-bottom: 20px;
        }
        .curriculo .info {
            margin-bottom: 10px;
        }
        .curriculo .info label {
            font-weight: bold;
        }
        .curriculo .info p {
            margin: 5px 0;
        }
        .imprimir-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .imprimir-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="curriculo">
    <h1>Currículo de <?= htmlspecialchars($curriculo['Nome']) ?></h1>
    
    <!-- Informações Pessoais -->
    <section>
        <h2>Informações Pessoais</h2>
        <div class="info">
            <label>Matrícula:</label>
            <p><?= htmlspecialchars($curriculo['Aluno_Matricula']) ?></p>
        </div>
        <div class="info">
            <label>Sobre Mim:</label>
            <p><?= nl2br(htmlspecialchars($curriculo['Sobre_Mim'])) ?></p>
        </div>
        <div class="info">
            <label>Atividades Extracurriculares:</label>
            <p><?= nl2br(htmlspecialchars($curriculo['Atividades_Extracurriculares'])) ?></p>
        </div>
        <div class="info">
            <label>Interesses Profissionais:</label>
            <p><?= nl2br(htmlspecialchars($curriculo['Interesses_Profissionais'])) ?></p>
        </div>
    </section>

    <!-- Formação Acadêmica -->
    <section>
        <h2>Formação Acadêmica</h2>
        <div class="info">
            <label>Curso:</label>
            <p><?= htmlspecialchars($formacao['Curso']) ?></p>
        </div>
        <div class="info">
            <label>Ano de Conclusão:</label>
            <p><?= htmlspecialchars($formacao['Ano_Conclusao']) ?></p>
        </div>
        <div class="info">
            <label>Instituição:</label>
            <p><?= htmlspecialchars($formacao['Instituicao']) ?></p>
        </div>
    </section>

    <!-- Experiência Profissional -->
    <section>
        <h2>Experiência Profissional</h2>
        <?php foreach ($experiencias as $experiencia): ?>
            <div class="info">
                <label>Empresa:</label>
                <p><?= htmlspecialchars($experiencia['Empresa']) ?></p>
            </div>
            <div class="info">
                <label>Função:</label>
                <p><?= htmlspecialchars($experiencia['Funcao']) ?></p>
            </div>
            <div class="info">
                <label>Período:</label>
                <p><?= htmlspecialchars($experiencia['Periodo']) ?></p>
            </div>
            <div class="info">
                <label>Atividades:</label>
                <p><?= nl2br(htmlspecialchars($experiencia['Atividade'])) ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Cursos -->
    <section>
        <h2>Cursos</h2>
        <?php foreach ($cursos as $curso): ?>
            <div class="info">
                <label>Nome do Curso:</label>
                <p><?= htmlspecialchars($curso['Nome']) ?></p>
            </div>
            <div class="info">
                <label>Instituição:</label>
                <p><?= htmlspecialchars($curso['Instituicao']) ?></p>
            </div>
            <div class="info">
                <label>Conclusão:</label>
                <p><?= htmlspecialchars($curso['Conclusao']) ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<!-- Botão de Impressão -->
<button class="imprimir-btn" onclick="window.print()">Imprimir Currículo</button>

</body>
</html>

<style>
@media print {
    body {
        font-size: 12pt;
        color: #000;
    }
    .imprimir-btn {
        display: none;
    }
}
</style>