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





function makeMonthChartDeath2(mes) {
    var ctx = document.getElementById("barras_utilities2teste");
// String de teste
    var jsonString = getJsonRegistos();


    var utilizador = localStorage.utilizadorID;
    var utility = localStorage.utilityID;


    var dia1 = 0;
    var dia2 = 0;
    var dia3 = 0;
    var dia4 = 0;
    var dia5 = 0;
    var dia6 = 0;
    var dia7 = 0;
    var dia8 = 0;
    var dia9 = 0;
    var dia10 = 0;
    var dia11 = 0;
    var dia12 = 0;
    var dia13 = 0;
    var dia14 = 0;
    var dia15 = 0;
    var dia16 = 0;
    var dia17 = 0;
    var dia18 = 0;
    var dia19 = 0;
    var dia20 = 0;
    var dia21 = 0;
    var dia22 = 0;
    var dia23 = 0;
    var dia24 = 0;
    var dia25 = 0;
    var dia26 = 0;
    var dia27 = 0;
    var dia28 = 0;
    var dia29 = 0;
    var dia30 = 0;
    var dia31 = 0;

   // alert(mes);

    var obj = JSON.parse(jsonString);
    var array = obj;
    var labels = [];
    var data = [];
    var count = 0;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        //var date = objetoJSON.date.split('-');
        if (objetoJSON.id_user == utilizador && objetoJSON.id_utility == utility) {
            if (objetoJSON.date != null) {
                //alert(objetoJSON.date.split('-')[3]);
                if (objetoJSON.date.split('-')[1] == mes) {

                    var dia = objetoJSON.date.split('-')[2];

                    if (dia == 01) {

                        dia1 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 02) {

                        dia2 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 03) {

                        dia3 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 04) {

                        dia4 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 05) {

                        dia5 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 06) {

                        dia6 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 07) {

                        dia7 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 08) {

                        dia8 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 09) {

                        dia9 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 10) {

                        dia10 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 11) {

                        dia11 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 12) {

                        dia12 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 13) {

                        dia13 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 14) {

                        dia14 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 15) {

                        dia15 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 16) {

                        dia16 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 17) {

                        dia17 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 18) {

                        dia18 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 19) {

                        dia19 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 20) {

                        dia20 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 21) {

                        dia21 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 22) {

                        dia22 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 23) {

                        dia23 += parseInt(objetoJSON.valor);
                    }
                    if (dia24 == 24) {

                        dia24 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 25) {

                        dia25 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 26) {

                        dia26 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 27) {

                        dia27 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 28) {

                        dia28 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 29) {

                        dia29 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 30) {

                        dia30 += parseInt(objetoJSON.valor);
                    }
                    if (dia == 31) {

                        dia31 += parseInt(objetoJSON.valor);
                    }


                }
            }
        }
    }
    // var sessionValue = '<%=Session["user"]%>';
    //alert(sessionValue);





    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data:
                {
                    labels: ["1", "2", "3", "4", "5", "6", "7",
                        "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22"
                                , "23", "24", "25", "26", "27", "28", "29", "30", "31"],
                    datasets: [{
                            data: [dia1, dia2, dia3, dia4, dia5, dia6, dia7, dia8, dia9, dia10, dia11, dia12, dia13, dia14, dia15
                                        , dia16, dia17, dia18, dia19, dia20, dia21, dia22, dia23, dia24, dia25
                                        , dia26, dia27, dia28, dia29, dia30, dia31],
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
    but.setAttribute('style', 'margin-left: 700px;');
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
    
    var 
    labels=[numeroJan, numeroFev, numeroMar, numeroAbr, numeroMai, numeroJun,
                        numeroJul, numeroAgo, numeroSet, numeroOut, numeroNov, numeroDez];

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
                    makeMonthChartDeath2((element[0]._index)+1);
                 //   alert((element[0]._index)+1);
                }
            }

        }


    });


}




function initEvents() {
    initialGraph2();
}

document.addEventListener('DOMContentLoaded', initEvents);

