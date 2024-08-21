<?php

// Configurações de conexão
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'massagem';
$port = 3308;

session_start();
// Conexão com o banco de dados
$conn = mysqli_connect($server, $user, $pass, $database, $port);
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$user = $_POST['username'];
$pass = $_POST['password'];

$query = "SELECT Status FROM usuarios WHERE login = '$user' AND pass = '$pass'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['Status'];

    switch ($status) {
        case 'Vestiario Feminino':

            echo "Vestiario Feminino";

            break;
        case 'Vestiario Masculino':

            echo "Vestiario Masculino";

            break;
        case 'Administrador':

            echo "Administrador";

            break;
        default:
            echo "Erro";
            break;
    }
} else {
    echo "Erro ao executar a consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
