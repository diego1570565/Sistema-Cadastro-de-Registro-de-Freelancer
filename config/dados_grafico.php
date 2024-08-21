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

function fetchDadosPeriodo($data_inicial, $data_final) {
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

    // Consulta SQL com filtro de data
    $sql = "SELECT Dia_Trabalhado, ROUND(SUM(Valor_Pago + Valor_Adicional), 2) AS total_pagto_diario 
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
                'total_pagto_diario' => $row['total_pagto_diario']
            ];
        }

        // Preencher os dias ausentes com valor zero
        $dataPreenchida = $data_inicial;
        while ($dataPreenchida <= $data_final) {
            $encontrou = false;
            foreach ($dados as $dado) {
                if ($dado['data'] == $dataPreenchida) {
                    $encontrou = true;
                    break;
                }
            }
            if (!$encontrou) {
                $dados[] = [
                    'data' => $dataPreenchida,
                    'total_pagto_diario' => 0
                ];
            }
            $dataPreenchida = date('Y-m-d', strtotime($dataPreenchida . ' +1 day'));
        }

        // Ordenar os dados pela data
        usort($dados, function ($a, $b) {
            return strtotime($a['data']) - strtotime($b['data']);
        });

        return $dados;
    } else {
        return null;
    }
}

// Buscar os dados do período definido
$dadosPeriodo = fetchDadosPeriodo($data_inicial, $data_final);

// Fechar a conexão com o banco de dados
mysqli_close($conn);

// Enviar os dados em formato JSON de volta ao JavaScript
echo json_encode($dadosPeriodo);
?>
