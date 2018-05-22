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

function getJsonUtilities(){
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

    constructor(id, ambiente, name, metric,user) {

        this.id = id;
        this.ambiente = ambiente;
        this.name = name;
        this.metric = metric;
        this.user=user;

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
        a[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric,objetoJSON.id_user);
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


function makeRegistosTable(utilitiesArray , registosArray) {
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
                
                var tdCons = document.createElement("td");
                tdCons.innerHTML = registosArray[i].user;
                
                
                 for (var j = 0; j < utilitiesArray.length; j++) {
                     if(registosArray[i].utility==utilitiesArray[j].id){
                        var utility=utilitiesArray[j].name;
                     }
                     
                 }
                
                var tdutility = document.createElement("td");
                tdutility.innerHTML = utility;
                var tdValor = document.createElement("td");
                tdValor.innerHTML = registosArray[i].valor;
                var tdDate = document.createElement("td");
                tdDate.innerHTML = registosArray[i].date;

                tr.appendChild(tdId);
                tr.appendChild(tdCons);
                
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

function initEvents2() {

    setArray();
    setArray2();

    makeRegistosTable(a,b);
}

document.addEventListener('DOMContentLoaded', initEvents2);
