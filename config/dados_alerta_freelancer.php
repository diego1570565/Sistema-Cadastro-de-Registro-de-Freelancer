<?php
// Configurações do banco de dados
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'freelancer';

// Conexão com o banco de dados
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}



// Função para buscar os dados dos setores e a quantidade de trabalhadores por setor
function fetchSetorData()
{
    global $conn;
    
    $data_inicial = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : null;
    $data_final = isset($_POST['data_final']) ? $_POST['data_final'] : null;

    if (empty($data_inicial) && empty($data_final)) {
        $data_inicial = date('Y-m-d', strtotime('-90 days'));
        $data_final = date('Y-m-d');
    }

    // Se somente uma das datas for definida
    if (empty($data_inicial)) {
        $data_inicial = date('Y-m-d', strtotime('-90 days', strtotime($data_final)));
    }
    if (empty($data_final)) {
        $data_final = date('Y-m-d');
    }


    // Consulta SQL para contar a quantidade de trabalhadores por setor
    $sql = "SELECT COUNT(ID_Registro) AS SOMA 
    FROM `registro` 
    WHERE Data_Registro >= '$data_inicial' AND Data_Registro <= '$data_final'";

    $result = mysqli_query($conn, $sql);

  
        while ($row = mysqli_fetch_assoc($result)) {
            echo json_encode($row);
        }
    
}

// Buscar os dados dos setores e a quantidade de trabalhadores
$setorData = fetchSetorData();

// Fechar a conexão com o banco de dados
mysqli_close($conn);

// Enviar os dados dos setores em formato JSON de volta ao JavaScript

