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

function makeChart() {

    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("utilities_circular");
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
    


    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        //alert(objetoJSON.valor);    
        if (objetoJSON.id_user == utilizador && objetoJSON.id_utility==utility) {
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


    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho",
                "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            datasets: [{
                    data: [numeroJan, numeroFev, numeroMar, numeroAbr, numeroMai, numeroJun,
                        numeroJul, numeroAgo, numeroSet, numeroOut, numeroNov, numeroDez],
                    backgroundColor: ['#e2f5fa', '#b4e3ef', '#99d9ea', '#00a2e8', '#3f48cc',
                        '#7092be', '#afc1da', '#c8d5e6', '#c0bae2', '#9b92d1', '#6a5bbb', '#7047a7']

                }]
        }
    });


}


document.addEventListener('DOMContentLoaded', makeChart);
