<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/65f22fe718.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>


<?php 
session_start();

// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmtg_service";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: \auth\loginAluno.php");
  exit;
}

$id_do_usuario = $_SESSION["user_id"];

// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM `aluno` WHERE Matricula = $Matricula and foto is not null";
$result = $conn->query($sql);

// Exibe o formulário para atualização do cadastro
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

echo "<header>
    <ul>
        <a href='../authenticated/home.php'> <li>
            <img src='..\imagens\jmtgBRANCO-removebg-preview.png' alt=''class='logo'> 
        </li></a> 
        </li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasPorCidade.php'><li>Vagas por cidade</li></a>
        <div class='dropdown'> 
        <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
        <div style='display:flex; flex-direction:column; align-items:center;'>
          <img src='uploads/$row[foto]' style='width:50px; height:50px; border-radius:100%;'>  
          </div>    
  <li class='dropdown-btn'>$row[nome]</li>
  <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
  </div>
  <ul class='dropdown-menu'>
  <a href='perfilAluno.php'><li>Editar perfil</li></a>
  <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
  <a href='curriculo.php'> <li>Currículo</li></a>
  <a href='./logout.php'><li>Sair</li></a>
  </ul>
</div>


    </ul>
</header>";

     }
      

}

  else{

    echo "<header>
      <ul>
          <a href='../authenticated/home.php'> <li>
              <img src='\assets\img\jmtgBRANCO-removebg-preview.png' alt=''class='logo'> 
          </li></a> 
        </li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasPorCidade.php'><li>Vagas por cidade</li></a>
          <div class='dropdown'> 
          <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
            <img src='https://placehold.co/500x400' style='width:50px; height:50px; border-radius:100%;'>        
    <li class='dropdown-btn'>Perfil</li>
    <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
    </div>
    <ul class='dropdown-menu'>
    <a href='perfilAluno.php'><li>Editar perfil</li></a>
    <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
    <a href='#'> <li>Curriculo</li></a>
    <a href='./logout.php'><li>Sair</li></a>
    </ul>
  </div>
  
  
      </ul>
  </header>";
  
  }

?>
<main>

<section>
<h1>Ultimas vagas</h1>
<script>
    function baixarCurriculo() {
    var idcurriculo = $(this).data('id');
    window.location.href = "baixar_curriculo.php?id=" + idcurriculo;
}

$('.btn-baixar').on('click', EnviarCurrículo);
</script>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmtg_service";


$conn = new mysqli($servername, $username, $Senha, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql = "SELECT * FROM vaga ORDER BY   `Requisitos` text DEFAULT NULL,
 DESC";


$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
    $count = 0;

   
    while($row = $result->fetch_assoc()) {
        
        if ($count >= 5) {
            break;
        }

       
        echo "<div class='container-vagas'>"."<div class='vagas'>"." Empresa: " . $row["empresa"]."<br>" . " Cargo: " . $row["cargo"]. "<br>"."</div>"."<div class='candidatar'>"."<p> Candidatar</p>"."</div>"."</div>";

        
        $count++;
    }
} else {
    echo "<div class='not-jobs'>Nenhuma vaga encontrada.</div>";
}



$conn->close();


?>
</section>

</main>



</body>
</html>
<script>
  const dropdownBtn = document.querySelector('.dropdown-btn');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownBtn.addEventListener('click', () => {
  dropdownMenu.classList.toggle('show');
});

window.addEventListener('click', (event) => {
  if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-menu')) {
    dropdownMenu.classList.remove('show');
  }
});


</script>
<style>
    
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-btn {
  
  
  border: none;
  cursor: pointer;
  padding: 10px 20px;
  font-size: 16px;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #033F63;
 
  font-size:13px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  list-style: none;
  padding: 0;
  max-width:200px;
  width:100%;
  display: none;
  z-index: 1;
}

.dropdown-menu li {
  padding: 20px 20px;
  color:#fff;
}

.dropdown-menu li:hover {
  
  color:#033F63;
  background-color: #f1f1f1;
}

.dropdown-menu li a:hover{
  color:#033F63;
 
}
a{color:white;}
.show {
  display: block;
}


body{
  
}
    main{display:flex;
        justify-content:space-around;
        background:linear-gradient(rgb(3 63 99 / 25%), rgb(3 63 99 / 22%)), url(../imagens/img.jpeg);
        background-size: cover;
  height:100vh;
  background-position: center;
       

    }

    .container-vagas{
        display:flex;
        flex-direction:column;

    }

    .vagas{
        display:flex;
        align-items:center;
        justify-content:center;
        width:300px;
        height:80px;
        margin: auto;
        border-top-left-radius:10px;
        border-top-right-radius:10px;
        background:white;

    }
    .vagas img{margin-right:10px;}

    .candidatar{
        background:#6396d8;
        width:300px;
        height:40px;
        display:flex;
        justify-content:center;
        align-items:center;
        border-bottom-right-radius:10px;
        border-bottom-left-radius:10px;
        margin:auto;
        margin-bottom:20px;
        color: #000000;
        font-weight:600;
        
    }

    .candidatar:hover{
      color:white;
      transition: color 0.7s ease;
    }

    h1{text-align:center;
    color:white;
    margin:10px; 
 }

    .not-jobs{
        text-align:center;
        margin:100px auto;
        font-size: 26px;
        color: white;
        font-weight:600;
    }

 



</style>

