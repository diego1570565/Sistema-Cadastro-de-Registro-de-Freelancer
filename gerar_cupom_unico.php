<?php

$ip = '192.168.156.247';
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
    // Verifica se as datas de início e fim foram enviadas
    if (isset($_POST['ID'])) {
    
        $id = $_POST['ID'];
        echo $id;

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

        // Query para buscar os registros filtrados por data de início e fim
        $query = "SELECT DISTINCT r.ID_Registro, DATE_FORMAT(r.Data_Registro, '%d/%m/%Y') AS Data_Registro_formatada, s.Nome_Setor, rd.Valor_Adicional, f.Nome_Completo, f.CPF, c.Nome_cargo, rd.Valor_Pago , rd.Status_importacao , s.codigo_setor, rd.Dia_Trabalhado, rd.ID_Reg_Detalhe FROM registro AS r, registro_detalhe AS rd, freelancer AS f, cargo AS c, setor AS s 
        WHERE r.Nome_freelancer = f.Nome_Completo AND rd.ID_Cargo = c.ID_Cargo AND rd.ID_Setor = s.ID_Setor AND r.ID_Registro = rd.ID_Registro 
        AND rd.ID_Reg_Detalhe =  '$id'";        echo $query;

        $result = mysqli_query($conn, $query);

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
            // Loop pelos registros de cada pessoa e imprime os comprovantes
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
                // $python_executable = "\"C:\\Users\\Administrador\\AppData\\Local\\Programs\\Python\\Python312\\python.exe\"";
                $python_executable = "\"C:\\Python31\\python.exe\"";

                // C:\Python31\python.exe
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
        echo "ID não foi fornecido.\n";
    }
}
