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


class Registo {

    constructor(id, user, utility, valor, date) {

        this.id = id;
        this.user = user;
        this.utility = utility;
        this.valor = valor;
        this.date = date;
    }

}

var b = [];


function setArray() {
    //Get JSON
    var jsonString = getJsonRegistos();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        b[i] = new Registo(objetoJSON.id, objetoJSON.id_user,
                objetoJSON.id_utility, objetoJSON.valor,
                objetoJSON.date);
    }
}



function makeChart(arrayRegistos) {
    var lineChart = document.getElementById("Inicial2");
    
    //var arrayRegistos = JSON.parse(getJsonRegistos());
    
    var dataRegisto = [];
    
    var custoAcumulado = [];

    for (var i = 0; i < 12; i++) {
        dataRegisto[i] = 0;   
    }

//    for (var i = 0; i < arrayRegistos.length; i++) {
//        if (arrayRegistos[i].date != null)
//            dataRegisto[parseInt(arrayRegistos[i].date.split('-')[1]) - 1]++;
//    }
//    
    for (var j = 0; j < arrayRegistos.length; j++) {
        
        if(j=0){
             dataRegisto[j]=arrayRegistos[j].valor;
        }else{
        dataRegisto[j]=arrayRegistos[j].valor+arrayRegistos[j+1].valor;
    }
    }
    
    
    

    var dataCustos = {
        label: "Gastos",
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

    setArray();

    makeChart(b);
}


document.addEventListener('DOMContentLoaded', initEvents);