<?php

$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

session_start();
// Conexão com o banco de dados
$conn = mysqli_connect($server, $user, $pass, $database, $port);
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os registros do armazenamento local
    $registros = json_decode($_POST['registros'], true);

    if (!empty($registros)) {
        // Recupera o nome completo do freelancer do primeiro registro enviado
        $nome_completo_freelancer = $registros[0]['freelancer'];

        // Consulta o ID do freelancer com base no nome completo
        $sql_id_freelancer = "SELECT ID_freelancer FROM freelancer WHERE Nome_Completo = '$nome_completo_freelancer'";
        $result_id_freelancer = mysqli_query($conn, $sql_id_freelancer);

        if ($result_id_freelancer) {
            $row_id_freelancer = mysqli_fetch_assoc($result_id_freelancer);
            $id_freelancer = $row_id_freelancer['ID_freelancer'];

            // Insere na tabela 'registro' a data e hora local e o ID do freelancer
            $data_registro = date('Y-m-d H:i:s');
            $sql_registro = "INSERT INTO registro (Data_Registro, ID_Freelancer, Nome_freelancer) VALUES ('$data_registro', $id_freelancer, '$nome_completo_freelancer')";
            if (mysqli_query($conn, $sql_registro)) {
                // Recupera o ID do registro inserido
                $id_registro = mysqli_insert_id($conn);

                // Insere os detalhes do registro na tabela 'registro_detalhe'
                foreach ($registros as $registro) {
                    $dia_trabalhado = $registro['dia_trabalhado'];
                    $id_cargo = $registro['cargo'];
                    $valor_pago = $registro['valor_pago'];
                    $valor_adicional = $registro['valor_adicional'];
                    $id_setor = $registro['setor'];

                    $sql_registro_detalhe = "INSERT INTO registro_detalhe (ID_Registro, Dia_Trabalhado, ID_Cargo, Valor_Pago, Valor_Adicional, ID_Setor) VALUES ($id_registro, '$dia_trabalhado', $id_cargo, '$valor_pago', '$valor_adicional', $id_setor)";
                    if (!mysqli_query($conn, $sql_registro_detalhe)) {
                        echo "Erro ao inserir registro detalhe: " . mysqli_error($conn);
                    }
                }
                echo "Registros inseridos com sucesso!";
            } else {
                echo "Erro ao inserir registro: " . mysqli_error($conn);
            }
        } else {
            echo "Erro ao buscar ID do freelancer: " . mysqli_error($conn);
        }
    } else {
        echo "Nenhum registro enviado para exportar.";
    }
}

?>
