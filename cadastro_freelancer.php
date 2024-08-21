<!DOCTYPE html>
<html lang="en">

<style>
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

    <title>Intranet - Freelancer</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="../Massagem/Sistemas/Sistema Massagem - Adm/img/log.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<style>
    .ativo {
        cursor: pointer;
    }

    .inativo {
        cursor: wait;
        background-color: #444141;
    }

    .container {
        width: 80vw;
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
            <a style="flex-direction: column;" class="sidebar-brand m-3 d-flex align-items-center justify-content-center" href="./index.php">
                <img src="../img/logo2.png" style="height: 50px; width:75px" alt="">
                <div class="sidebar-brand-text mx-3 my-1 text-center">Intranet</div>
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
                <a class="nav-link text-center" onclick="location.assign('visualizar_cargo.php')" style="cursor: pointer;">
                    <i class="fas fa-briefcase"></i>
                    <span>Visualizar Cargos e setor</span>
                </a>
            </li>

      <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" onclick="location.assign('cadastro_registro_freelancer.php')" style="cursor: pointer;">
                    <i class="fas fa-user-check"></i>
                    <span>Cadastrar Registro de Freelancer</span>
                </a>
            </li>
            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" href="verifica_registro_freelancer.php" style="cursor: pointer;">
                    <i class="fas fa-search"></i>
                    <span>Verificar Registro de Freelancer</span>
                </a>
            </li>
            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" href="../../../index/" style="cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </a>
            </li>
            <script>
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

            <script>
                // Máscara para CPF
                function mascaraCPF(cpf) {
                    cpf.value = cpf.value.replace(/\D/g, ''); // Remove tudo o que não é dígito
                    cpf.value = cpf.value.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca ponto entre o terceiro e o quarto dígitos
                    cpf.value = cpf.value.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca ponto entre o sexto e o sétimo dígitos
                    cpf.value = cpf.value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Coloca hífen entre o nono e o décimo dígitos
                }

                // Máscara para telefone
                function mascaraTelefone(telefone) {
                    telefone.value = telefone.value.replace(/\D/g, ''); // Remove tudo o que não é dígito
                    telefone.value = telefone.value.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca parênteses em volta dos dois primeiros dígitos
                    telefone.value = telefone.value.replace(/(\d)(\d{4})$/, '$1-$2'); // Coloca hífen entre o quarto e o quinto dígitos
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
                <div class="container-fluid">

                    <div class="container">
                        <form style="border-radius: 20px;" class="formulario mt-5 mb-5 bg-dark1 p-4" id="myForm" action="adicionar.php" method="post">
                            <div class="text-center mb-4">
                                <img src="img/logo.png" alt="Logo" class="img-fluid">
                            </div>

                            <div class="form-group">
                                <label for="nome_completo" class="text-center">Nome Completo</label>
                                <input class="form-control" type="text" name="nome_completo" placeholder="ex: José Luiz Peioxoto de Almeida" id="nome_completo" required>
                            </div>

                            <div class="form-group">
                                <label for="cpf" class="text-center">CPF</label>
                                <input class="form-control" onkeydown="mascaraCPF(this)" placeholder="ex: 123.456.789-00" type="text" name="cpf" id="cpf" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="text-center">Email</label>
                                <input class="form-control" type="text" placeholder="ex: Jose@gmail.com.br" name="email" id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone" class="text-center">Telefone</label>
                                <input class="form-control" onkeydown="mascaraTelefone(this)" type="text" placeholder="ex: (31) 99999-9999" name="telefone" id="telefone" required>
                            </div>                            <div class="form-group">
                                <label for="data_nascimento" class="text-center">Data de Nascimento</label>
                                <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" required>
                            </div>

                            <div class="form-group">
                                <label for="status" class="text-center">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>

                            <button onclick="exportar()" class="btn btn-warning btn-block">Adicionar Freelancer</button>
                        </form>

                    </div>                    <!-- Footer -->                </div>
                <!-- End of Content Wrapper -->

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
    function sair() {
        localStorage.clear()
        location.assign('../../')
    }
    function exportar() {
        event.preventDefault()
        var nome_completo = $('#nome_completo').val();
        var cpf = $('#cpf').val();
        var email = $('#email').val();
        var telefone = $('#telefone').val();
        var data_nascimento = $('#data_nascimento').val();
        var status = $('#status').val();

        // Obtém a data atual no formato desejado
        var data_atual = new Date().toLocaleDateString('pt-BR', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        if (nome_completo && cpf && email && telefone && data_nascimento && status) {
            let timerInterval;
            Swal.fire({
                title: "Inserindo Dados!",
                timer: 1500,
                icon: "success",
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
                if (result.dismiss === Swal.DismissReason.timer) {
                    $.ajax({
                        type: 'POST',
                        url: 'adicionar_freelancer.php',
                        data: {
                            nome_completo: nome_completo,
                            cpf: cpf,
                            email: email,
                            telefone: telefone,
                            data_nascimento: data_nascimento,
                            status: status
                        },
                        success: function(response) {
                            console.log(response);

                            Swal.fire({
                                title: "Sucesso!",
                                text: "Dados Inseridos Com Sucesso!",
                                icon: "success"
                            });

                            // Adicione aqui a função para gerar o cupom
                            // gerarCupom()

                            $('#nome_completo').val('');
                            $('#cpf').val('');
                            $('#email').val('');
                            $('#telefone').val('');
                            $('#data_nascimento').val('');
                            $('#status').val('');

                        },
                        error: function(error) {
                            console.error(error);
                            Swal.fire({
                                title: "Erro!",
                                text: "Ocorreu um erro ao inserir os dados.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        } else {
            event.preventDefault();
            Swal.fire({
                title: "Por favor",
                text: "Preencha todos os campos.",
                icon: "error"
            });
        }
    }
</script>

</script>