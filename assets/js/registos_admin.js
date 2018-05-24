function getJsonRegistos() {
    $.ajaxSetup({async: false});
    var json = "";
    $.post("assets/Services/getRegistosService.php",
            {},
            function (data) {
                json = data;
            });
    return json;
}


function makeCharts() {
    var lineChart = document.getElementById("InicialAdministrador");
    
    var arrayUtilities = JSON.parse(getJsonRegistos());
    
    var dataRegisto = [];
    
    var utilizadorID = localStorage.utilizadorID;
    
    for (var i = 0; i < 12; i++) {
        dataRegisto[i] = 0;
        
    }
    
     
    for (var i = 0; i < arrayUtilities.length; i++) {
        if (arrayUtilities[i].date != null)
            dataRegisto[parseInt(arrayUtilities[i].date.split('-')[1]) - 1]++;
    }
    
    
    var dataCustos = {
        label: "Registos",
        data: dataRegisto,
        lineTension: 0.3,
        fill: false,
        borderColor: '#00a2e8',
        backgroundColor: '#00a2e8',
        pointBorderColor: '#00a2e8',
        pointBackgroundColor: '#99d9ea',
        pointRadius: 5,
        pointHoverRadius: 10,
        pointHitRadius: 15,
        pointBorderWidth: 3
    };

    


    var labels = {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [dataCustos]
    };

    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 80,
                fontColor: 'black'
            }
        }};

    var lineChart = new Chart(lineChart, {
        type: 'line',
        data: labels,
        options: chartOptions
    });

    var barChart = new Chart(barChart, {
        type: 'bar',
        data: labels,
        options: chartOptions
    });

   
}

function initEvents() {
   
    makeCharts();
    

}

document.addEventListener('DOMContentLoaded', initEvents);