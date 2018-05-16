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

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function getMonthNumber(month) {
    switch (month) {
        case 'Jan':
            return '1';
        case 'Fev':
            return '2';
        case 'Mar':
            return '3';
        case 'Abr':
            return '4';
        case 'Mai':
            return '5';
        case 'Jun':
            return '6';
        case 'Jul':
            return '7';
        case 'Ago':
            return '8';
        case 'Set':
            return '9';
        case 'Out':
            return '10';
        case 'Nov':
            return '11';
        case 'Dec':
            return '12';
        default:
            return '0';
    }


}
function getMonth(month) {
    switch (month) {
        case '01':
            return 'Janeir';
        case '02':
            return 'Fevereiro';
        case '03':
            return 'Março';
        case '04':
            return 'Abril';
        case '05':
            return 'Maio';
        case '06':
            return 'Junho';
        case '07':
            return 'Julho';
        case '08':
            return 'Agosto';
        case '09':
            return 'Setembro';
        case '10':
            return 'Outubro';
        case '11':
            return 'Novembro';
        case '12':
            return 'Dezembro';
        default:
            return 'None';
    }
}





function makeMonthChartDeath2(year) {
    var ctx = document.getElementById("barras_utilities2teste");
// String de teste
    var jsonString = getJsonRegistos();


    var utilizador = localStorage.utilizadorID;
    var utility = localStorage.utilityID;


    var obj = JSON.parse(jsonString);
    var array = obj;
    var labels = [];
    var data = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        var date = objetoJSON.date.split('-');
        if (objetoJSON.id_user == utilizador && objetoJSON.id_utility == utility) {
            if (date[0] == year) {
                if (labels.includes(getMonth(date[1]))) {
                    data[labels.indexOf(getMonth(date[1]))]++;
                    
                } else {
                    labels[count] = getMonth(date[1]);
                    data[count] = 1;
                    count++;
                }
            }
        }
    }

    // var sessionValue = '<%=Session["user"]%>';
    //alert(sessionValue);





    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: "Custo",
                    data: data,
                    backgroundColor: '#3399ff'
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
            },
            legend: {display: false},

        }

    });

    var but = document.createElement("button");
    but.setAttribute('id', 'resetGraph');
    but.setAttribute('class', 'btn btn-black');
    but.setAttribute('style', 'margin-left: 300px;');
    but.innerHTML = "Back";

    but.addEventListener('click', function () {
        myBarChart.destroy();
        initialGraph2();
        this.parentNode.removeChild(this);
        document.getElementById('tableContainer2teste').innerHTML = "";

    });

    document.getElementById('barras_utilitiesteste').appendChild(but);
}

function initialGraph2() {
    var ctx = document.getElementById("barras_utilities2teste");
// String de teste
    var jsonString = getJsonRegistos();
    //alert(localStorage.utilitie);
    //alert(localStorage.utilizadorID);
    


    var utilizador = localStorage.utilizadorID;
    var utility = localStorage.utilityID;


    var obj = JSON.parse(jsonString);
    var array = obj;
    var labels = [];
    var data = [];
    var count = 0;
    
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

    for (var i = 0; i < array.length; i++) {

        var objetoJSON = array[i];
        var date = objetoJSON.date.split('-');
        if (objetoJSON.id_user == utilizador && objetoJSON.id_utility == utility) {
              if (objetoJSON.date != null) {
                var mes = objetoJSON.date.substring(5, 7);

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
            }
        }
    }

    var color = ['#e2f5fa', '#b4e3ef', '#99d9ea', '#00a2e8', '#3f48cc',
        '#7092be', '#afc1da', '#c8d5e6', '#c0bae2', '#9b92d1', '#6a5bbb', '#7047a7'];


    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho",
                "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            datasets: [{
                    data: [numeroJan, numeroFev, numeroMar, numeroAbr, numeroMai, numeroJun,
                        numeroJul, numeroAgo, numeroSet, numeroOut, numeroNov, numeroDez],
                    backgroundColor: '#3399ff'

                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
            },
            legend: {display: false},
            onClick: function (e) {
                var element = this.getElementAtEvent(e);
                if (element.length > 0) {

                    myBarChart.destroy();
                    makeMonthChartDeath2(labels[element[0]._index]);
                }
            }

        }


    });


}




function initEvents() {
    initialGraph2();
}

document.addEventListener('DOMContentLoaded', initEvents);

