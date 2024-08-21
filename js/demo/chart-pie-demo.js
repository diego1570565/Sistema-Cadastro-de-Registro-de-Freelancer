Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [], // Vazio inicialmente, será preenchido com os nomes dos setores
        datasets: [{
            data: [], // Vazio inicialmente, será preenchido com a quantidade de trabalhadores por setor
            backgroundColor: [], // Vazio inicialmente, será preenchido com cores dinâmicas
            hoverBackgroundColor: [], // Cores de hover dinâmicas
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});

// Requisição Ajax para buscar os dados do PHP via GET
$.ajax({
    type: 'GET',
    url: 'config/dados_segundo_grafico.php', // URL do seu script PHP para buscar dados dos setores

    success: function (response) {

        var data = JSON.parse(response);

        // Preencher os dados recebidos no gráfico
        data.forEach(function (setorData, index) {
            myPieChart.data.labels.push(setorData.Nome_Setor);
            myPieChart.data.datasets[0].data.push(setorData.Quantidade_Trabalhadores);
            myPieChart.data.datasets[0].backgroundColor.push(getRandomColor());
            myPieChart.data.datasets[0].hoverBackgroundColor.push(getRandomColor());
        });

        // Atualizar o gráfico após receber os dados
        myPieChart.update();
    },
    error: function (xhr, status, error) {
        console.error(error);
    }
});

// Função para gerar uma cor aleatória em formato hexadecimal
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
