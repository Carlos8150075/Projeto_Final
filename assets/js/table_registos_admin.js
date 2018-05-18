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

function getSearchFilter() {
    var input = document.getElementById("filterSearch").value;
    return input;
}


function makeRegistosTable(registosArray) {
    clearTable()
    var utilizador= localStorage.utilizadorID;

    if (registosArray == 0) {
        var tbody = document.getElementById("myTableadmin");
        tbody.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < registosArray.length; i++) {
        
                var tr = document.createElement("tr");

                var tdId = document.createElement("td");
                tdId.innerHTML = registosArray[i].id;
                var tdUser = document.createElement("td");
                tdUser.innerHTML = registosArray[i].user;
                var tdutility = document.createElement("td");
                tdutility.innerHTML = registosArray[i].utility;
                var tdValor = document.createElement("td");
                tdValor.innerHTML = registosArray[i].valor;
                var tdDate = document.createElement("td");
                tdDate.innerHTML = registosArray[i].date;

                tr.appendChild(tdId);
                tr.appendChild(tdUser);
                
                tr.appendChild(tdutility);
                tr.appendChild(tdValor);
                tr.appendChild(tdDate);

                var tbody = document.getElementById("myTableadmin");

                tbody.appendChild(tr);
           
        }
    }
}

function clearTable() {
    var tbody = document.getElementById("myTableadmin");
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

    makeRegistosTable(b);
}

document.addEventListener('DOMContentLoaded', initEvents);
