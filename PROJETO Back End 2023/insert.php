<?php
// Replace these database connection details with your actual credentials
$host = "localhost";
$user = "root";
$pass = "";
$db = "projeto_backend";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user details from POST data
$login = $_POST['login'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$nomeMaterno = $_POST['nomeMaterno'];
$telefone = $_POST['telefone'];
$data = $_POST['data'];
$cpf = $_POST['cpf'];
$celular = $_POST['celular'];
$sexo = $_POST['sexo'];
$endereco = $_POST['endereco'];
$profile = $_POST['profile'];

// Hash the password for security (you should use more secure methods, like bcrypt)
$hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

// SQL query to insert a new user
$sql = "INSERT INTO usuarios (login, senha, nome, nomeMaterno, telefoneFixo, dataNascimento, cpf, celular, sexo, endereco, profile) 
        VALUES ('$login', '$hashedPassword', '$nome', '$nomeMaterno', '$telefone', '$data', '$cpf', '$celular', '$sexo', '$endereco', '$profile')";

if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error creating user: " . $conn->error;
}

// Close connection
$conn->close();
?>