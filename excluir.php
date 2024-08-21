<?php
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

$conn = mysqli_connect($server, $user, $pass, $database, $port);

mysqli_set_charset($conn, "utf8");
if ($conn) {
} else {
    echo 'Erro na conexão: ' . mysqli_connect_error();
}if (isset($_POST['id'])) {

    $query = "Delete FROM registro_detalhe WHERE ID_Reg_Detalhe =" . $_POST['id'];

    $result = $conn->query($query);

}
