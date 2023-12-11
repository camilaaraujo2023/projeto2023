<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/styleCadastro.css">
    <title>Autenticação</title>
</head>
<body>
<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "projeto_backend";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $enteredMotherName = $_POST['mothername'];
    $enteredCpf = $_POST['cpf'];
    $login = $_POST['login'];

    // Check if the entered data matches the stored data
    $query = "SELECT * FROM usuarios WHERE login = '$login'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($enteredMotherName === $row['nomeMaterno'] && $enteredCpf === $row['CPF']) {
            // Redirect to a success page
            header("Location: master_profile.php");
            exit();
        } else {
            // Display an error message
            $_SESSION['msg'] = "<p style='color:#ff0000'>Nome da mae, CPF ou login incorretos, atualize a pagina e tente novamente.</p>";
        }
    }
}
?>

    <figure class="telecall">
      <img src="Imagens/Telecall.png" alt="Telecall">
    </figure>

    <center>
    <div1>
        <h2 class="h1">Autenticação de dois fatores</h2>
    </div1>
    <div2>

    
         <!-- <form action="#" method="get"> -->
        <form method="post" action="2fa.php">
         <label for="test1" class="h1">Qual a seu login ?</label><br>
         <input type="text" name="login" id="login" maxlength="60" minlength="2"><br><br>

         <label for="test1" class="h1">Qual o nome da sua mãe ?</label><br>
         <input type="text" name="mothername" id="mothername" maxlength="60" minlength="2"><br><br>

         <label for="test3" class="h1">Informe seu CPF:</label><br>
         <input type="number" name="cpf" id="cpf">

         <input type="submit" value="Submit">
        </form>
    </div2>
    </center>
</body>
</html>