<?php
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

try {
    $conn = mysqli_connect($server, $user, $pass, $database, $port);
    mysqli_set_charset($conn, "utf8");

    $data_vencimento = $_GET['data_vencimento'];

    if (!$conn) {
        echo 'Erro na conexão: ' . mysqli_connect_error();
    } else {
   

        // Verifica se existem parâmetros GET para datas de início e fim
        if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
            $data_inicio = $_GET['data_inicio'];
            $data_fim = $_GET['data_fim'];
        } else {
            $data_inicio = date('Y-m-d');
            $data_fim = date('Y-m-d');
        }

        $extra_filter = '';

        if (isset($_GET['nome_freelancer']) && !empty($_GET['nome_freelancer'])) {
            $nome_freelancer = $_GET['nome_freelancer'];
        }

        if (!empty($nome_freelancer)) {
            $extra_filter = " AND f.Nome_Completo LIKE '%$nome_freelancer%' ";
        }
        $extra_filter2 = '';

        if (isset($_GET['id_detalhe_registro']) && !empty($_GET['id_detalhe_registro'])) {
            $id_detalhe_registro = $_GET['id_detalhe_registro'];
        }

        if (!empty($id_detalhe_registro)) {
            $extra_filter2 = " AND rd.ID_Reg_Detalhe = '$id_detalhe_registro' ";
        }


        $extra_filter3 = '';

        if (isset($_GET['setor']) && !empty($_GET['setor'])) {
            $setor = $_GET['setor'];
        }
        if (!empty($setor)) {
            $extra_filter3 = " AND rd.ID_Setor = '$setor' ";
        }

        $extra_filter4 = '';


        if (isset($_GET['tipo_importacao']) && !empty($_GET['tipo_importacao'])) {

            $tipo_importacao = $_GET['tipo_importacao'];
        }

        if (!empty($tipo_importacao)) {

            if ($tipo_importacao == 1) {
                $tipo_importacao = 0;
            }
            if ($tipo_importacao == 2) {
                $tipo_importacao = 1;
            }
            $extra_filter4 = " AND rd.Status_importacao = $tipo_importacao ";
        }


        $query = "SELECT DISTINCT r.ID_Registro, DATE_FORMAT(r.Data_Registro, '%d/%m/%Y') AS Data_Registro_formatada, s.Nome_Setor, f.Nome_Completo, f.CPF, c.Nome_cargo, rd.Valor_Pago , rd.Valor_Adicional,  rd.Status_importacao , s.codigo_setor, rd.Dia_Trabalhado, rd.ID_Reg_Detalhe
        FROM registro AS r, registro_detalhe AS rd, freelancer AS f, cargo AS c, setor AS s 
        WHERE r.Nome_freelancer = f.Nome_Completo
        AND rd.ID_Cargo = c.ID_Cargo 
        AND rd.ID_Setor = s.ID_Setor 
        AND r.ID_Registro = rd.ID_Registro
        AND rd.Dia_Trabalhado BETWEEN '$data_inicio' AND '$data_fim' $extra_filter $extra_filter2 $extra_filter3 $extra_filter4";

        $result = mysqli_query($conn, $query);

        $txtContent = ""; // Inicializa o conteúdo do TXT
        $dados_agrupados = array(); // Array para armazenar os dados agrupados por CPF

        // Exiba os resultados e preencha os dados do TXT
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $cpf = $row["CPF"];
                // Verifica se o CPF já está no array de dados agrupados
                if (!isset($dados_agrupados[$cpf])) {
                    // Se não estiver, inicializa os dados para esse CPF
                    $dados_agrupados[$cpf] = array(
                        "CPF" => $cpf,
                        "codigo_setor" => $row['codigo_setor'],
                        "Nome_Completo" => $row["Nome_Completo"],
                        "Valor_Total" => 0, // Inicializa o valor total como zero
                        "Valor_Adicional_Total" => 0 // Inicializa o valor adicional total como zero
                    );
                }
                // Incrementa o valor total do CPF com o valor do registro atual
                $dados_agrupados[$cpf]["Valor_Total"] += $row["Valor_Pago"];
                // Incrementa o valor adicional total do CPF com o valor adicional do registro atual
                $dados_agrupados[$cpf]["Valor_Adicional_Total"] += $row["Valor_Adicional"];

        
            }



            // Preenche o conteúdo do TXT com os dados agrupados
            foreach ($dados_agrupados as $cpf => $dados) {
                $data_vencimento_formatada = date('d/m/Y', strtotime($data_vencimento));
                $valor_total = $dados["Valor_Total"] + $dados["Valor_Adicional_Total"]; // Soma o valor total com o valor adicional total

                $txtContent .= "T1|{$cpf}|{$data_vencimento_formatada}|{$data_vencimento_formatada}|" . uniqid(false) . "|777|019|" . number_format($valor_total, 2, ',', '.') . "|N|CPA-998|299\r\n";
                $txtContent .= "C3229010|" . number_format($valor_total, 2, ',', '.') . "\r\n";
                $txtContent .= "G{$dados["codigo_setor"]}|" . number_format($valor_total, 2, ',', '.') . "\r\n";
                $txtContent .= "GP999|" . number_format($valor_total, 2, ',', '.') . "\r\n";
            }

            // Escrevendo no arquivo integracao.txt
            $file = fopen("Upload/integracao.txt", "w");
            fwrite($file, $txtContent);
            fclose($file);

            // Imprime os dados agrupados com o valor total de cada CPF
            // foreach ($dados_agrupados as $cpf => $dados) {
            //     echo "CPF: {$cpf}, Nome: {$dados["Nome_Completo"]}, Valor Total: " . number_format($dados["Valor_Total"], 2, ',', '.') . "<br>";
            // }

        
            if (!empty($id_detalhe_registro)) {
                $extra_filter2 = " AND ID_Reg_Detalhe = '$id_detalhe_registro' ";
            }

            $extra_filter3 = '';

            if (isset($_GET['setor']) && !empty($_GET['setor'])) {
                $setor = $_GET['setor'];
            }
            
            if (!empty($setor)) {
                $extra_filter3 = " AND ID_Setor = '$setor' ";
            }

            $updateQuery = "UPDATE registro_detalhe SET Status_importacao = 1 WHERE Dia_Trabalhado BETWEEN '$data_inicio' AND '$data_fim' $extra_filter $extra_filter2 $extra_filter3";

            echo "Executing query: " . $updateQuery . "<br>";
            
            if (mysqli_query($conn, $updateQuery)) {
                echo "Query executed successfully.";
            } else {
                echo "Error executing query: " . mysqli_error($conn) . "<br>";
                echo "Query: " . $updateQuery . "<br>";
            }
            
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }

        mysqli_close($conn);
    }
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
