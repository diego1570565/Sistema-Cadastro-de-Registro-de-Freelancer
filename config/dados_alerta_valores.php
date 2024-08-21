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

$data_inicial = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : null;
$data_final = isset($_POST['data_final']) ? $_POST['data_final'] : null;

function fetchSetorData($data_inicial, $data_final) {
    global $conn;

    // Definir intervalo padrão de 90 dias se nenhuma data for definida
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

    // Consulta SQL com filtro de data
    $sql = "SELECT SUM(ROUND(Valor_Pago + Valor_Adicional, 2)) AS total_90_dias
            FROM registro_detalhe
            WHERE Dia_Trabalhado >= '$data_inicial' AND Dia_Trabalhado <= '$data_final'";

    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data;
    } else {
        return null;
    }
}

// Buscar os dados dos setores e a quantidade de trabalhadores
$setorData = fetchSetorData($data_inicial, $data_final);

// Fechar a conexão com o banco de dados
mysqli_close($conn);

// Enviar os dados dos setores em formato JSON de volta ao JavaScript
echo json_encode($setorData);
?>
