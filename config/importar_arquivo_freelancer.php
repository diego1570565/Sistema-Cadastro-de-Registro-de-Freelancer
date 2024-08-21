<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo'])) {
    // Passo 1: Salvar o arquivo enviado para um local temporário
    $caminhoArquivoTemp = $_FILES['arquivo']['tmp_name'];
    $nomeArquivo = $_FILES['arquivo']['name'];

    // Criar um diretório para extrair o conteúdo do XLSX
    $diretorioExtracao = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('xlsx_', true);
    mkdir($diretorioExtracao);

    // Passo 2: Extrair o arquivo XLSX
    $zip = new ZipArchive;
    if ($zip->open($caminhoArquivoTemp) === TRUE) {
        $zip->extractTo($diretorioExtracao);
        $zip->close();
    } else {
        die('Falha ao abrir o arquivo XLSX.');
    }

    // Passo 3: Ler strings compartilhadas
    $caminhoStringsCompartilhadas = $diretorioExtracao . '/xl/sharedStrings.xml';
    $stringsCompartilhadas = [];
    if (file_exists($caminhoStringsCompartilhadas)) {
        $xml = simplexml_load_file($caminhoStringsCompartilhadas);
        foreach ($xml->si as $si) {
            $stringsCompartilhadas[] = (string) $si->t;
        }
    }

    // Passo 4: Ler a primeira planilha e armazenar os dados em um array
    $caminhoPlanilha = $diretorioExtracao . '/xl/worksheets/sheet1.xml';
    $dados = [];
    $cabecalho = []; // Array para armazenar a linha de cabeçalho

    if (file_exists($caminhoPlanilha)) {
        $xml = simplexml_load_file($caminhoPlanilha);
        $linhas = $xml->sheetData->row;

        // Processar cada linha
        foreach ($linhas as $linha) {
            $dadosLinha = [];
            $pularLinha = false; // Flag para pular datas duplicadas

            // Processar cada célula na linha
            foreach ($linha->c as $celula) {
                $valorCelula = isset($celula->v) ? (string) $celula->v : '';
                if (isset($celula['t']) && $celula['t'] == 's') {
                    $valorCelula = $stringsCompartilhadas[(int)$valorCelula];
                }

                if ($celula['r'] == 'A') {
                    // Extrair e formatar a data
                    $valorLimpo = preg_replace("/[^0-9\/\-]/", "", $valorCelula); // Remover caracteres não numéricos, não barra e não traço
                    if (preg_match('/(\d{1,2})[\/\-](\d{1,2})/', $valorLimpo, $matches)) {
                        $dia = sprintf("%02d", $matches[1]);
                        $mes = sprintf("%02d", $matches[2]);
                        $ano = date('Y'); // Ano atual
                        $dataFormatada = date('Y-m-d', strtotime("$ano-$mes-$dia"));

                        // Verificar intervalo de data duplicado "27/6 -29/6-"
                        if (strpos($valorCelula, '-') !== false && !$pularLinha) {
                            $pularLinha = true;
                        }

                        // Adicionar linha somente se a data for diferente da anterior e não for um intervalo duplicado
                        if ($dataFormatada != @$dataAnterior && !$pularLinha) {
                            $dadosLinha['Data'] = $dataFormatada;
                            $dataAnterior = $dataFormatada;
                        } else {
                            continue;
                        }
                    } else {
                        continue;
                    }
                } else {
                    $dadosLinha[] = $valorCelula;
                }
            }

            // Remover o sexto item (linha vazia) de $dadosLinha se existir
            if (count($dadosLinha) == 7) {
                array_splice($dadosLinha, 6, 1); // Remover o sexto item
            }

            // Capturar a linha de cabeçalho
            if (empty($cabecalho)) {
                $cabecalho = $dadosLinha;
                continue; // Pular o processamento da linha de cabeçalho como linha de dados
            }

            // Adicionar linha aos dados somente se não estiver vazia
            if (!empty(array_filter($dadosLinha))) {
                if (count($cabecalho) == count($dadosLinha)) {
                    // Cortar a string por '-' e manter apenas a parte antes de '-'
                    foreach ($dadosLinha as $chave => $valor) {
                        if (strpos($valor, '-') !== false) {
                            $dadosLinha[$chave] = trim(explode('-', $valor)[0]);
                        }
                    }
                    $dados[] = array_combine($cabecalho, $dadosLinha);
                } else {
                    echo "Número de elementos no cabeçalho e na linha de dados não correspondem. Cabeçalho: " . count($cabecalho) . ", Linha de Dados: " . count($dadosLinha);
                }
            }
        }
    } else {
        echo 'Nenhuma planilha encontrada.';
    }


    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'freelancer';
    $port = 3308;

    // Conexão com MySQLi
    $conexao = new mysqli($server, $user, $pass, $database, $port);

    // Verificação de erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    try {
        // Função para verificar se o cargo existe
        function verificaCargo($conexao, $cargo)
        {
            $cargo = $conexao->real_escape_string($cargo); // Prevenir SQL Injection
            $consulta = "SELECT `ID_Cargo`, `Nome_cargo`, `Valor_Pago`, `Comissao` FROM `cargo` WHERE `Nome_cargo` = '$cargo'";
            $resultado = $conexao->query($consulta);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            } else {
                return false;
            }
        }

        // Função para verificar se o setor existe
        function verificaSetor($conexao, $setor)
        {
            $setor = $conexao->real_escape_string($setor); // Prevenir SQL Injection
            $consulta = "SELECT `ID_Setor`, `codigo_setor`, `status_setor`, `codigo_setor_pai`, `Nome_Setor` FROM `setor` WHERE `Nome_Setor` = '$setor'";
            $resultado = $conexao->query($consulta);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            } else {
                return false;
            }
        }

        // Função para verificar se o freelancer existe e retornar seu ID
        function verificaFreelancer($conexao, $nomeCompleto)
        {
            $nomeCompleto = $conexao->real_escape_string($nomeCompleto); // Prevenir SQL Injection
            $consulta = "SELECT `ID_freelancer` FROM `freelancer` WHERE `Nome_Completo` = '$nomeCompleto'";
            $resultado = $conexao->query($consulta);

            if ($resultado && $resultado->num_rows > 0) {
                $freelancer = $resultado->fetch_assoc();
                return $freelancer['ID_freelancer'];
            } else {
                return false;
            }
        }

        $tudo_certo = true;

   

        foreach ($dados as $linha) {
            $cargo = $linha['Cargo '];
            $setor = $linha['Local '];
            $nomeFreelancer = $linha['Nome '];

            $infoCargo = verificaCargo($conexao, $cargo);
            $infoSetor = verificaSetor($conexao, $setor);
            $ID_freelancer = verificaFreelancer($conexao, $nomeFreelancer);

            if (!$infoCargo || !$infoSetor || !$ID_freelancer) {
                $tudo_certo = false;
                if (!$infoCargo) {
                    echo "Cargo '{$cargo}' não existe. <br>";
                }
                if (!$infoSetor) {
                    echo "Setor '{$setor}' não existe. <br>";
                }
                if (!$ID_freelancer) {
                    echo "Freelancer '{$nomeFreelancer}' não existe. <br>";
                }
            }
        }

        if ($tudo_certo) {
            // Se todos os dados estiverem corretos, proceder com a inserção

            foreach ($dados as $linha) {

                
                $cargo = $linha['Cargo '];
                $setor = $linha['Local '];
                $nomeFreelancer = $linha['Nome '];

                $infoCargo = verificaCargo($conexao, $cargo);
                $infoSetor = verificaSetor($conexao, $setor);
                $ID_freelancer = verificaFreelancer($conexao, $nomeFreelancer);

                // Aqui você pode construir o INSERT adaptando para os seus campos específicos
                if ($infoCargo && $infoSetor && $ID_freelancer) {
                    $queryInsertRegistro = "INSERT INTO `registro` (`Data_Registro`, `ID_Freelancer`, `Nome_freelancer`) 
                    VALUES (NOW() , '$ID_freelancer', '" . $linha['Nome '] . "')";


                    if ($conexao->query($queryInsertRegistro) === TRUE) {
                        $ID_Registro = $conexao->insert_id;

                        // Supondo que $linha['Data'] contenha a data no formato fornecido
                        $data_formatada = date('Y-m-d', strtotime(str_replace('/', '-', $linha['Data '])));


                        $queryInsertDetalhe = "INSERT INTO `registro_detalhe` (`ID_Registro`, `Dia_Trabalhado`, `ID_Cargo`, `Valor_Pago`, `Valor_Adicional`, `ID_Setor`, `Status_importacao`) 
                                               VALUES ('$ID_Registro', '" . $data_formatada . "', '" . $infoCargo['ID_Cargo'] . "', '" . $linha['Valor '] . "', '" . $linha['Comissão '] . "', '" . $infoSetor['ID_Setor'] . "', 0)";

                        if ($conexao->query($queryInsertDetalhe) === TRUE) {
                            // Inserção bem-sucedida
                        } else {
                            echo "Erro ao inserir detalhes: " . $queryInsertDetalhe;
                        }
                    } else {
                        echo "Erro ao inserir registro: " . $queryInsertRegistro;
                    }
                }
            }

            echo "Dados inseridos com sucesso.";
        }
    } catch (Exception $e) {
        echo "Erro ao processar dados: " . $e->getMessage();
    }

    // Fechar conexão
    $conexao->close();

    // Limpar os arquivos extraídos
    array_map('unlink', glob("$diretorioExtracao/*.*"));
    removerDiretorio($diretorioExtracao);
} else {
    echo "Nenhum arquivo enviado.";
}

// Função para remover o diretório recursivamente
function removerDiretorio($dir)
{
    if (!is_dir($dir)) {
        return;
    }

    $arquivos = array_diff(scandir($dir), array('.', '..'));
    foreach ($arquivos as $arquivo) {
        (is_dir("$dir/$arquivo")) ? removerDiretorio("$dir/$arquivo") : unlink("$dir/$arquivo");
    }
    rmdir($dir);
}
