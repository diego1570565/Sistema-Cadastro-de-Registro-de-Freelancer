<!DOCTYPE html>
<html lang="en">
<script>
    localStorage.removeItem('registros');
</script>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    .bg-sucesso {
        background-color: #027017;
    }

    .bg-sucesso2 {
        background-color: #02a724;
    }

    body {
        background-color: #b7d5ac;
        overflow: hidden;
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
    td, th{
        border-bottom: 1px solid #a6a6a6;
        text-align: center;
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
                <a class="nav-link text-center" onclick="toggleFullScreen()" style="cursor: pointer;"> <!-- Adição de cursor pointer -->
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

            <li class="nav-item mt-4 text-center active">
                <a class="nav-link text-center" onclick="location.assign('cadastro_registro_freelancer.php')" style="cursor: pointer;">
                    <i class="fas fa-user-check"></i>
                    <span>Cadastrar Registro de Freelancer</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-center">
                <a class="nav-link text-center" href="verifica_registro_freelancer.php" style="cursor: pointer;">
                    <i class="fas fa-search"></i>
                    <span>Verificar Registro de Freelancer</span>
                </a>
            </li>

            <li style="cursor:not-allowed;" class="nav-item mt-4 text-center">
                <a class="nav-link text-center" onclick="baixar_csv()">
                    <i class="fas fa-file-csv"></i>
                    <span>Compartilhar Escala - CSV</span>
                </a>
            </li>

            <li style="cursor:not-allowed;" class="nav-item mt-4 text-center">
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

                    Bem vindo (a)

                    <ul class="navbar-nav ml-auto">

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
                <div style="height: 750px; overflow-y:auto;" class="container-fluid">

                    <div class="bg-dark1 rounded p-2">
                        <?php
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

                        // Query para buscar os freelancers
                        $query_freelancers = "SELECT `ID_freelancer`, `Nome_Completo`
                        FROM (
                            SELECT MIN(`ID_freelancer`) AS `ID_freelancer`, `Nome_Completo`
                            FROM `freelancer`
                            GROUP BY `Nome_Completo`
                        ) AS subquery
                        ORDER BY `Nome_Completo`;";
                        $result_freelancers = mysqli_query($conn, $query_freelancers);

                        ?>

                        <div class="d-flex justify-content-end">
                            <label for="arquivo-importacao" id="btn-importar" class="btn">Escolher Arquivo</label>
                            <label onclick="enviar_arquivo_csv_importacao()" id="btn-enviar" class="btn ml-4">Enviar</label>
                            <input type="file" class="d-none" id="arquivo-importacao">
                        </div>



                        <script>
                            setInterval(
                                () => {
                                    var fileInput = $('#arquivo-importacao')[0];

                                    if (fileInput.files.length === 0) {

                                        $('#btn-importar').addClass('btn-warning')
                                        $('#btn-enviar').addClass('btn-secondary')


                                        $('#btn-importar').removeClass('btn-primary')
                                        $('#btn-enviar').removeClass('btn-success')

                                    } else {

                                        $('#btn-importar').removeClass('btn-warning')
                                        $('#btn-enviar').removeClass('btn-secondary')

                                        $('#btn-importar').addClass('btn-primary')
                                        $('#btn-enviar').addClass('btn-success')

                                    }

                                }, 100
                            )

                            function enviar_arquivo_csv_importacao() {

                                var fileInput = $('#arquivo-importacao')[0];
                                if (fileInput.files.length === 0) {


                                    Swal.fire({
                                        title: "Por favor, selecione um arquivo para importar.",
                                        icon: "warning"
                                    });
                                    return;
                                }

                                var formData = new FormData();
                                formData.append('arquivo', fileInput.files[0]);

                                $.ajax({
                                    url: 'config/importar_arquivo_freelancer.php',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {

                                        console.log(response)
                                        if (response == 'Dados inseridos com sucesso.') {

                                            Swal.fire({
                                                title: 'Dados inseridos com sucesso.',
                                                icon: "success"
                                            });

                                        } else {
                                            Swal.fire({
                                                text: response,
                                                icon: "warning"
                                            });
                                        }


                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {

                                        Swal.fire({
                                            title: 'Erro ao enviar o arquivo: ' + textStatus,
                                            icon: "error"
                                        });


                                    }

                                });

                                $('#arquivo-importacao').val('')
                            }
                        </script>


                        <form style="border-radius: 20px;" class="formulario bg-dark1 p-4" id="myForm1" method="post">
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="freelancer" class="text-center">Freelancer</label>
                                    <!-- Substituindo o select por um input e um datalist -->
                                    <input type="text" class="text-center form-control" name="freelancer" id="freelancer" list="freelancers_list" required>
                                    <datalist id="freelancers_list">
                                        <?php
                                        if (mysqli_num_rows($result_freelancers) > 0) {
                                            while ($row = mysqli_fetch_assoc($result_freelancers)) {
                                                echo "<option value='" . $row["Nome_Completo"] . "'>" . $row["Nome_Completo"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </datalist>
                                </div>


                                <div class="col-4">

                                    <div class="form-group">
                                        <label for="setor" class="text-center">Setor</label>
                                        <input class="text-center form-control" type="text" name="setor" id="setor" list="setores_list" required>
                                        <datalist id="setores_list">
                                            <?php
                                            // Query para buscar os setores
                                            $query_setor = "SELECT `ID_Setor`, `Nome_Setor` FROM `setor` ORDER BY `Nome_Setor`";
                                            $result_setor = mysqli_query($conn, $query_setor);

                                            if (mysqli_num_rows($result_setor) > 0) {
                                                while ($row = mysqli_fetch_assoc($result_setor)) {
                                                    echo "<option value='" . $row["ID_Setor"] . "'>" . $row["Nome_Setor"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </datalist>
                                    </div>

                                </div>



                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="dia_trabalhado" class="text-center">Dia Trabalhado</label>
                                        <input class="form-control" type="date" name="dia_trabalhado" id="dia_trabalhado" required>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form style="border-radius: 20px;" class="formulario  mb-5 bg-dark1 p-4" id="myForm2" method="post">
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cargo" class="text-center">Cargo</label>
                                        <input class="text-center form-control" type="text" onchange="buscar_valor()" name="cargo" id="cargo" list="cargos_list" required>
                                        <datalist id="cargos_list">
                                            <?php
                                            // Query para buscar os cargos
                                            $query_cargos = "SELECT `ID_Cargo`, `Nome_cargo` FROM `cargo` ORDER BY `Nome_cargo`";
                                            $result_cargos = mysqli_query($conn, $query_cargos);

                                            if (mysqli_num_rows($result_cargos) > 0) {
                                                while ($row = mysqli_fetch_assoc($result_cargos)) {
                                                    echo "<option value='" . $row["ID_Cargo"] . "'>" . $row["Nome_cargo"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="valor_pago" class="text-center">Valor Pago</label>
                                        <input class="form-control" type="text" placeholder="R$ 0.00" name="valor_pago" id="valor_pago" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="valor_adicional" class="text-center">Valor Adicional</label>
                                        <input class="form-control" type="number" step="0.01" min="0" value="0" placeholder="0.00" name="valor_adicional" id="valor_adicional">
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="salvar()" class="btn btn-warning btn-block">Adicionar Freelancer</button>
                        </form>
                        <script>
                            function salvar() {
                                // Verifica se todos os campos estão preenchidos
                                var freelancer = document.getElementById('freelancer').value;
                                var dia_trabalhado = document.getElementById('dia_trabalhado').value;
                                var cargo = document.getElementById('cargo').value;
                                var valor_pago = document.getElementById('valor_pago').value;
                                var valor_adicional = document.getElementById('valor_adicional').value;
                                var setor = document.getElementById('setor').value;

                                if (!freelancer || !dia_trabalhado || !cargo || !valor_pago || !valor_adicional || !setor) {
                                    // Exibe um alerta utilizando o SweetAlert se algum campo estiver vazio
                                    Swal.fire({
                                        title: "Por favor",
                                        text: "Preencha todos os campos.",
                                        icon: "error"
                                    });
                                    return; // Impede que a função continue se algum campo estiver vazio
                                }

                                // Cria um objeto com os dados do formulário
                                var dados = {
                                    freelancer: freelancer,
                                    dia_trabalhado: dia_trabalhado,
                                    cargo: cargo,
                                    valor_pago: valor_pago,
                                    valor_adicional: valor_adicional,
                                    setor: setor
                                };

                                // Verifica se já existem dados salvos no localStorage
                                var registros = JSON.parse(localStorage.getItem('registros')) || [];

                                // Adiciona o novo registro ao array de registros
                                registros.push(dados);

                                // Salva o array de registros atualizado no localStorage
                                localStorage.setItem('registros', JSON.stringify(registros));

                                // Limpa os campos do formulário
                                $('#dia_trabalhado').val('');
                                console.log('Registro salvo:', dados);
                            }
                        </script>
                        <div style="min-height: 300px;" class="bg-light">
                            <table id="myTable" style=" border-bottom: none; border-top: none; overflow-y: auto;" class="table table-striped bg-light formulario mt-3 mb-5 p-4">
                                <thead class="thead-dark" style="border-bottom: none; border-top: none;">
                                    <tr style="border-bottom: none; border-top: none;">

                                        <th style="border-bottom: none; border-top: none;">Dia Trabalhado</th>
                                        <th style="border-bottom: none; border-top: none;">Cargo</th>
                                        <th style="border-bottom: none; border-top: none;">Valor Pago</th>
                                        <th style="border-bottom: none; border-top: none;">Valor Adicional</th>
                                        <th style="border-bottom: none; border-top: none;">Setor</th>
                                        <th style="border-bottom: none; border-top: none;">Ação</th> <!-- Nova coluna para ação -->
                                    </tr>
                                </thead>
                                <tbody id="body3" >

                                </tbody>
                            </table>
                        </div>
                        <button onclick="exportar()" class="btn btn-success btn-block my-5">
                            Adicionar
                        </button>

                        <script>
                            // Função para verificar e exibir os registros do localStorage na tabela
                            function exibirRegistros() {
                                // Verifica se há dados salvos no localStorage
                                var registros = JSON.parse(localStorage.getItem('registros'));
                                if (registros && registros.length > 0) {
                                    // Limpa o conteúdo atual da tabela
                                    $('#body3').empty();
                                    // Adiciona cada registro à tabela
                                    registros.forEach(function(registro) {
                                        $('#body3').append('<tr><td class="text-center">' + registro.dia_trabalhado + '</td><td class="text-center">' + registro.cargo + '</td><td class="text-center">' + registro.valor_pago + '</td><td class="text-center">' + registro.valor_adicional + '</td><td class="text-center">' + registro.setor + '</td><td class="text-center"><button class="btn btn-danger btn-sm" onclick="apagarRegistro(\'' + registro.dia_trabalhado + '\')">Apagar</button></td></tr>');
                                    });
                                } else {
                                    // Adiciona a linha "Sem registro" se não houver registros
                                    $('#body3').html('<tr><td colspan="7" style="height: 300px; text-align: center; vertical-align: middle;">Sem registro</td></tr>');
                                }
                            }

                            // Função para apagar um registro do localStorage
                            function apagarRegistro(dia_trabalhado) {
                                // Obtém os registros do localStorage
                                var registros = JSON.parse(localStorage.getItem('registros'));
                                // Encontra o índice do registro correspondente ao dia_trabalhado especificado
                                var index = registros.findIndex(function(registro) {
                                    return registro.dia_trabalhado === dia_trabalhado;
                                });
                                // Remove o registro correspondente do array de registros
                                registros.splice(index, 1);
                                // Atualiza os registros no localStorage
                                localStorage.setItem('registros', JSON.stringify(registros));
                                // Exibe os registros atualizados na tabela
                                exibirRegistros();
                            }

                            // Chama a função para exibir os registros quando a página carregar
                            $(document).ready(function() {
                                exibirRegistros();
                            });

                            // Define um intervalo para verificar e exibir os registros a cada 5 segundos
                            setInterval(function() {
                                exibirRegistros();
                            }, 500); // 500 milissegundos = 0.5 segundos
                        </script>
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
    } // Função para verificar o campo 'cargo' e buscar o valor correspondente
    function buscar_valor() {
        var cargo = $('#cargo').val();
        if (cargo !== '') {
            console.log(cargo)
            $.ajax({
                url: 'buscar_valor.php',
                method: 'GET',
                data: {
                    id: cargo
                },
                success: function(response) {
                    // Atualiza o campo 'valor_pago' com o valor obtido da resposta
                    $('#valor_pago').val(response + '.00');
                },
                error: function(xhr, status, error) {
                    // Em caso de erro, exibe uma mensagem de erro no console
                    console.error('Erro ao buscar valor:', status, error);
                }
            });
        } else {
            $('#valor_pago').val('');
        }
    }

    function exportar(event) {
        var registros = JSON.parse(localStorage.getItem('registros')) || [];

        if (registros.length > 0) {
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
                            registros: JSON.stringify(registros)
                        },
                        success: function(response) {
                            console.log(response);

                            Swal.fire({
                                title: "Sucesso!",
                                text: "Dados Inseridos Com Sucesso!",
                                icon: "success"
                            });

                            setTimeout(
                                () => {
                                    // location.reload()
                                }, 1500
                            )
                            // Limpa o armazenamento local
                            localStorage.removeItem('registros');

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
                text: "Não há registros para exportar.",
                icon: "error"
            });
        }
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