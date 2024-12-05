<?php 
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmtg_service";

$conn = new mysqli($servername, $ID, $Senha, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (!isset($_SESSION["ID"])) {
    header("Location: ..\login.php");
    exit;
}

$ID = $_SESSION["ID"];
$idcurriculo = $_GET["id"];
$sql = "SELECT curriculo FROM cadastro WHERE id = $idcurriculo";
$result = $conn->query($sql);

// Verificar se o SELECT retornou algum resultado
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $curriculo = $row["curriculo"];

    // Verificar se o currículo não é vazio
    if (!empty($curriculo)) {
        // Definir o caminho completo do arquivo a ser baixado
        $caminho_arquivo = $caminho = __DIR__ . "/uploads/$curriculo";
        // Verificar se o arquivo existe
        if (file_exists($caminho_arquivo)) {
            // Definir o nome do arquivo que será baixado
            $nome_arquivo = basename($caminho_arquivo);

            // Definir os headers para permitir o download do arquivo
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=$nome_arquivo");

            // Ler o conteúdo do arquivo e enviá-lo para o cliente
            readfile($caminho_arquivo);

            header("location:homeEmpresa.php");

            // Encerrar o script para evitar a impressão de outros conteúdos
            exit;
        } else {
            echo "Arquivo não encontrado.";
            header("location:homeEmpresa.php");
            echo '<script>alert("Mensagem de alerta!");</script>';


        }
    } else {
        echo "O usuário selecionado não possui currículo cadastrado.";
        header("location:homeEmpresa.php");
        echo '<script>alert("Mensagem de alerta!");</script>';

    }
} else {
    echo "Usuário não encontrado.";
    header("location:homeEmpresa.php");
}

// Fechar a conexão com o banco de dados
$conn->close();



?>
