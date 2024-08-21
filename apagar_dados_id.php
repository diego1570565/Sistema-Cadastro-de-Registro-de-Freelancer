<?php
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

$conn = mysqli_connect($server, $user, $pass, $database, $port);

mysqli_set_charset($conn, "utf8");
if ($conn) {
    // Verifica se o ID foi enviado via POST
    if (isset($_POST['id_apagar_registros'])) {
        // Sanitiza o ID recebido para evitar SQL Injection
        $id = mysqli_real_escape_string($conn, $_POST['id_apagar_registros']);

  

            // Apaga os registros na tabela registro_detalhe a partir do ID fornecido
            $query_delete_detalhes = "DELETE FROM registro_detalhe WHERE ID_Registro >= $id";
            // $conn->query($query_delete_detalhes);

            echo $query_delete_detalhes;

            // Apaga os registros na tabela registro com base nos IDs coletados
            $query_delete_registro = "DELETE FROM registro WHERE ID_Registro >= $id";
            // $conn->query($query_delete_registro);

            echo $query_delete_registro;

    
    } else {
        echo "ID não informado.";
    }
} else {
    echo 'Erro na conexão: ' . mysqli_connect_error();
}

// Fecha a conexão
$conn->close();
?>
