<?php

// Recebe os dados do POST
$cota = $_GET['cota'];// URL do script de atualização de preço de massagem
$url = 'http://192.168.156.150:81/Massagem/dados_usuario.php';

// Dados a serem enviados via POST
$data = array(
    'cota' => $cota
);

// Inicializa uma nova solicitação CURL
$ch = curl_init();

// Configurações da solicitação CURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a solicitação CURL e armazena a resposta
$response = curl_exec($ch);

// Fecha a solicitação CURL
curl_close($ch);

// Verifica se houve erro na execução da solicitação CURL
if ($response === false) {
    echo "Erro ao tentar fazer atualizar.";
} else {
    echo trim($response);
}

?>
