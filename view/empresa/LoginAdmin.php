<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  // Redireciona para a página de login
  header("Location: login.php");
  exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmtg_service";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['Vaga_Numero'])) {
    $vagaId = $_GET['Vaga_Numero'];

    $sql = "SELECT * FROM `candidatura` i
    LEFT JOIN cadastro c
    ON
    i.nome_usuario = c.id
    WHERE id_vaga = $Vaga_Numero";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $curriculo = 'uploads/' . $row["curriculo"];  // Caminho relativo à pasta "uploads"
            $curriculoNome = $row["Nome"];
            if (!empty($curriculo) && file_exists($curriculo)) {
                echo "<div class='userVaga'>";
                echo "<p>Nome:".$row['Nome']."</p>";
                echo"<p>Email: ".$row['email']."</p>";
                echo '<a href="' . $curriculo . '" download>' .'Baixar currículo' . '</a></div>';
                

            } else {
                echo '<li>Arquivo de currículo não encontrado.</li>';
            }
        }
    } else {
        echo "Nenhum candidato a esta vaga.";
    }
} else {
    echo "Nenhum candidato a esta vaga.";
}

$conn->close();
