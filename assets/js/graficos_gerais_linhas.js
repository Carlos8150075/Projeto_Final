var tableFormed = false;
var yearLabels = [];
var monthLabels = [];
var dataLabels = [];
var countLabels = 0;

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

function clean() {
    document.getElementById('tableContainer').innerHTML = "";
}

function remove() {
    tableFormed = false;
    clean();
}


function changeTable() {
    if (tableFormed) {
        makeMMTable();
    }
}

function makeLineChart() {

    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var container = document.getElementById('utility_linhasContainer');
    var ctx = document.getElementById("utilities_linhas");
    container.removeChild(ctx);

    var canvas = document.createElement('canvas');
    canvas.setAttribute('id', "utilities_linhas");
    canvas.setAttribute('width', "100%");
    canvas.setAttribute('height', "30");

    ctx = canvas;
    container.appendChild(ctx);

// String de teste
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
    
    

    var utilizador = localStorage.utilizadorID;
    var utility = localStorage.utilityID;

    var anos = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        if (objetoJSON.id_user == utilizador && objetoJSON.id_utility==utility) {
        if (objetoJSON.date !== null) {
            var mes = objetoJSON.date.split("-")[1];
            //alert(mes);
            if (mes == 01) {

                    numeroJan += parseInt(objetoJSON.valor);
                }
                if (mes == 02) {
                    numeroFev += parseInt(objetoJSON.valor);
                }
                if (mes == 03) {
                    numeroMar = parseInt(objetoJSON.valor);
                }
                if (mes == 04) {
                    // alert(numeroAbr);
                    //  alert(objetoJSON.valor);
                    numeroAbr += parseInt(objetoJSON.valor);
                }
                if (mes == 05) {
                    numeroMai += parseInt(objetoJSON.valor);
                }
                if (mes == 06) {
                    numeroJun += parseInt(objetoJSON.valor);
                }
                if (mes == 07) {
                    numeroJul += parseInt(objetoJSON.valor);
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
        }}
    }

    var labels = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
    var date = [numeroJan, numeroFev, numeroMar, numeroAbr, numeroMai, numeroJun,
        numeroJul, numeroAgo, numeroSet, numeroOut, numeroNov, numeroDez];
    var monthFrom = document.getElementById('monthFrom').value;
    var monthTo = document.getElementById('monthTo').value;
    var yearFrom = document.getElementById('yearFrom').value;
    var yearTo = document.getElementById('yearTo').value;

    var months = new Array();
    var data = new Array();
    countLabels = 0;
    if (yearFrom == 0 || yearTo == 0) {
        for (var i = 0; i < 12; i++) {
            if (i >= monthFrom - 1 && i <= monthTo - 1) {
                months[countLabels] = labels[i];
                data[countLabels] = date[i];
                count++;
                monthLabels[countLabels] = i;
                yearLabels[countLabels] = 0;
                countLabels++;
            }

        }
    } else {
        if (yearFrom > yearTo) {
            return;
        } else if (yearFrom == yearTo) {
            var registos = [];
            for (var i = 0; i < array.length; i++) {
                if (array[i].date != null) {
                    registos[i] = array[i].date;
                }
            }
            for (var i = 0; i < 12; i++) {
                if (i >= monthFrom - 1 && i <= monthTo - 1) {
                    countData = 0;
                    for (var bCount = 0; bCount < registos.length; bCount++) {
                        if (i + 1 > 9) {
                            if (registos[bCount].includes("" + yearFrom + "-" + (i + 1))) {
                                countData++;
                            }
                        } else {
                            if (registos[bCount].includes("" + yearFrom + "-0" + (i + 1))) {
                                countData++;
                            }
                        }
                    }
                    months[countLabels] = labels[i];
                    data[countLabels] = countData;
                    yearLabels[countLabels] = yearFrom;
                    monthLabels[countLabels] = i;
                    countLabels++;
                }
            }
        } else {
            var temp = 13;
            var registos = [];
            for (var i = 0; i < array.length; i++) {
                if (array[i].date != null) {
                    registos[i] = array[i].date;
                }else{
                    registos[i] = "";
                }
            }
            for (var i = 0; i < 12; i++) {
                if (yearFrom > yearTo) {
                    break;
                }
                if (i >= monthFrom - 1 && i <= temp - 1) {
                    months[countLabels] = "" + labels[i] + " " + yearFrom;
                    var countData = 0
                    for (var bCount = 0; bCount < registos.length; bCount++) {
                        if (i + 1 > 9) {
                            if (registos[bCount].includes("" + yearFrom + "-" + (i + 1))) {
                                countData++;
                            }
                        } else {
                            if (registos[bCount].includes("" + yearFrom + "-0" + (i + 1))) {
                                countData++;
                            }
                        }
                    }
                    data[countLabels] = countData;
                    yearLabels[countLabels] = yearFrom;
                    monthLabels[countLabels] = i;
                    countLabels++;
                    if (i == 11) {
                        i = -1;
                        yearFrom++;
                        monthFrom = 1;
                        if (yearFrom == yearTo) {
                            temp = monthTo;
                        }
                    }

                }
            }
            for (var i = 0; i < array.length; i++) {
                var objetoJSON = array[i];
                if (objetoJSON.date !== null) {
                    var mes = objetoJSON.date.split("-")[1];
                    var ano = objetoJSON.date.split("-")[0];
                }
            }
        }
    }


    var maxY = Math.max.apply(null, data) + 5;
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                    label: "Registo",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    data: data,
                }],
        },
        options: {
            scales: {
                xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                yAxes: [{
                        ticks: {
                            min: 0,
                            max: maxY,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
            },
            legend: {
                display: false
            },
            onClick: function (e) {
                var element = this.getElementAtEvent(e);
                if (element.length > 0) {
                    var index = element[0]._index;
                    makeTable(monthLabels[index] + 1, monthLabels[index] + 1,
                            yearLabels[index], yearLabels[index]);
                }
            }
        }
    });
}


function reset() {
    document.getElementById('monthFrom').value = 1;
    document.getElementById('monthTo').value = 12;
    document.getElementById('yearFrom').innerHTML = "";
    document.getElementById('yearTo').innerHTML = "";
    setOptions();
    makeLineChart();
}


function setOptions() {
    var jsonString = getJsonRegistos();
    var obj = JSON.parse(jsonString);
    var array = obj;
    var anos = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        if (objetoJSON.date != null) {
            var ano = objetoJSON.date.split("-")[0];
            if (!anos.includes(ano)) {
                anos[count] = ano;
                count++;
            }
        }
    }
    anos.sort(function (a, b) {
        return a - b;
    });
    var select1 = document.getElementById('yearFrom');
    var select2 = document.getElementById('yearTo');
    var nullOption = document.createElement('option');
    nullOption.setAttribute('selected', 'true');
    nullOption.setAttribute('value', 0);
    nullOption.innerHTML = "----";
    nullOption2 = nullOption.cloneNode(true);
    select1.appendChild(nullOption);
    select2.appendChild(nullOption2);
    for (var i = 0; i < anos.length; i++) {
        var option = document.createElement('option');
        option.setAttribute('value', anos[i]);
        option.innerHTML = anos[i];
        var option2 = option.cloneNode(true);
        select1.appendChild(option);
        select2.appendChild(option2);
    }
}

function initEvents() {
   
        makeLineChart();
        setOptions();
        document.getElementById('monthFrom').addEventListener('change', makeLineChart);
        document.getElementById('monthTo').addEventListener('change', makeLineChart);
        document.getElementById('yearFrom').addEventListener('change', makeLineChart);
        document.getElementById('yearTo').addEventListener('change', makeLineChart);
        document.getElementById('reporGrafico').addEventListener('click', reset);
        document.getElementById('reporGrafico').addEventListener('click', remove);
        document.getElementById('monthFrom').addEventListener('change', changeTable);
        document.getElementById('monthTo').addEventListener('change', changeTable);

}

document.addEventListener('DOMContentLoaded', initEvents);


