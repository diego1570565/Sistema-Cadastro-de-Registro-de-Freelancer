<!DOCTYPE html>
<html lang="en">

<?php

session_start();
if (!isset($_SESSION['admin']) and !isset($_SESSION['vestiario_masculino']) and !isset($_SESSION['vestiario_feminino'])) {
    header('location:../index.php?erro');
}

?><style>
    * {
        margin: 0;
        padding: 0;
    }
</style>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

        
<script>
        usuario = sessionStorage.getItem('User')
        if (!usuario){
            location.assign('http://192.168.156.150:81')
        }
    </script>

    <title>Intranet - Massagem</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" href="../Massagem/Sistemas/Sistema Massagem - Adm/img/log.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-xL5EPMSx1+DWaIsAhv3KHTPJ8HN8AOKLnBZ3cz3d4Xj3A1jukbEBbN4kdNBhxK3f8nbyNthMvlqM+/B4DpZuNg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<style>
    .ativo {
        cursor: pointer;
    }

    .inativo {
        cursor: wait;
        background-color: #444141;
    }

    .bg-sucesso {
        background-color: #027017;
    }

    .bg-sucesso2 {
        background-color: #02a724;
    }

    body {
        background-color: #b7d5ac;
        overflow-x: hidden;
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    footer {
        margin-top: auto;
    }

    .bg-verde {
        background-color: #353535
    }

    .input-radio {

        display: flex;
        align-items: center;
        margin: 18px;
        justify-content: space-around;
    }

    .bg-dark1 {
        background-color: #353535;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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
        cursor: pointer;
        margin-top: 70px;
    }
</style>

<body style="min-height: 100vh; overflow: hidden;" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-sucesso sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand m-3 d-flex align-items-center justify-content-center" href="./index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-center">Campestre Intranet</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" onclick="toggleFullScreen()" style="cursor: pointer;"> <!-- Adição de cursor pointer -->
                    <i class="fas fa-expand"></i> <!-- Mudança de ícone -->
                    <span>Tela Cheia</span>
                </a>
            </li>
            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" onclick="location.assign('index.php')" style="cursor: pointer;"> <!-- Adição de cursor pointer -->
                    <i class="fas fa-sync"></i> <!-- Mudança de ícone -->
                    <span>Cadastrar Massagem</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" href="verificar.php" style="cursor: pointer;"> <!-- Adição de cursor pointer -->
                    <i class="fas fa-file-csv"></i> <!-- Mudança de ícone -->
                    <span>Verificar Massagens</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" href="../../../index/" style="cursor: pointer;"> <!-- Adição de cursor pointer -->
                    <i class="fas fa-sign-out-alt"></i> <!-- Mudança de ícone -->
                    <span>Sair</span>
                </a>
            </li>            <script>
                function toggleFullScreen() {
                    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                        if (document.documentElement.requestFullScreen) {
                            document.documentElement.requestFullScreen();
                        } else if (document.documentElement.mozRequestFullScreen) {
                            document.documentElement.mozRequestFullScreen();
                        } else if (document.documentElement.webkitRequestFullScreen) {
                            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                        }
                    } else {
                        if (document.cancelFullScreen) {
                            document.cancelFullScreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitCancelFullScreen) {
                            document.webkitCancelFullScreen();
                        }
                    }
                }
            </script>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content p-4">

                <!-- Topbar -->
                <nav class="navbar bg-sucesso2 navbar-expand topbar mb-4 static-top shadow text-light">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    Bem vindo (a)                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-light" style="text-transform: uppercase;" id="usuario2"></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../perfil.html">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a onclick="sair" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="conteudo container-fluid">
                    <div class="bg-dark text-light container-fluid2">
                        <?php

                        // Verificar a sessão do usuário
                        if (isset($_SESSION['admin']) and $_SESSION['admin'] != '') {

                            $admin = true;
                            $v_masc = false;
                            $v_fem = false;
                        } elseif (isset($_SESSION['vestiario_masculino']) and $_SESSION['vestiario_masculino'] != '') {                            $admin = false;
                            $v_masc = true;
                            $v_fem = false;
                        } elseif (isset($_SESSION['vestiario_feminino']) and $_SESSION['vestiario_feminino'] != '') {                            $admin = false;
                            $v_masc = false;
                            $v_fem = true;
                        } else {

                            header('Location: ../index.php?erro');
                            exit;
                        }                        // URL do script de login
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

                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Selecione "Sair" para encerrar a Sessão</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                <a class="btn btn-primary" onclick="sair()">Sair</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>

<script>
    $('#usuario2').html(
        sessionStorage.getItem('User')
    )

    console.log(
        JSON.parse(sessionStorage.getItem('Permissoes'))
    )

    function sair() {
        localStorage.clear()
        location.assign('../../')
    }

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