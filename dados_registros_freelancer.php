<?php
$server = 'localhost:3308';
$user = 'root';
$pass = '';
$database = 'freelancer';
$port = 3308;

$conn = mysqli_connect($server, $user, $pass, $database, $port);
mysqli_set_charset($conn, "utf8");

if (!$conn) {
    echo 'Erro na conexão: ' . mysqli_connect_error();
} else {
    // Verifica se existem parâmetros GET para datas de início e fim
    if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
        $data_inicio = $_GET['data_inicio'];
        $data_fim = $_GET['data_fim'];
    } else {
        // Se as datas não estiverem definidas, definir como a data de hoje
        $data_inicio = '';
        $data_fim = '';
    }

    $extra_filter = '';

    $nome_freelancer = '';
    $id_detalhe_registro = '';
    $setor = '';

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


    // Query para buscar os registros filtrados por data de início e fim, com filtro adicional se aplicável
    $query = "SELECT DISTINCT r.ID_Registro, DATE_FORMAT(r.Data_Registro, '%d/%m/%Y') AS Data_Registro_formatada, s.Nome_Setor, rd.Valor_Adicional, f.Nome_Completo, f.CPF, c.Nome_cargo, rd.Valor_Pago, rd.Valor_Adicional , rd.Status_importacao , s.codigo_setor, rd.Dia_Trabalhado, rd.ID_Reg_Detalhe FROM registro AS r, registro_detalhe AS rd, freelancer AS f, cargo AS c, setor AS s 
        WHERE r.Nome_freelancer = f.Nome_Completo AND rd.ID_Cargo = c.ID_Cargo AND rd.ID_Setor = s.ID_Setor AND r.ID_Registro = rd.ID_Registro 
        AND rd.Dia_Trabalhado BETWEEN '$data_inicio' AND '$data_fim' $extra_filter $extra_filter2 $extra_filter3 $extra_filter4 ORDER BY r.ID_Registro, rd.Dia_Trabalhado";


    $result = mysqli_query($conn, $query);

    // Array associativo para armazenar os dados do CSV
    $dados_csv = array();
    // Array associativo para agrupar os valores por nome do freelancer
    $dados_agrupados = array();

    // Exiba os resultados e preencha os dados do CSV

    // Adiciona o cabeçalho ao CSV
    if (mysqli_num_rows($result) > 0) {
        // Array para armazenar os dados a serem escritos no CSV
        $dados_csv = array();

        echo "<div style='font-size 12px; display:flex; justify-content:end'> <button class='btn mt-4 btn-success' onclick='enviar_impressao()'> Imprimir Assinaturas dos Registros </button></div>";
        echo '<table class="table table-bordered table-md table-hover table-striped m-3">';
        echo '<thead class="thead-dark"><tr><th class="text-center align-middle">ID Registro</th><th class="text-center align-middle">Data Trabalhada</th><th class="text-center align-middle">Nome Freelancer</th><th class="text-center align-middle">ID Registro Detalhe</th><th class="text-center align-middle">Dia Trabalhado</th><th class="text-center align-middle">Nome Cargo</th><th class="text-center align-middle">Valor Pago</th><th class="text-center align-middle">Adicional</th><th class="text-center align-middle">Nome Setor</th> <th class="text-center align-middle">Status Importação</th> <th class="text-center align-middle">-</th> <th class="text-center align-middle">-</th><th class="text-center align-middle">-</th></tr></thead>';
        echo '<tbody>';

        $dados_csv[] = array('Nome', 'Local', 'Nome', 'Função', 'Valor', 'Valor Adicional', '');
        // Pula uma linha no CSV
        $dados_csv[] = array('', '', '', '', '', '');

        // Variáveis para controle de mudanças de dia e setor
        $lastDay = '';
        $lastSetor = '';
        $firstRow = true;

        while ($row = mysqli_fetch_assoc($result)) {
            // Verifica se houve mudança de dia
            if ($row["Dia_Trabalhado"] != $lastDay) {
                // Verifica se não é o primeiro registro para inserir linhas extras
                if (!$firstRow) {
                    // Insere duas linhas extras no CSV
                    $dados_csv[] = array('', '', '', '', '', '');
                    $dados_csv[] = array('', '', '', '', '', '');
                } else {
                    $firstRow = false;
                }
                $lastDay = $row["Dia_Trabalhado"];
            }

            echo "<tr>";
            echo "<td class='text-center align-middle'>" . $row["ID_Registro"] . "</td><td class='text-center align-middle'>" .  date('d/m/Y', strtotime($row['Dia_Trabalhado'])) . "</td><td class='text-center align-middle'>" . $row["Nome_Completo"] . "</td><td class='text-center align-middle'>" . $row["ID_Reg_Detalhe"] . "</td><td class='text-center align-middle'>" . $row["Data_Registro_formatada"] . "</td><td class='text-center align-middle'>" . $row["Nome_cargo"] . "</td><td class='text-center align-middle'>R$ " . number_format($row["Valor_Pago"], 2, ',', '.') . "</td><td class='text-center align-middle'>R$ " . number_format($row["Valor_Adicional"], 2, ',', '.') . "</td><td class='text-center align-middle'>" . $row["Nome_Setor"] . "</td>";

            if ($row["Status_importacao"] == 0) {
                echo "<td class='text-center align-middle text-danger'>" . 'Não Importado' . "</td>";
            } else {
                echo "<td class='text-center align-middle text-success'>" . 'Importado' . "</td>";
            }

            echo "<td class='text-center align-middle'><button class='btn btn-danger btn-sm' onclick='excluirRegistro(" . '"' . $row["ID_Reg_Detalhe"] . '"' . ")'>Excluir</button></td>";
            echo "<td class='text-center align-middle'><button class='btn btn-info btn-sm' onclick='atualizarRegistro(" . '"' . $row["ID_Reg_Detalhe"] . '"' . ")'>Adicional</button></td>";
            echo "<td class='text-center align-middle'><button class='btn btn-primary btn-sm' onclick='imprimirRegistro(" . '"' .  $row["ID_Reg_Detalhe"] . '"' . ")'>Imprimir</button></td>";
            echo "</tr>";

            // Adiciona os dados ao array para o CSV
            $dados_csv[] = array(
                "Data" => $row["Dia_Trabalhado"],
                "Local" => $row["Nome_Setor"],
                "Nome" => $row["Nome_Completo"],
                "Função" => $row["Nome_cargo"],
                "Valor" => "R$ " . number_format($row["Valor_Pago"], 2, ',', '.'),
                "Valor Adicional" => "R$ " . number_format($row["Valor_Adicional"], 2, ',', '.')
            );

            // Atualiza a variável $lastSetor apenas se houver mudança de setor
            if ($row["Nome_Setor"] != $lastSetor) {
                $lastSetor = $row["Nome_Setor"];
            }
        }

        echo "</tbody></table>";

        // Criando o arquivo CSV
        $csv_filename = "Upload/dados_registros_freelancer.csv";
        $fp = fopen($csv_filename, 'w');

        // Definindo a codificação UTF-8
        fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM (Byte Order Mark)

        // Escrevendo os dados no arquivo CSV com linhas extras
        foreach ($dados_csv as $linha) {
            fputcsv($fp, $linha, ';');
        }

        fclose($fp);
    } else {
        echo "<p style='text-align:center; height:100% ; display:flex; align-items:center; justify-content:center'> <span> Nenhum registro encontrado.</span> </p>";
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function enviar_impressao() {
        // Obtendo as datas de início e fim do PHP

        <?php

        if (isset($_GET['tipo_importacao'])) {
            $tipo_importacao = $_GET['tipo_importacao'];

            if ($tipo_importacao == '1'){
                $tipo_importacao = '0';
            }
            
            if ($tipo_importacao == '2'){
                $tipo_importacao = '1';
            }
        }

        ?>



        var data_inicio = "<?php echo $data_inicio; ?>";
        var data_fim = "<?php echo $data_fim; ?>";
        var id_detalhe_registro = "<?php echo $id_detalhe_registro ?>";
        var nome_freelancer = "<?php echo $nome_freelancer ?>";
        var tipo_importacao = "<?php echo $tipo_importacao ?>"
        var setor = "<?php echo $setor ?>";

        // Criando um objeto com os dados a serem enviados
        var dados = {
            data_inicio: data_inicio,
            data_fim: data_fim,
            nome_freelancer: nome_freelancer,
            setor: setor,
            tipo_importacao: tipo_importacao,
            id_detalhe_registro: id_detalhe_registro
        };

        console.log(dados)

        // Enviando os dados via AJAX
        $.ajax({
            url: 'gerar_cupom.php',
            type: 'POST',
            data: dados,
            success: function(response) {
                console.log(response)
            },
            error: function(xhr, status, error) {
                alert('Erro ao enviar os dados para gerar_cupom.php');
                console.log(xhr.responseText);
            }
        });
    }

    function excluirRegistro(id) {
        Swal.fire({
            title: "Deseja realmente excluir o Registro?",
            text: "Essa ação não pode ser revertida!",
            icon: "warning",
            showCancelButton: true,
            CancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, excluir!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'excluir.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Deletado!",
                            text: "O Dado da Massagem foi Deletado!.",
                            icon: "success"
                        });
                        setTimeout(
                            () => {
                                carregarDados()
                            }, 2000
                        )
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    }

    function atualizarRegistro(id) {
        Swal.fire({
            title: "Qual o valor adicional?",
            text: "Digite no input abaixo:",
            icon: "question",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, adicionar!",
            html: `
            <input type="number" id="valorInput" class="form-control" placeholder="Digite o valor">
        `
        }).then((result) => {
            if (result.isConfirmed) {
                let valor = document.getElementById('valorInput').value;

                $.ajax({
                    url: 'adicionar_valor.php',
                    type: 'POST',
                    data: {
                        id: id,
                        valor: valor
                    },
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: "Sucesso!",
                            text: "O Dado da Massagem foi atualizado!.",
                            icon: "success"
                        });
                        setTimeout(
                            () => {
                                carregarDados();
                            }, 2000
                        );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    }


    function imprimirRegistro(id) {
        console.log(id)
        Swal.fire({
            title: "Deseja imprimir o Registro?",
            text: "Se sim, Pressione Imprimir!",
            icon: "warning",
            showCancelButton: true,
            CancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Imprimir!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'gerar_cupom_unico.php',
                    type: 'POST',
                    data: {
                        ID: id
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Imprimindo!",
                            text: "Aguarde a impressão ser finalizada!.",
                            icon: "success"
                        });

                        console.log(response)

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    }
</script>