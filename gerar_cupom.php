<?php

$ip = '192.168.156.247';
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se as datas de início e fim foram enviadas
    if (isset($_POST['data_inicio']) && isset($_POST['data_fim'])) {
        $data_inicio = $_POST['data_inicio'];
        $data_fim = $_POST['data_fim'];

        // Conexão com o banco de dados
        $server = 'localhost:3308';
        $user = 'root';
        $pass = '';
        $database = 'freelancer';
        $port = 3308;

        date_default_timezone_set('America/Sao_Paulo');

        // Obtém a data e hora atual
        $data = date('d/m/Y H:i:s');

        $conn = mysqli_connect($server, $user, $pass, $database, $port);
        mysqli_set_charset($conn, "utf8");

        if (!$conn) {
            echo 'Erro na conexão: ' . mysqli_connect_error();
            exit;
        }

        $extra_filter = '';

        if (isset($_POST['nome_freelancer']) && !empty($_POST['nome_freelancer'])) {
            $nome_freelancer = $_POST['nome_freelancer'];
        }

        if (!empty($nome_freelancer)) {
            $extra_filter = " AND f.Nome_Completo LIKE '%$nome_freelancer%' ";
        }

        $extra_filter2 = '';

        if (isset($_POST['id_detalhe_registro']) && !empty($_POST['id_detalhe_registro'])) {
            $id_detalhe_registro = $_POST['id_detalhe_registro'];
        }
        if (!empty($id_detalhe_registro)) {
            $extra_filter2 = " AND rd.ID_Reg_Detalhe = '$id_detalhe_registro' ";
        }
        $extra_filter3 = '';

        if (isset($_POST['setor']) && !empty($_POST['setor'])) {
            $setor = $_POST['setor'];
        }
        if (!empty($setor)) {
            $extra_filter3 = " AND rd.ID_Setor = '$setor' ";
        }

        $extra_filter4 = '';



        $tipo_importacao = $_POST['tipo_importacao'];

        if($tipo_importacao == 0){
            $tipo_importacao = 'nao';
        }

        if($tipo_importacao == 1){
            $tipo_importacao = 'sim';
        }

        if (!empty($tipo_importacao)) {

            if($tipo_importacao == 'nao'){
                $tipo_importacao = 0;
            }
    
            if($tipo_importacao == 'sim'){
                $tipo_importacao = 1;
            }

            $extra_filter4 = " AND rd.Status_importacao = $tipo_importacao ";
        }



        // Query para buscar os registros filtrados por data de início e fim, com filtro adicional se aplicável
        $query = "SELECT DISTINCT r.ID_Registro, rd.Valor_Adicional , DATE_FORMAT(r.Data_Registro, '%d/%m/%Y') AS Data_Registro_formatada, s.Nome_Setor, f.Nome_Completo, f.CPF, c.Nome_cargo, rd.Valor_Pago , rd.Status_importacao , s.codigo_setor, rd.Dia_Trabalhado, rd.ID_Reg_Detalhe
        FROM registro AS r, registro_detalhe AS rd, freelancer AS f, cargo AS c, setor AS s 
        WHERE r.Nome_freelancer = f.Nome_Completo
        AND rd.ID_Cargo = c.ID_Cargo 
        AND rd.ID_Setor = s.ID_Setor 
        AND r.ID_Registro = rd.ID_Registro
        AND rd.Dia_Trabalhado BETWEEN '$data_inicio' AND '$data_fim' $extra_filter $extra_filter2 $extra_filter3 $extra_filter4";
     

        $result = mysqli_query($conn, $query);

        echo $query;

        // Array para armazenar os registros por pessoa
        $registrosPorPessoa = array();

        // Agrupa os registros por pessoa
        while ($row = mysqli_fetch_assoc($result)) {
            $nomePessoa = $row["Nome_Completo"];
            if (!isset($registrosPorPessoa[$nomePessoa])) {
                $registrosPorPessoa[$nomePessoa] = array();
            }
            $registrosPorPessoa[$nomePessoa][] = $row;
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);

        // Verifica se há registros para imprimir
        if (!empty($registrosPorPessoa)) {
           
            foreach ($registrosPorPessoa as $nomePessoa => $registros) {
                // Inicializa o conteúdo do comprovante para essa pessoa
                $txt_content =  "          CLUBE CAMPESTRE BELO HORIZONTE\n\n ";
                $txt_content .= "            CNPJ: 17.257.502/0001-03\n\n";
                $txt_content .= "-------------------------------------------------\n";
                $txt_content .= "               Recibo de Pagamento\n";
                $txt_content .= "-------------------------------------------------\n";
                $txt_content .= "Eu, $nomePessoa,\n";
                $txt_content .= "Recebi do Clube Campestre Belo Horizonte, \n a importancia abaixo especificada, \n referente a prestacao de servico:\n";
                $txt_content .= "-------------------------------------------------\n";

                $valorTotal = 0; // Inicializa o valor total para essa pessoa

                // Itera sobre os comprovantes da pessoa atual
                foreach ($registros as $registro) {

                    $txt_content .= "Cargo: {$registro['Nome_cargo']}\n";
                    $txt_content .= "Setor: {$registro['Nome_Setor']}\n";
                    $txt_content .= "Data Trabalhada: {$registro['Dia_Trabalhado']}\n";
                    $txt_content .= "Valor Pago:R$ {$registro['Valor_Pago']}.00\n";
                    $txt_content .= "Valor Adicional:R$ {$registro['Valor_Adicional']}.00\n\n";

                    // Calcula o valor total para essa pessoa
                    $valorTotal += $registro['Valor_Pago'] + $registro['Valor_Adicional'];
                }

                // Adiciona o valor total e a assinatura

                $txt_content .= "Valor Total:R$ $valorTotal.00\n\n";
                $txt_content .= "-------------------------------------------------\n\n";
                $txt_content .= "_________________________________________________\n";
                $txt_content .= "{$registro['Nome_Completo']}\n";
                $txt_content .= "{$registro['CPF']}\n";

                $txt_content .= "-------------------------------------------------\n\n";
                $txt_content .= "                $data                                ";
                // Chama o script Python com proc_open
                $python_script = "impressao2.py";
                $python_executable = "\"C:\\Python31\\python.exe\"";
                $command = "$python_executable $python_script $ip";
                $descriptorspec = array(
                    0 => array("pipe", "r"),  // stdin do processo Python (entrada)
                    1 => array("pipe", "w"),  // stdout do processo Python (saída)
                    2 => array("pipe", "w")   // stderr do processo Python (saída de erro)
                );
                $process = proc_open($command, $descriptorspec, $pipes);
                if (is_resource($process)) {
                    fwrite($pipes[0], $txt_content);
                    fclose($pipes[0]);
                    $stdout = stream_get_contents($pipes[1]);
                    $stderr = stream_get_contents($pipes[2]);
                    fclose($pipes[1]);
                    fclose($pipes[2]);
                    $return_value = proc_close($process);
                    if ($return_value !== 0) {
                        echo "Erro ao executar o script Python: $return_value\n";
                        echo "Saída de erro do Python:\n";
                        echo $stderr;
                    } else {
                        // Sucesso na execução do script Python
                        echo "Script Python executado com sucesso!\n";
                        echo "Saída do Python:\n";
                        echo $stdout;
                    }
                } else {
                    echo "Erro ao abrir processo para execução do script Python\n";
                }
            }
        } else {
            echo "Nenhum registro encontrado para imprimir.\n";
        }
    } else {
        echo "Datas de início e fim não foram fornecidas.\n";
    }
}
