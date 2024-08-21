<?php

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST['nome_completo']) && isset($_POST['cpf']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['data_nascimento']) && isset($_POST['status'])) {
        // Recupera os dados do POST
        $nome_completo = $_POST['nome_completo'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_nascimento = $_POST['data_nascimento'];
        $status = $_POST['status'];

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

        // Prepara a query SQL para inserir os dados na tabela 'freelancer'
        $query = "INSERT INTO `freelancer` (`Nome_Completo`, `CPF`, `Data_Nascimento`, `Status`, `Email`, `Celular`) 
                  VALUES ('$nome_completo', '$cpf', '$data_nascimento', $status, '$email', '$telefone')";

        echo $query;

        // Executa a query
        if (mysqli_query($conn, $query)) {
            // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
            echo "Dados inseridos com sucesso!";
        } else {
            // Em caso de erro na execução da query, exibe uma mensagem de erro
            echo "Erro ao inserir os dados: " . mysqli_error($conn);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        echo "Todos os campos devem ser preenchidos!";
    }
}


