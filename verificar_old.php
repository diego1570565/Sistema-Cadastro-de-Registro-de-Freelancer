
<style>
    body {
        background-color: #b7d5ac;
        overflow-x: hidden;
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    td,
    th {
        text-align: center;
    }

    footer {
        margin-top: auto;
      
    }

    .bg-verde {
        background-color: #353535
    }

    .conteudo {
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }
 
    .container-fluid2 {
        height: 97%;
        overflow-y: auto;
        overflow-x: hidden;
        margin: 5px;
        width: 100%;
        border-radius: 5px;
    }
    
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .menu {
        position: fixed;
        top: 0;
        left: -500px;
        width: 500px;
        height: 100%;
        background-color: #6eaa5e;
        padding: 20px;
        transition: left 0.3s ease;
        z-index: 1001;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        color: #b7d5ac;
    }

    .menu a {
        display: block;
        font-size: 20px;
        color: white;
        text-decoration: none;
        margin-bottom: 15px;
        margin-top: 70px;
    }
</style>

<body>
    <div class="conteudo container-fluid">
        <div class="bg-dark text-light container-fluid2">
            <?php

            // Verificar a sessão do usuário
            if (isset($_SESSION['admin']) and $_SESSION['admin'] != '') {

                $admin = true;
                $v_masc = false;
                $v_fem = false;
            } elseif (isset($_SESSION['vestiario_masculino']) and $_SESSION['vestiario_masculino'] != '') {                $admin = false;
                $v_masc = true;
                $v_fem = false;
            } elseif (isset($_SESSION['vestiario_feminino']) and $_SESSION['vestiario_feminino'] != '') {                $admin = false;
                $v_masc = false;
                $v_fem = true;
            } else {

                header('Location: ../index.php?erro');
                exit;
            }            // URL do script de login
            $url = 'http://192.168.156.150:81/Massagem/verificar.php';

            // Dados a serem enviados via POST
            $data = array('vestiario_feminino' => $v_fem, 'vestiario_masculino' => $v_masc, 'admin' => $admin,);

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

            // Verifica a resposta do login
            if ($response === false) {
                // Erro ao fazer a solicitação CURL
                echo "Erro ao tentar fazer atulizar.";
            } else {
                echo $response;
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

</html>
<script>
    function excluir(id) {
        Swal.fire({
            title: "Deseja realmente excluir a Massagem?",
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
                    url: 'http://192.168.156.150:81/Massagem/excluir.php',
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
                                location.reload()
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

    function reemprimr(nomeProduto, preco, usuario) {
        Swal.fire({
            title: "Deseja Re-imprimir uma ou duas vias?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Uma via",
            cancelButtonText: "Duas vias"
        }).then((result) => {
            if (result.isConfirmed) {

                gerarCupomUnico(nomeProduto, preco, usuario);
                let timerInterval;
                Swal.fire({
                    title: "Sucesso!",
                    text: "Reimprimindo uma via do Cupom!",
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {

                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {

                gerarCupom(nomeProduto, preco, usuario);

                Swal.fire({
                    title: "Sucesso!",
                    text: "Reimprimindo duas vias do Cupom!",
                    icon: "success"
                });                let timerInterval;
                Swal.fire({
                    title: "Sucesso!",
                    text: "Reimprimindo Cupom!",
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {

                });

            }
        });
    }
    function gerarCupom(nomeProduto, preco, usuario) {

        console.log(nomeProduto, preco, usuario)

        $.ajax({
            type: 'POST',
            url: 'gerar_cupom.php',
            data: {
                nomeProduto: nomeProduto,
                preco: preco,
                usuario: usuario,
            },
            success: function(response) {
                console.log(response)
            },
            error: function(error) {
                console.error(error);
                alert('Ocorreu um erro ao gerar o cupom.');
            }
        });
    }

    function gerarCupomUnico(nomeProduto, preco, usuario) {

        console.log(nomeProduto, preco, usuario)

        $.ajax({
            type: 'POST',
            url: 'gerar_cupom_unico.php',
            data: {
                nomeProduto: nomeProduto,
                preco: preco,
                usuario: usuario,
            },
            success: function(response) {
                console.log(response)
            },
            error: function(error) {
                console.error(error);
                alert('Ocorreu um erro ao gerar o cupom.');
            }
        });
    }
</script>