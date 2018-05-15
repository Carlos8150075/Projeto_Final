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





function makeMonthChartDeath(year) {
    var ctx = document.getElementById("barras_utilities2");
// String de teste
    var jsonString = getJsonRegistos();

    var obj = JSON.parse(jsonString);
    var array = obj;
    var labels = [];
    var data = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        var date = objetoJSON.date.split('-');
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
        initialGraph();
        this.parentNode.removeChild(this);
        document.getElementById('tableContainer2').innerHTML="";

    });

    document.getElementById('barras_utilities').appendChild(but);
}

function initialGraph() {
    var ctx = document.getElementById("barras_utilities2");
// String de teste
    var jsonString = getJsonRegistos();
   //alert(localStorage.utilitie);
   //alert(localStorage.utilizadorID);

    var obj = JSON.parse(jsonString);
    var array = obj;
    var labels = [];
    var data = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        var date = objetoJSON.date.split('-');
        if (labels.includes(date[0])) {
            data[labels.indexOf(date[0])]++;
        } else {
            labels[count] = date[0];
            data[count] = 1;
            count++;
        }
    }

    var color = ['#e2f5fa', '#b4e3ef', '#99d9ea', '#00a2e8', '#3f48cc', 
          '#7092be', '#afc1da', '#c8d5e6', '#c0bae2', '#9b92d1','#6a5bbb', '#7047a7'];


    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: "Custos",
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
            onClick: function (e) {
                var element = this.getElementAtEvent(e);
               if (element.length > 0) {
           
            myBarChart.destroy();
                    makeMonthChartDeath(labels[element[0]._index]);
                }
            }

        }
        

    });
    
    
}




function initEvents() {
    initialGraph();
}

document.addEventListener('DOMContentLoaded', initEvents);

