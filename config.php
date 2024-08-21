<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integração Massagem</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    strong {
        text-transform: uppercase;
        display: flex;
        flex-direction: row;
    }

    body {
        background-color: #98fb98;
        overflow: hidden;
    }

    .botao-baixar {
        width: 600px;
        padding: 12px;
    }

    .linha {
        display: flex;
        flex-direction: row;
    }

    h4 {
        margin-left: 100px;
    }

    .row {
        background-color: #00ff7f;
        border-bottom: 3px double black;
    }

    td,
    th {
        padding: 5px;
        text-align: center;
    }

    .container-fluid2 {
        height: 1000px;
        overflow-y: auto;
        margin: 5px;
        width: 100%;
        border-radius: 5px;
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    table{
        width: 100%;
    }

    footer {
        margin-top: auto;
    }
    .conteudo{
        display: flex;
        align-items: center;
        height: 100%;
        
        justify-content: center;
    }
</style>

<body>

    <div style="cursor:pointer; font-size: 40px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="w-100 p-4 bg-success text-light bm-5 text-center" onclick="location.assign('index.html')">
        Extrair Arquivo CSV
    </div>    <div class="row p-5">
        <div class="col-md-6 linha">
            <h4><strong>Data de Início: </strong> <?= isset($_POST['inicio']) ? date('d/m/Y', strtotime($_POST['inicio'])) : '' ?></h4>
            <h4><strong>Data Final: </strong> <?= isset($_POST['final']) ? date('d/m/Y', strtotime($_POST['final'])) : '' ?></h4>
            <h4><strong>Data do Vencimento: </strong> <?= isset($_POST['vencimento']) ? date('d/m/Y', strtotime($_POST['vencimento'])) : '' ?></h4>
        </div>
        <div class="col-md-6 h-100 text-end">
            <button onclick="exportar()" class="btn botao-baixar btn-success mt-2">Baixar CSV</button>
        </div>
    </div>

    <div class="conteudo">
        <div class="bg-dark container-fluid2">

            <?php
            $server = 'localhost:3308';
            $user = 'root';
            $pass = '';
            $database = 'massagem';
            $port = 3308;

            $conn = mysqli_connect($server, $user, $pass, $database, $port);

            mysqli_set_charset($conn, "utf8");
            if ($conn) {
            } else {
                echo 'Erro na conexão: ' . mysqli_connect_error();
            }

            if (isset($_POST['inicio']) && isset($_POST['final']) && isset($_POST['vencimento'])) {
                $csvFile = 'Upload/' . $_POST['vencimento'] . '.csv';

                if (!file_exists($csvFile)) {
                    touch($csvFile);
                }

                $fileHandler = fopen($csvFile, 'w');

                $header = array("Título", "Sócio", "Valor", "Data de vencimento", "Produto");
                $header = array_map('utf8_decode', $header);

                fputcsv($fileHandler, $header, ';');

                $data_inicio = $_POST['inicio'];
                $data_fim = $_POST['final'];

                $query = "SELECT * FROM `Registro` WHERE Data BETWEEN '$data_inicio' AND '$data_fim' ORDER BY ID";
                $result = $conn->query($query);

                echo '<table class="table table-bordered table-md table-hover table-dark table-striped mt-3">
            <thead class="thead-danger">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Cota</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>';

                while ($row = $result->fetch_assoc()) {
                    $row = array_map('utf8_encode', $row);

                    echo '<tr>
                <th scope="row">' . $row['ID'] . '</th>
                <td>' . date('d/m/Y', strtotime($row['Data'])) . '</td>
                <td>' . $row['Cota'] . '</td>
                <td>' . $row['Nome'] . '</td>
                <td>' . $row['Valor'] . '</td>
              </tr>';

                    $data = array(
                        $row['ID'],
                        date('d/m/Y', strtotime($row['Data'])),
                        $row['Cota'],
                        $row['Nome'],
                        $row['Valor'],
                    );

                    fputcsv($fileHandler, $data, ';');
                }

                echo '</tbody>
        </table>';

                fclose($fileHandler);
            }
            ?>
        </div>
    </div>
    <footer>
        <div style="font-size: 18px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="w-100 p-2 bg-success text-light bm-5 text-center">
            &copy; ccbh - todos os direitos reservados - 2024
        </div>
    </footer>
</body>

<script>
    function exportar() {
        window.location.href = '<?= 'Upload/' . $_POST['vencimento'] . '.csv' ?>';
    }
</script>

</html>