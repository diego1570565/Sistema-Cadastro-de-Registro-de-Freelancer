<?php
// Conexão com o banco de dados
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

$id = $_GET['id'];
// Conexão com o banco de dados
$conn = mysqli_connect($server, $user, $pass, $database, $port);

// Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Query para buscar os dados do cargo
$sql = "SELECT `ID_Cargo`, `Nome_cargo`, `Valor_Pago`, `Comissao` FROM `cargo` WHERE ID_Cargo = $id";

// Executa a query
$result = $conn->query($sql);

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Inicializa a string de resposta
    $string_response = "";

    // Itera sobre os resultados da consulta
    while ($row = $result->fetch_assoc()) {
        // Formata os dados do cargo como uma string
      echo $row["Valor_Pago"];
    }

} else {
    echo "Nenhum cargo encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
