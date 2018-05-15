function getJsonUtilities() {
    $.ajaxSetup({async: false});
    var json = "";
    $.post("assets/Services/getUtilitiesService.php",
            {},
            function (data) {
                json = data;
            });
    return json;
}

class Utilities {

    constructor(id, ambiente, name, metric, user) {

        this.id = id;
        this.ambiente = ambiente;
        this.name = name;
        this.metric = metric;
        this.user = user;

    }

}

var arrayPrincipal = [];


function setArray() {
    //Get JSON
    var jsonString = getJsonUtilities();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        arrayPrincipal[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric, objetoJSON.id_user);
    }
}

function getSearchFilter() {
    var input = document.getElementById("filterSearch").value;
    return input;
}


function makeUtilitiesTable(utilitiesArray) {
    clearTable()

    var utilizador = localStorage.utilizadorID;

    if (utilitiesArray == 0) {
        var tbody = document.getElementById("myTable");
        tbody.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {
            if (utilitiesArray[i].user == utilizador) {
                var tr = document.createElement("tr");

                var tdId = document.createElement("td");
                tdId.innerHTML = utilitiesArray[i].id;
                var tdAmbiente = document.createElement("td");
                tdAmbiente.innerHTML = utilitiesArray[i].ambiente;
                var tdName = document.createElement("td");
                tdName.innerHTML = utilitiesArray[i].name;
                var tdMetric = document.createElement("td");
                tdMetric.innerHTML = utilitiesArray[i].metric;

                tr.appendChild(tdId);
                tr.appendChild(tdAmbiente);

                tr.appendChild(tdName);
                tr.appendChild(tdMetric);

                var tbody = document.getElementById("myTable");

                tbody.appendChild(tr);
            }
        }
    }
}

function clearTable() {
    var tbody = document.getElementById("myTable");
    tbody.innerHTML = "";
}

function clear() {
    document.getElementById("filterSearch").value = "";
    document.getElementById("dataInicio").value = "";
    document.getElementById("dataFim").value = "";
    makeUtilitiesTable()(arrayPrincipal);
}

function initEvents() {

    setArray();
    makeUtilitiesTable(arrayPrincipal);

}

document.addEventListener('DOMContentLoaded', initEvents);
