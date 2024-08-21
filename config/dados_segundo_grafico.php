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

// Função para buscar os dados dos setores e a quantidade de trabalhadores por setor
function fetchSetorData() {
    global $conn;

    // Consulta SQL para contar a quantidade de trabalhadores por setor
    $sql = "SELECT s.ID_Setor, s.Nome_Setor, COUNT(rd.ID_Reg_Detalhe) AS Quantidade_Trabalhadores
            FROM setor s
            LEFT JOIN registro_detalhe rd ON s.ID_Setor = rd.ID_Setor
            GROUP BY s.ID_Setor, s.Nome_Setor
            ORDER BY Quantidade_Trabalhadores DESC";

    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        $setorData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $setorData[] = [
                'Nome_Setor' => $row['Nome_Setor'],
                'Quantidade_Trabalhadores' => $row['Quantidade_Trabalhadores']
            ];
        }

        return $setorData;
    } else {
        return null;
    }
}

// Buscar os dados dos setores e a quantidade de trabalhadores
$setorData = fetchSetorData();

// Fechar a conexão com o banco de dados
mysqli_close($conn);

// Enviar os dados dos setores em formato JSON de volta ao JavaScript
echo json_encode($setorData);
?>
