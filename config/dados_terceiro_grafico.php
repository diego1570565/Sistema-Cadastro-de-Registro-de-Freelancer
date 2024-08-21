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

// Função para buscar os dados do terceiro gráfico
function fetchDadosTerceiroGrafico($data_inicial, $data_final) {
    global $conn;

    // Definir intervalo padrão de 90 dias se nenhuma data for definida
    if (empty($data_inicial) && empty($data_final)) {
        $data_inicial = date('Y-m-d', strtotime('-89 days'));
        $data_final = date('Y-m-d');
    }

    // Se somente uma das datas for definida
    if (empty($data_inicial)) {
        $data_inicial = date('Y-m-d', strtotime('-89 days', strtotime($data_final)));
    }
    if (empty($data_final)) {
        $data_final = date('Y-m-d');
    }

    // Consulta SQL para os últimos 90 dias na tabela registro_detalhe
    $sql = "SELECT Dia_Trabalhado, COUNT(ID_Reg_Detalhe) AS total_freelancers 
            FROM registro_detalhe 
            WHERE Dia_Trabalhado >= '$data_inicial' AND Dia_Trabalhado <= '$data_final'
            GROUP BY Dia_Trabalhado";

    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        $dados = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dados[] = [
                'data' => $row['Dia_Trabalhado'],
                'total_freelancers' => $row['total_freelancers']
            ];
        }

        // Preencher os dias ausentes com valor zero
        $dataPreenchida = new DateTime($data_inicial);
        $dataFinal = new DateTime($data_final);
        $interval = new DateInterval('P1D');
        $periodo = new DatePeriod($dataPreenchida, $interval, $dataFinal);

        foreach ($periodo as $data) {
            $dataFormatada = $data->format('Y-m-d');
            $encontrou = false;
            foreach ($dados as $dado) {
                if ($dado['data'] == $dataFormatada) {
                    $encontrou = true;
                    break;
                }
            }
            if (!$encontrou) {
                $dados[] = [
                    'data' => $dataFormatada,
                    'total_freelancers' => 0
                ];
            }
        }

        // Ordenar os dados pela data
        usort($dados, function ($a, $b) {
            return strtotime($a['data']) - strtotime($b['data']);
        });

        return $dados;
    } else {
        // Se houver erro na consulta, retorna mensagem de erro
        return ['error' => 'Erro ao consultar dados do terceiro gráfico.'];
    }
}

// Buscar os dados do terceiro gráfico
$dadosTerceiroGrafico = fetchDadosTerceiroGrafico($data_inicial, $data_final);

// Fechar a conexão com o banco de dados
mysqli_close($conn);

// Montar a resposta em formato JSON
$response = [$dadosTerceiroGrafico];

// Enviar os dados em formato JSON de volta ao JavaScript
header('Content-Type: application/json');
echo json_encode($dadosTerceiroGrafico);
?>
