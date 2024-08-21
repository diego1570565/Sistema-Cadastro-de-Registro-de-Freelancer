
    <?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    $server = 'localhost:3308';
    $user = 'root';
    $pass = '';
    $database = 'freelancer';
    $port = 3308;

    $conn = mysqli_connect($server, $user, $pass, $database, $port);

    mysqli_set_charset($conn, "utf8");

    if ($conn) {
    } else {
        echo 'Erro na conexão: ' . mysqli_connect_error();
    }

    // Query para buscar os setor
    $query_setor = "SELECT `ID_Setor`, `Nome_Setor`, `codigo_setor` FROM `setor` ORDER BY `Nome_Setor`";
    $result_setor = mysqli_query($conn, $query_setor);

    // Query para buscar os cargos
    $query_cargos = "SELECT `ID_Cargo`, `Nome_cargo`, `Valor_Pago`, `Comissao` FROM `cargo` ORDER BY `Nome_cargo`";
    $result_cargos = mysqli_query($conn, $query_cargos);

    // Exiba os resultados dos setor
    if (mysqli_num_rows($result_setor) > 0) {
        echo "<h3>SETORES:</h3>";
        echo '<table class="table table-bordered table-md table-hover table-striped mt-3">';
        echo '<thead class="thead-dark"><tr><th>ID Setor</th><th>Código Setor</th><th>Nome do Setor</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result_setor)) {
            echo "<tr><td>" . $row["ID_Setor"] . "</td><td>" . $row["Nome_Setor"] . "</td><td>" . $row["codigo_setor"] . "</td></tr>";
        }
        echo "</tbody></table>";

        // Gerar CSV para os setor
        $csvFile_setor = 'Upload/setor.csv';
        $fileHandler_setor = fopen($csvFile_setor, 'w');
        $header_setor = array("ID_Setor", "Nome_Setor");
        fputcsv($fileHandler_setor, $header_setor);
        mysqli_data_seek($result_setor, 0);
        while ($row = mysqli_fetch_assoc($result_setor)) {
            fputcsv($fileHandler_setor, $row);
        }
        fclose($fileHandler_setor);
    } else {
        echo "<p>Nenhum setor encontrado.</p>";
    }

    // Exiba os resultados dos cargos
    if (mysqli_num_rows($result_cargos) > 0) {
        echo "<h3>CARGOS:</h3>";
        echo '<table class="table table-bordered table-md table-hover table-striped mt-3">';
        echo '<thead class="thead-dark"><tr><th>ID Cargo</th><th>Nome do Cargo</th><th>Valor Pago</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result_cargos)) {
            echo "<tr><td>" . $row["ID_Cargo"] . "</td><td>" . $row["Nome_cargo"] . "</td><td>" . $row["Valor_Pago"] . "</td></tr>";
        }
        echo "</tbody></table>";

        // Gerar CSV para os cargos
        $csvFile_cargos = 'Upload/cargos.csv';
        $fileHandler_cargos = fopen($csvFile_cargos, 'w');
        $header_cargos = array("ID_Cargo", "Nome_cargo", "Valor_Pago", "Comissao");
        fputcsv($fileHandler_cargos, $header_cargos);
        mysqli_data_seek($result_cargos, 0);
        while ($row = mysqli_fetch_assoc($result_cargos)) {
            fputcsv($fileHandler_cargos, $row);
        }
        fclose($fileHandler_cargos);
    } else {
        echo "<p>Nenhum cargo encontrado.</p>";
    }
    ?>