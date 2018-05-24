

function eliminarRegistos() {
    $.ajaxSetup({async: false});

    var button = this;

    var registo = localStorage.registoID;
  

    $.post("assets/Services/deleteRegistosService.php", {action: 'disable', id: registo})
            .fail(function () {
                alert('Ajax error');
            });


}



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

var a = [];


function setArray2() {
    //Get JSON
    var jsonString = getJsonUtilities();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        a[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric, objetoJSON.id_user);
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

function getSearchFilter() {
    var input = document.getElementById("filterSearch").value;
    return input;
}


function makeRegistosTable(utilitiesArray, registosArray) {
    clearTable()
    var utilizador = localStorage.utilizadorID;

    if (registosArray == 0) {
        var tbody = document.getElementById("myTable");
        tbody.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < registosArray.length; i++) {
            if (registosArray[i].user == utilizador) {
                var tr = document.createElement("tr");

                var tdId = document.createElement("td");
                tdId.innerHTML = registosArray[i].id;
                for (var j = 0; j < utilitiesArray.length; j++) {
                    if (registosArray[i].utility == utilitiesArray[j].id) {
                        var utility = utilitiesArray[j].name;
                    }

                }

                var tdutility = document.createElement("td");
                tdutility.innerHTML = utility;
                var tdValor = document.createElement("td");
                tdValor.innerHTML = registosArray[i].valor;
                var tdDate = document.createElement("td");
                tdDate.innerHTML = registosArray[i].date;

                var td1 = document.createElement("td");
                var del = document.createElement("button");
                del.setAttribute("class", "btn btn-danger");
                del.setAttribute("id", registosArray[i].id);
                del.setAttribute("onclick", "myFunctionRegistos()");

                del.addEventListener('click', eliminarRegistos);

                del.innerHTML = "Eliminar";
                td1.appendChild(del);

                tr.appendChild(tdId);

                tr.appendChild(tdutility);
                tr.appendChild(tdValor);
                tr.appendChild(tdDate);
                tr.appendChild(td1);

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
    makeRegistosTable()(b);
}

function initEvents() {

    setArray();
    setArray2();

    makeRegistosTable(a, b);
}

document.addEventListener('DOMContentLoaded', initEvents);
