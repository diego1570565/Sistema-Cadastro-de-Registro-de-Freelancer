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
        font-size: 9px;
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
            </a> <!-- Divider -->

            <hr class="sidebar-divider my-0">

            <li class="nav-item text-center active">
                <a class="nav-link text-center" onclick="toggleFullScreen()" style="cursor: pointer;">
                    <!-- Adição de cursor pointer -->
                    <i class="fas fa-expand"></i> <!-- Mudança de ícone -->
                    <span>Tela Cheia</span>
                </a>
            </li>

            <hr class="sidebar-divider my-0">

            <li class="nav-item mt-4 text-center active">
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



            <li class="nav-item mt-4 text-center">
                <a class="nav-link text-center" onclick="location.assign('cadastro_registro_freelancer.php')" style="cursor: pointer;">
                    <i class="fas fa-user-check"></i>
                    <span>Cadastrar Registro de Freelancer</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-center ">
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

                <div class="container-fluid">

                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Sistema de Freelancer</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-4 col-md-4">
                            <div class="card bg-sucesso text-white mb-4">
                                <div class="card-body">Registros dos Ultimos 90 dias</div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4">
                            <div class="card bg-sucesso text-white mb-4">
                                <div class="card-body">Registros dos Ultimos 90 dias</div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4">
                            <div class="card bg-sucesso text-white mb-4">
                                <div class="card-body">Relação Funcionario / Setor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div style="height: 450px; cursor:pointer" class="col-xl-4  my-4">
                            <div class="card h-100 shadow bg-light mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-center text-primary">Registro dos Valores dos Dias Trabalhados nos Ultimos 90 dias</h6>
                                </div>
                                <div class="card-header py-3 d-flex flex-row  align-items-center justify-content-between">
                                    <div class="col-6"><input type="date" onchange="fetchSecondChartData()" class="form-control" name="data_valores_inicial" id="data_valores_inicial"></div>
                                    <div class="col-6"><input type="date" onchange="fetchSecondChartData()" class="form-control" name="data_valores_final" id="data_valores_final"></div>
                                </div>
                                <div style="display: flex; align-items:center; justify-content:center;" onclick="mostrar_dados_valores_90()" class="card-body"><canvas id="myBarChart2" width="100%" height="40"></canvas></div>
                            </div>
                        </div>

                        <script>
                            function mostrar_dados_valores_90() {

                                const data_inicial = $('#data_valores_inicial').val();
                                const data_final = $('#data_valores_final').val();


                                $.ajax({
                                    type: 'POST',
                                    url: 'config/dados_alerta_valores.php', // URL do seu script PHP para buscar dados
                                    data: {
                                        data_inicial: data_inicial,
                                        data_final: data_final
                                    },
                                    success: function(response) {

                                        var resposta = JSON.parse(response);
                                        let endTime = resposta.total_90_dias

                                        let timerInterval;
                                        let startTime = 0; // Tempo inicial (em milissegundos)
                                        let increment = (endTime - startTime) / 20; // Incremento para alcançar o tempo final

                                        Swal.fire({
                                            icon: 'info',
                                            title: "Valor Pago aos Freelancers !",
                                            html: "Calculando... <b></b>",
                                            timer: endTime, // Set the timer to the end time
                                            didOpen: () => {
                                                Swal.showLoading();
                                                const timer = Swal.getPopup().querySelector("b");
                                                let currentValue = startTime;
                                                timerInterval = setInterval(() => {
                                                    currentValue += increment;
                                                    if (currentValue >= endTime) {
                                                        currentValue = endTime;
                                                        Swal.stopTimer(); // Stop the timer
                                                        Swal.hideLoading(); // Hide the loading indicator
                                                        clearInterval(timerInterval); // Clear the interval
                                                        Swal.update({
                                                            html: "Valor Total <b>R$ " + number_format(Math.round(currentValue), 2, ',', '.') + " ! </b> "
                                                        });
                                                    }
                                                    timer.textContent = `${Math.round(currentValue)}`;
                                                }, 100);
                                            },
                                            willClose: () => {
                                                clearInterval(timerInterval);
                                            }
                                        }).then((result) => {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                console.log("I was closed by the timer");
                                            }
                                        });


                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });
                            }

                            function mostrar_dados_freelancer_90() {
                                const data_inicial = $('#data_freelancer_inicial').val();
                                const data_final = $('#data_freelancer_final').val();

                                console.log(data_inicial)
                                console.log(data_final)
                                $.ajax({
                                    type: 'POST',
                                    url: 'config/dados_alerta_freelancer.php', // URL do seu script PHP para buscar dados
                                    data: {
                                        data_inicial: data_inicial,
                                        data_final: data_final
                                    },
                                    success: function(response) {
                                        console.log(response)
                                        var resposta = JSON.parse(response);

                                        let endTime = resposta.SOMA
                                        let timerInterval;
                                        let startTime = 0; // Tempo inicial (em milissegundos)

                                        let increment = (endTime - startTime) / 1; // Incremento para alcançar o tempo final

                                        Swal.fire({
                                            icon: 'info',
                                            title: "Total de Freelancers !",
                                            html: "Calculando... <b></b>",
                                            timer: endTime, // Set the timer to the end time
                                            didOpen: () => {
                                                Swal.showLoading();
                                                const timer = Swal.getPopup().querySelector("b");
                                                let currentValue = startTime;
                                                timerInterval = setInterval(() => {
                                                    currentValue += increment;
                                                    if (currentValue >= endTime) {
                                                        currentValue = endTime;
                                                        Swal.stopTimer(); // Stop the timer
                                                        Swal.hideLoading(); // Hide the loading indicator
                                                        clearInterval(timerInterval); // Clear the interval
                                                        Swal.update({
                                                            html: "Total de Freelancers <b>" + Math.round(currentValue) + " ! </b>"
                                                        });
                                                    }
                                                    timer.textContent = `${Math.round(currentValue)}`;
                                                }, 100);
                                            },
                                            willClose: () => {
                                                clearInterval(timerInterval);
                                            }
                                        }).then((result) => {

                                        });

                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });



                            }
                        </script>

                        <div style="height: 450px; cursor:pointer" class="col-xl-4  my-4">
                            <div class="card h-100 shadow bg-light mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-center text-primary">Registro dos Freeelancers por Dia Trabalhado nos Ultimos 90 dias</h6>
                                </div>

                                <div class="card-header py-3 d-flex flex-row  align-items-center justify-content-between">
                                    <div class="col-6"><input type="date" onchange="fetchThirdChartData()" class="form-control" name="data_freelancer_inicial" id="data_freelancer_inicial"></div>
                                    <div class="col-6"><input type="date" onchange="fetchThirdChartData()" class="form-control" name="data_freelancer_final" id="data_freelancer_final"></div>
                                </div>
                                <div style="display: flex; align-items:center; justify-content:center;" onclick="mostrar_dados_freelancer_90()" class="card-body"><canvas id="myBarChart3" width="100%" height="40"></canvas></div>
                            </div>
                        </div>


                        <div style="height: 450px;" class="col-xl-4  my-4">
                            <div class="card h-100 shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-center text-primary">Dados de Freelancer por Setor</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>

                                </div>


                            </div>
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
    );



    function sair() {
        localStorage.clear();
        location.assign('../../');
    }

    function getDaysInRange(data_inicial, data_final) {
        var days = [];
        var startDate, endDate;

        if (data_inicial && data_final) {
            startDate = new Date(data_inicial);
            endDate = new Date(data_final);
            endDate.setDate(endDate.getDate()) + 1; // Adiciona um dia
        } else if (data_inicial) {
            startDate = new Date(data_inicial);
            endDate = new Date();
            endDate.setDate(endDate.getDate()); // Adiciona um dia
        } else if (data_final) {
            endDate = new Date(data_final);
            startDate = new Date();
            startDate.setDate(endDate.getDate() - 90); // Define 90 dias a partir do final, considerando o dia adicional
        } else {
            endDate = new Date();
            startDate = new Date();
            startDate.setDate(endDate.getDate() - 90); // Define os últimos 90 dias
        }

        startDate.setDate(startDate.getDate() + 1)
        endDate.setDate(endDate.getDate() + 2)

        while (startDate < endDate) { // Mantém o loop enquanto startDate é menor que endDate

            days.push(formatDate(new Date(startDate)));
            startDate.setDate(startDate.getDate() + 1);
        }

        return days;

    }


    function getLastNinetyDays() {
        const data_inicial = $('#data_valores_inicial').val();
        const data_final = $('#data_valores_final').val();



        return getDaysInRange(data_inicial, data_final);
    }

    function getLastNinetyDays2() {
        const data_inicial = $('#data_freelancer_inicial').val();
        const data_final = $('#data_freelancer_final').val();


        return getDaysInRange(data_inicial, data_final);
    }




    // Função auxiliar para formatar a data no formato "dia/mês"
    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        return day + '/' + month;
    }

    // Função para buscar dados do PHP e criar o gráfico


    // Função para buscar dados do PHP e criar o gráfico
    var myLineChart2;
    var myLineChart3;

    function fetchThirdChartData() {
        var days = getLastNinetyDays2();

        // Destruir o gráfico antigo, se existir
        if (myLineChart3) {
            myLineChart3.destroy();
        }

        const data_inicial = $('#data_freelancer_inicial').val();
        const data_final = $('#data_freelancer_final').val();

        console.log(data_inicial)
        $.ajax({
            type: 'POST',
            url: 'config/dados_terceiro_grafico.php',
            data: {
                data_inicial: data_inicial,
                data_final: data_final,
            },
            success: function(response) {

          

                var chartData = response;

                // Extrair os valores e formatar para o formato esperado pelo Chart.js
                var formattedData = [];
                for (var i = 0; i < chartData.length; i++) {
                    formattedData.push(chartData[i].total_freelancers);
                }

                createThirdChart(formattedData, "myBarChart3", "#6eaa5e", "Registro dos Freelancers"); // Chama a função para criar o gráfico
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    function fetchSecondChartData() {
        var days = getLastNinetyDays();

        // Destruir o gráfico antigo, se existir
        if (myLineChart2) {
            myLineChart2.destroy();
        }

        const data_inicial = $('#data_valores_inicial').val();
        const data_final = $('#data_valores_final').val();
        console.log(data_inicial)

        $.ajax({
            type: 'POST',
            url: 'config/dados_grafico.php', // URL do seu script PHP para buscar dados
            data: {
                data_inicial: data_inicial,
                data_final: data_final
            },
            success: function(response) {
                var chartData = JSON.parse(response);

                // Extrair os valores e formatar para o formato esperado pelo Chart.js
                var formattedData = [];
                for (var i = 0; i < chartData.length; i++) {
                    formattedData.push(chartData[i].total_pagto_diario);
                }

                createSecondChart(formattedData, "myBarChart2", "rgba(2,117,216,1)", "Registro dos Valores pagos aos Freelancers"); // Chama a função para criar o gráfico
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Função para criar o segundo gráfico com os dados recebidos
    function createSecondChart(chartData, chartId, color, status) {
   
        var ctx = document.getElementById(chartId);

        myLineChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: getLastNinetyDays(), // Usando os últimos 90 dias como labels
                datasets: [{
                    label: status,
                    backgroundColor: color,
                    borderColor: color,
                    data: chartData,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 15
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                },
            }
        });
    }

    // Função para criar o terceiro gráfico com os dados recebidos
    function createThirdChart(chartData, chartId, color, status) {
    
        var ctx = document.getElementById(chartId);

        myLineChart3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: getLastNinetyDays2(), // Usando os últimos 90 dias como labels
                datasets: [{
                    label: status,
                    backgroundColor: color,
                    borderColor: color,
                    data: chartData,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 15
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                },
            }
        });
    }

    function atualizar() {
        fetch('exec_python.php')
            .then(response => response.text())
            .then(resultado => {
                console.log(resultado);
            })
            .catch(error => {
                console.error('Erro ao executar o script Python:', error);
            });
    }

    atualizar()

    fetchSecondChartData();
    fetchThirdChartData();
</script>