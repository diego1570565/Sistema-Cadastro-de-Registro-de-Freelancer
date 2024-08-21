<?php

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID e o valor foram enviados
    if (isset($_POST['id']) && isset($_POST['valor'])) {
        // Recupera os dados do POST
        $id = $_POST['id'];
        $valor = $_POST['valor'];

        // Conecta ao banco de dados
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

        // Prepara a query SQL para atualizar o registro na tabela 'registro_detalhe'
        $query = "UPDATE `registro_detalhe` SET `Valor_Adicional`='$valor' WHERE `ID_Reg_Detalhe`=$id";

        // Executa a query
        if (mysqli_query($conn, $query)) {
            // Se a atualização for bem-sucedida, exibe uma mensagem de sucesso
            echo "Registro atualizado com sucesso!";
        } else {
            // Em caso de erro na execução da query, exibe uma mensagem de erro
            echo "Erro ao atualizar o registro: " . mysqli_error($conn);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);
    } else {
        // Se o ID ou o valor estiverem faltando, exibe uma mensagem de erro
        echo "ID e valor devem ser enviados!";
    }
}
?>
