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
        if (!usuario) {
            location.assign('http://192.168.156.150:81')
        }
    </script>

    <title>Intranet - Freelancer</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../Massagem/Sistemas/Sistema Massagem - Adm/img/log.png" type="image/x-icon">

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
        overflow: hidden;
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

    td,
    th,
    tr {
        font-size: 13px;
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

<body style="min-height: 100vh;" id="page-top">

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

            <li class="nav-item text-center">
                <a class="nav-link text-center" onclick="toggleFullScreen()" style="cursor: pointer;">
                    <!-- Adição de cursor pointer -->
                    <i class="fas fa-expand"></i> <!-- Mudança de ícone -->
                    <span>Tela Cheia</span>
                </a>
            </li>

            <hr class="sidebar-divider my-0">

            <li class="nav-item mt-4 text-center">
                <a class="nav-link text-center" href="index.php" style="cursor: pointer;">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashborard</span>
                </a>
            </li>
            <li class="nav-item mt-4 text-center">
                <a class="nav-link text-center" onclick="location.assign('visualizar_cargo.php')" style="cursor: pointer;">
                    <i class="fas fa-briefcase"></i>
                    <span>Visualizar Cargos e setor</span>
                </a>
            </li>

            <script>
                function baixar_csv() {
                    if ($('#data-final').val() != '' && $('#data_inicio').val() != '') {
                        Swal.fire({
                            title: "Baixar dados da Escala?",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: "Baixar",
                            cancelButtonText: "Cancelar",
                            showLoaderOnConfirm: true,
                            preConfirm: function(data) {
                                download('dados_registros_freelancer.csv');
                                return new Promise(function(resolve, reject) {
                                    Swal.fire({
                                        title: "Deseja compartilhar CSV para os Setores?",
                                        text: "Será enviado um E-mail para eles com o CSV em anexo!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        cancelButtonText: "Cancelar",
                                        confirmButtonText: "Sim, Enviar!",
                                        html: '<form id="emailForm">' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="coordenacaoaeb@ccbh.com.br" id="checkCoordenacao" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkCoordenacao" style="font-weight: bold;">coordenacaoaeb@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="administrativo@ccbh.com.br" id="checkAdministrativo" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkAdministrativo" style="font-weight: bold;">administrativo@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="rh@ccbh.com.br" id="checkRH" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkRH" style="font-weight: bold;">rh@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="financeiro@ccbh.com.br" id="checkFinanceiro" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkFinanceiro" style="font-weight: bold;">financeiro@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="restaurante@ccbh.com.br" id="checkRestaurante" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkRestaurante" style="font-weight: bold;">restaurante@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="ti.diego@ccbh.com.br" id="checkRestaurante" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkRestaurante" style="font-weight: bold;">ti.diego@ccbh.com.b</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="sst@ccbh.com.br" id="checkSST" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkSST" style="font-weight: bold;">sst@ccbh.com.br</label>' +
                                            '</div>' +
                                            '<div class="form-check" style="margin-bottom: 10px;">' +
                                            '<input class="form-check-input" type="checkbox" name="emails[]" value="piscina@ccbh.com.br" id="checkPiscina" checked style="margin-right: 5px;">' +
                                            '<label class="form-check-label" for="checkPiscina" style="font-weight: bold;">piscina@ccbh.com.br</label>' +
                                            '</div>' +
                                            '</form>'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Coletar e-mails selecionados
                                            var emailsSelecionados = $('#emailForm').serialize();
                                            $.ajax({
                                                url: 'enviar_csv_email.php',
                                                type: 'POST',
                                                data: emailsSelecionados,
                                                success: function(response) {
                                                    console.log(response);
                                                    resolve(response);
                                                    Swal.fire({
                                                        title: "Sucesso ao Enviar Email!!!",
                                                        text: "Foi enviado o arquivo com a escala para os emails selecionados.",
                                                        icon: "success"
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                    reject(error);
                                                    Swal.fire({
                                                        title: "Erro na solicitação Ajax!",
                                                        text: "Ocorreu um erro ao processar a solicitação. Tente novamente mais tarde.",
                                                        icon: "error"
                                                    });
                                                }
                                            });
                                        }
                                    });
                                });
                            },
                            allowOutsideClick: function() {
                                return !Swal.isLoading();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Preencha os campos de Data!",
                            text: "Preencha todos os campos antes de gerar a importação!",
                            icon: "error"
                        });
                    }
                }

                function baixar_txt() {
                    var nome_freelancer = document.getElementById('nome_freelancer').value;
                    var id_detalhe_registro = document.getElementById('id_detalhe_registro').value;

                    if ($('#data-final').val() != '' && $('#data_inicio').val() != '') {
                        Swal.fire({
                            title: "Informe a data de vencimento",
                            html: '<input class="form-control" id="txtDataVencimento" type="date">',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: "Gerar",
                            cancelButtonText: "Cancelar",
                            // showLoaderOnConfirm: true,
                            preConfirm: function() {
                                return new Promise(function(resolve, reject) {
                                    var dataInicio = $('#data_inicio').val();
                                    var dataFinal = $('#data-final').val();
                                    var setor = $('#setor').val();
                                    var dataVencimento = $('#txtDataVencimento').val(); // Obtém a data do input date

                                    if (!dataVencimento) {
                                        reject('Data de vencimento não informada.');
                                    }

                                    const dataISO = new Date(dataVencimento).toISOString().split('T')[0];
                                    var tipo_importacao = document.getElementById('tipo_importacao').value;

                                    Swal.fire({
                                        title: "Tem certeza que deseja Gerar?",
                                        text: "O status do Registro será de Importado e será enviado uma cópia do TXT para o financeiro!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Sim, gerar!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                url: 'gerar_txt_freelancer.php',
                                                type: 'GET',
                                                data: {
                                                    data_vencimento: dataISO,
                                                    nome_freelancer: nome_freelancer,
                                                    data_inicio: dataInicio,
                                                    tipo_importacao: tipo_importacao,
                                                    id_detalhe_registro: id_detalhe_registro,
                                                    data_fim: dataFinal,
                                                    setor: setor
                                                },
                                                success: function(response) {
                                                    console.log(response);
                                                    resolve(response);

                                                    download('integracao.txt');

                                                    $.ajax({
                                                        url: 'enviar_txt_email.php',
                                                        type: 'POST',
                                                        success: function(response) {
                                                            console.log(response);
                                                            resolve(response);
                                                            Swal.fire({
                                                                title: "Sucesso ao Enviar Email!!!",
                                                                text: "Foi enviado o arquivo com a escala para o email selecionado.",
                                                                icon: "success"
                                                            });
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error(error);
                                                            reject(error);
                                                            Swal.fire({
                                                                title: "Erro na solicitação Ajax!",
                                                                text: "Ocorreu um erro ao processar a solicitação. Tente novamente mais tarde.",
                                                                icon: "error"
                                                            });
                                                        }
                                                    });

                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                    reject(error);
                                                    Swal.fire({
                                                        title: "Erro na solicitação Ajax!",
                                                        text: "Ocorreu um erro ao processar a solicitação. Tente novamente mais tarde.",
                                                        icon: "error"
                                                    });
                                                }
                                            });
                                        }
                                    });
                                });
                            },
                            allowOutsideClick: function() {
                                return !Swal.isLoading();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Preencha os campos de Data!",
                            text: "Preencha todos os campos antes de gerar a importação!",
                            icon: "error"
                        });
                    }
                }


                function download(nome) {
                    fetch('Upload/' + nome).then(async (result) => {
                        const blob = await result.blob();
                        const anchor = window.document.createElement('a');

                        anchor.href = window.URL.createObjectURL(blob);
                        anchor.download = nome;
                        anchor.click();
                        window.URL.revokeObjectURL(anchor.href);
                    });
                }
            </script>
            <li class="nav-item mt-4 text-center">
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

            <li class="nav-item mt-4 text-center">
                <a class="nav-link text-center" onclick="baixar_csv()" style="cursor: pointer;">
                    <i class="fas fa-file-csv"></i>
                    <span>Compartilhar Escala - CSV</span>
                </a>
            </li>

            <li style="cursor:pointer" class="nav-item mt-4 text-center">
                <a class="nav-link text-center" onclick="baixar_txt()">
                    <i class="fas fa-file-code"></i>
                    <span>Gerar TXT para integração WK</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-center">
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

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content bg-info p-4">

                <!-- Topbar -->
                <nav class="navbar bg-sucesso2 navbar-expand topbar mb-4 static-top shadow text-light">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    Bem vindo (a) <ul class="navbar-nav ml-auto">

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

                <script>
                    function apagar_dados_dia() {

                        Swal.fire({
                            title: "Selecione o dia a ser apagado!",
                            text: "Essa ação não pode ser revertida!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                            confirmButtonText: "Apagar",
                            html: '<form id="dataForm">' +
                                '<div class="" style="margin-bottom: 10px;">' +
                                '<input class="form-control" type="date" name="data_apagar_registros" id="data_apagar_registros" style="margin-right: 5px;">' +
                                '</div>' +
                                '</form>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Coletar data selecionada
                                var dataSelecionada = $('#dataForm').serialize();
                                $.ajax({
                                    url: 'apagar_dados_dia.php',
                                    type: 'POST',
                                    data: dataSelecionada,
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Dados apagados com sucesso!",
                                            text: "Os registros para a data selecionada foram apagados.",
                                            icon: "success"
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                        Swal.fire({
                                            title: "Erro ao apagar dados!",
                                            text: "Ocorreu um erro ao tentar apagar os registros. Tente novamente mais tarde.",
                                            icon: "error"
                                        });
                                    }
                                });
                            }
                        });
                    }

                    function apagar_dados_id(){
                        Swal.fire({
                            title: "Selecione a partir de qual ID será apagado!",
                            text: "Essa ação não pode ser revertida!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                            confirmButtonText: "Apagar",
                            html: '<form id="dataForm">' +
                                '<div class="" style="margin-bottom: 10px;">' +
                                '<input class="form-control" type="number" name="id_apagar_registros" id="id_apagar_registros" style="margin-right: 5px;">' +
                                '</div>' +
                                '</form>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Coletar data selecionada
                                var idSelecionado = $('#dataForm').serialize();
                                $.ajax({
                                    url: 'apagar_dados_id.php',
                                    type: 'POST',
                                    data: idSelecionado,
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Dados apagados com sucesso!",
                                            text: "Os registros para a data selecionada foram apagados.",
                                            icon: "success"
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                        Swal.fire({
                                            title: "Erro ao apagar dados!",
                                            text: "Ocorreu um erro ao tentar apagar os registros. Tente novamente mais tarde.",
                                            icon: "error"
                                        });
                                    }
                                });
                            }
                        });
                    
                    }
                </script>

                <div class="container-fluid">
                    <div class="container-fluid rounded pb-4 bg-dark1">
                        <div class="pt-2" style="display: flex; justify-content: end">
                            <button onclick="apagar_dados_dia()" class="btn btn-danger" style="text-transform: uppercase;">Apagar Todos os dados do Dia</button>

                            <button onclick="apagar_dados_id()" class="btn ml-3 btn-danger" style="text-transform: uppercase;">Apagar dados a partir do ID</button>
                        </div>
                        <div class="container-fluid text-center mb-5">
                            <label class="mt-3 text-light" style="font-style:italic" for="data_inicio">Data Inicial</label>
                            <input class="form-control" type="date" name="data_inicio" id="data_inicio" onchange="carregarDados()">
                            <label class="mt-3 text-light" style="font-style:italic" for="data_final">Data Final</label>
                            <input class="form-control" type="date" name="data-final" id="data-final" onchange="carregarDados()">
                            <div class="form-group">

                                <label for="setor" class="mt-3 text-light text-center" style="font-style:italic">Setor</label>

                                <select onchange="carregarDados()" class="text-center form-control" name="setor" id="setor">

                                    <option value=""> -- Selecione um Setor -- </option>
                                    <?php
                                    $server = 'localhost:3308';
                                    $user = 'root';
                                    $pass = '';
                                    $database = 'freelancer';
                                    $port = 3308;
                                    $conn = mysqli_connect($server, $user, $pass, $database, $port);

                                    $query_setor = "SELECT `ID_Setor`, `Nome_Setor` FROM `setor` ORDER BY `Nome_Setor`";
                                    $result_setor = mysqli_query($conn, $query_setor);

                                    if (mysqli_num_rows($result_setor) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_setor)) {
                                            echo "<option value='" . $row["ID_Setor"] . "'>" . $row["Nome_Setor"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="row">


                                <div class="col-4">
                                    <label class="mt-1 text-light" style="font-style:italic" for="nome_freelancer">Nome do Freelancer</label>
                                    <input class="form-control" type="text" placeholder="Opcional..." name="nome_freelancer" id="nome_freelancer" onkeyup="carregarDados()">
                                </div>

                                <div class="col-4">
                                    <label class="mt-1 text-light" style="font-style:italic" for="tipo_importacao">Tipo de Importação (Obrigatório)</label>
                                    <select class="form-control text-center" name="tipo_importacao" id="tipo_importacao" onchange="carregarDados()">
                                        <option value="">-- Selecione um tipo de Importação --</option>
                                        <option value="2">Importado</option>
                                        <option value="1">Não Importado</option>
                                    </select>
                                </div>


                                <div class="col-4">
                                    <label class="mt-1 text-light" style="font-style:italic" for="id_detalhe_registro">ID Registro Detalhe</label>
                                    <input class="form-control" type="text" placeholder="Opcional..." name="id_detalhe_registro" id="id_detalhe_registro" onchange="carregarDados()">
                                </div>
                            </div>

                        </div>

                        <div style="height: 350px; overflow-y:auto; font-size:12px" id="data" class="container-fluid p-4 bg-light rounded">
                        </div>

                    </div>
                </div>
                <!-- Footer -->
            </div>
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

    setTimeout(
        () => {

            <?php

            if (isset($_SESSION['admin']) and $_SESSION['admin'] != '') {
            } elseif (isset($_SESSION['vestiario_masculino']) and $_SESSION['vestiario_masculino'] != '') {

                echo "   $('#servico').val(2)
                        get_value()
                    ";
            } elseif (isset($_SESSION['vestiario_feminino']) and $_SESSION['vestiario_feminino'] != '') {

                echo "   $('#servico').val(1)
                        get_value()
                    ";
            }
            ?>
        }, 50
    )

    function exportar(event) {
        var servico = $('#servico').val();

        var valor = $('#valor').val();
        var data = $('#data').val();
        var vencimento = $('#vencimento').val();
        var cota = $('#cota').val();
        var usuario = $('#usuario').val();
        var carteira = $('#carteira').val();

        if (servico && valor && data && vencimento && usuario) {
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
                        url: 'adicionar.php',
                        data: {
                            servico: servico,
                            valor: valor,
                            data: data,
                            carteirinha: carteira,
                            vencimento: vencimento,
                            cota: cota,
                            usuario: usuario
                        },
                        success: function(response) {
                            console.log(response);

                            Swal.fire({
                                title: "Sucesso!",
                                text: "Dados Inseridos Com Sucesso!",
                                icon: "success"
                            });
                            gerarCupom()

                            $('#servico').val('');
                            $('#valor').val('');
                            $('#data').val('');
                            $('#vencimento').val('');
                            $('#cota').val('');
                            $('#usuario').val('');

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

    $('#data').load('dados_registros_freelancer.php')

    function carregarDados() {
        var data_inicio = document.getElementById('data_inicio').value;
        var data_final = document.getElementById('data-final').value;
        var tipo_importacao = document.getElementById('tipo_importacao').value;


        var nome_freelancer = document.getElementById('nome_freelancer').value;
        var id_detalhe_registro = document.getElementById('id_detalhe_registro').value;
        var setor = document.getElementById('setor').value;

        $('#data').load('dados_registros_freelancer.php?data_inicio=' + data_inicio + '&tipo_importacao=' + tipo_importacao + '&data_fim=' + data_final + '&nome_freelancer=' + nome_freelancer + '&id_detalhe_registro=' + id_detalhe_registro + '&setor=' + setor);

        console.log('dados_registros_freelancer.php?data_inicio=' + data_inicio + '&tipo_importacao=' + tipo_importacao + '&data_fim=' + data_final + '&nome_freelancer=' + nome_freelancer + '&id_detalhe_registro=' + id_detalhe_registro + '&setor=' + setor);
    }

    function gerarCupom() {
        // Obter os dados do cupom
        const nomeProduto = $('#servico').val();
        const preco = $('#valor').val();

        var nomeProduto2;

        if (nomeProduto == 2) {
            nomeProduto2 = 'Massagem Masculina';
        } else {
            nomeProduto2 = 'Massagem Feminina';
        }

        var usuario = $('#usuario').val();
        $.ajax({
            type: 'POST',
            url: 'gerar_cupom.php',
            data: {
                nomeProduto: nomeProduto2,
                preco: preco,
                usuario: usuario,
            },
            success: function(response) {

                console.log(response)

                // var file_path = response;
                // window.open(file_path, '_blank');
            },
            error: function(error) {
                console.error(error);
                alert('Ocorreu um erro ao gerar o cupom.');
            }
        });
    }

    function get_value() {
        var dado = $('#servico').val()

        $.ajax({
            type: 'GET',
            url: 'dados_preco.php',
            data: {
                ID: dado,
            },
            success: function(response) {
                response = response.trim()
                console.log(response);

                $('#valor').val(response + '.00')

            },
            error: function(error) {
                console.error(error);
            }
        });

    }

    function busca() {
        var cota = $('#cota').val(); // Obter o valor digitado pelo usuário

        $.ajax({
            type: 'GET',
            url: 'dados_usuario.php',
            data: {
                cota: cota
            },
            success: function(response) {

                if (response) {
                    $('#usuario').prop('disabled', false);
                    $('#usuario').html(response);
                } else {
                    $('#usuario').html('');
                    $('#usuario').prop('disabled', true);
                }
                console.log(response);

            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function busca_carteira() {
        var carteira = $('#carteira').val(); // Obter o valor digitado pelo usuário

        $.ajax({
            type: 'GET',
            url: 'dados_usuario_carteira.php',
            data: {
                carteira: carteira
            },
            success: function(response) {

                if (response) {
                    $('#usuario').prop('disabled', false);
                    $('#usuario').html(response);
                } else {
                    $('#usuario').html('');
                    $('#usuario').prop('disabled', true);
                }
                console.log(response);

            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    document.getElementById('data').addEventListener('change', function() {
        calcularDataVencimento();
    });

    function calcularDataVencimento() {
        const dataRegistro = new Date(document.getElementById('data').value);
        const dataVencimento = new Date(dataRegistro);
        if (dataRegistro.getDate() >= 20 || dataRegistro.getDate() <= 5) {

            dataVencimento.setMonth(dataVencimento.getMonth() + 2);
            dataVencimento.setDate(4);
        } else {
            // Caso contrário, a data de vencimento será dia 5 do mês seguinte
            dataVencimento.setMonth(dataVencimento.getMonth() + 1);
            dataVencimento.setDate(4);
        }

        // Formata a data de vencimento no formato 'YYYY-MM-DD'
        const formattedDate = dataVencimento.toISOString().split('T')[0];

        document.getElementById('vencimento').value = formattedDate;
    }
</script>