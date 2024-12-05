<?php
require('libs/fpdf.php');

// Criando o objeto FPDF
$pdf = new FPDF();
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Definindo o título do documento
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Curriculo', 0, 1, 'C');

// Definindo as informações pessoais
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 10, 'Informacoes Pessoais', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Nome: ', 0, 0);
$pdf->Cell(140, 10, 'Joao da Silva', 0, 1);

$pdf->Cell(50, 10, 'Email: ', 0, 0);
$pdf->Cell(140, 10, 'joao.silva@gmail.com', 0, 1);

$pdf->Cell(50, 10, 'Telefone: ', 0, 0);
$pdf->Cell(140, 10, '(11) 98765-4321', 0, 1);

// Definindo a formação acadêmica
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 10, 'Formacao Academica', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Curso: ', 0, 0);
$pdf->Cell(140, 10, 'Sistemas de Informacao', 0, 1);

$pdf->Cell(50, 10, 'Instituicao: ', 0, 0);
$pdf->Cell(140, 10, 'Universidade ABC', 0, 1);

$pdf->Cell(50, 10, 'Ano de Conclusao: ', 0, 0);
$pdf->Cell(140, 10, '2024', 0, 1);

// Definindo a experiência profissional
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 10, 'Experiencia Profissional', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Empresa: ', 0, 0);
$pdf->Cell(140, 10, 'Tech Solutions', 0, 1);

$pdf->Cell(50, 10, 'Funcao: ', 0, 0);
$pdf->Cell(140, 10, 'Desenvolvedor de Software', 0, 1);

$pdf->Cell(50, 10, 'Periodo: ', 0, 0);
$pdf->Cell(140, 10, 'Jan 2022 - Presente', 0, 1);

// Definindo os cursos extras
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 10, 'Cursos Extras', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Curso: ', 0, 0);
$pdf->Cell(140, 10, 'Curso de PHP Avancado', 0, 1);

$pdf->Cell(50, 10, 'Instituicao: ', 0, 0);
$pdf->Cell(140, 10, 'CursoOnline.com', 0, 1);

// Gerar o PDF e exibir para o usuário
$pdf->Output();
?>
