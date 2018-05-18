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


function makeCharts2() {
    var lineChart = document.getElementById("InicialAdministrador2");
    
    
    var dataRegisto = [];
    var jsonString = getJsonRegistos();
    var obj = JSON.parse(jsonString);
    var array = obj;
    var numeroJan = 0;
    var numeroFev = 0;
    var numeroMar = 0;
    var numeroAbr = 0;
    var numeroMai = 0;
    var numeroJun = 0;
    var numeroJul = 0;
    var numeroAgo = 0;
    var numeroSet = 0;
    var numeroOut = 0;
    var numeroNov = 0;
    var numeroDez = 0;
    
    var numeroJan2 = 0;
    var numeroFev2 = 0;
    var numeroMar2 = 0;
    var numeroAbr2 = 0;
    var numeroMai2 = 0;
    var numeroJun2 = 0;
    var numeroJul2 = 0;
    var numeroAgo2 = 0;
    var numeroSet2 = 0;
    var numeroOut2 = 0;
    var numeroNov2 = 0;
    var numeroDez2 = 0;

    var utilizador = localStorage.utilizadorID;

  var soma=0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        //alert(objetoJSON.valor);    
       
            if (objetoJSON.date != null) {
                var mes = objetoJSON.date.substring(5, 7);

                if (mes == 01) {

                    numeroJan += parseInt(objetoJSON.valor);
                    numeroJan2=numeroJan;
                }
                if (mes == 02) {
                    numeroFev += parseInt(objetoJSON.valor);
                    numeroFev2=numeroJan2+numeroFev;
                }
                if (mes == 03) {
                    numeroMar = parseInt(objetoJSON.valor);
                    numeroMar2=numeroMar+numeroFev2;
                }
                if (mes == 04) {
                    // alert(numeroAbr);
                    //  alert(objetoJSON.valor);
                    numeroAbr += parseInt(objetoJSON.valor);
                    numeroAbr2=numeroAbr+numeroMar2;
                }
                if (mes == 05) {
                    numeroMai += parseInt(objetoJSON.valor);
                    numeroMai2=numeroMai+numeroAbr2;
                }
                if (mes == 06) {
                    numeroJun += parseInt(objetoJSON.valor);
                    numeroJun2=numeroJun+numeroMai2;
                }
                if (mes == 07) {
                    numeroJul += parseInt(objetoJSON.valor);
                    numeroJul2=numeroJul+numeroJun2;
                }
                if (mes == 08) {
                    numeroAgo += parseInt(objetoJSON.valor);
                }
                if (mes == 09) {
                    numeroSet += parseInt(objetoJSON.valor);
                    //alert(numeroSet);
                }
                if (mes == 10) {
                    numeroOut += parseInt(objetoJSON.valor);
                }
                if (mes == 11) {
                    numeroNov += parseInt(objetoJSON.valor);
                }
                if (mes == 12) {
                    numeroDez += parseInt(objetoJSON.valor);
                }
            
        }
    }
    
    var dataCustos = {
        label: "Gastos",
        data: [numeroJan, numeroFev, numeroMar, numeroAbr, numeroMai, numeroJun,
                        numeroJul, numeroAgo, numeroSet, numeroOut, numeroNov, numeroDez],
        lineTension: 0.3,
        fill: false,
        borderColor: '#3f48cc',
        backgroundColor: '#3f48cc',
        pointBorderColor: '#3f48cc',
        pointBackgroundColor: '#7092be',
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
   
    makeCharts2();
    

}

document.addEventListener('DOMContentLoaded', initEvents);