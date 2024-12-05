<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmtg_service";

$conn = new mysqli($servername, $username, $Senha $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $Email = $_POST['Email'];
    $Senha = $_POST['Senha'];

    $sql = "SELECT * FROM empresa WHERE Email = ? AND Senha = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Falha na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ss", $Email, $Senha);

    if ($stmt->execute()) {
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            $_SESSION['ID'] = $row['ID']; 

            header("Location: view/empresa/homeEmpresa.php");
            exit();
            
        } else {
          
            echo "Usuário ou senha incorretos!";
            sleep(3); 
            header("Location: loginEmpresa.php");
            exit();
        }
        
    } else {
        echo "Erro ao buscar no banco de dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
