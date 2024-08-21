<?php
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

$conn = mysqli_connect($server, $user, $pass, $database, $port);

mysqli_set_charset($conn, "utf8");
if ($conn) {
    // Verifica se a data foi enviada via POST
    if (isset($_POST['data_apagar_registros'])) {
        // Sanitiza a data recebida para evitar SQL Injection
        $data = mysqli_real_escape_string($conn, $_POST['data_apagar_registros']);

        // Formata a data para o formato padrão do MySQL (yyyy-mm-dd)
        $data_formatada = date('Y-m-d', strtotime($data));

        // Define a query para apagar os registros com a data especificada
        $query = "DELETE FROM `registro` WHERE `Data_Registro` = '$data_formatada'";


        echo $query;


        // Executa a query
        if ($conn->query($query) === TRUE) {
            echo "Registros apagados com sucesso!";
        } else {
            echo "Erro ao apagar registros: " . $conn->error;
        }
    } else {
        echo "Data não informada.";
    }
} else {
    echo 'Erro na conexão: ' . mysqli_connect_error();
}

// Fecha a conexão
$conn->close();
?>
