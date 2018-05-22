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


function setArray3() {
    //Get JSON
    var jsonString = getJsonUtilities();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        arrayPrincipal[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric, objetoJSON.id_user);
    }
}

function getJsonAmbientes() {
    $.ajaxSetup({async: false});
    var json = "";
    $.post("assets/Services/getAmbientesService.php",
            {},
            function (data) {
                json = data;
            });
    return json;
}

class Ambiente {

    constructor(id, name, id_user) {

        this.id = id;
        this.name = name;
        this.id_user = id_user;

    }

}

var arrayPrincipalb = [];


function setArray4() {
    //Get JSON
    var jsonString = getJsonAmbientes();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        arrayPrincipalb[i] = new Ambiente(objetoJSON.id, objetoJSON.name, objetoJSON.id_user);
    }
}

function getSearchFilter() {
    var input = document.getElementById("filterSearch").value;
    return input;
}


function makeUtilitiesTable(utilitiesArray, ambientesarray) {
    
    var utilizador = localStorage.utilizadorID;

    if (utilitiesArray == 0) {
        var tbody = document.getElementById("myTableadmin");
        tbody.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {
           
                var tr = document.createElement("tr");

                var tdId = document.createElement("td");
                tdId.innerHTML = utilitiesArray[i].id;
                var tdAmbiente = document.createElement("td");
                for (var j = 0; j < utilitiesArray.length; j++) {
                     if(ambientesarray[i].id==utilitiesArray[j].ambiente){
                        var ambiente=ambientesarray[j].name;
                     }
                     
                 }
                tdAmbiente.innerHTML = ambiente;
                var tdName = document.createElement("td");
                tdName.innerHTML = utilitiesArray[i].name;
                var tdMetric = document.createElement("td");
                tdMetric.innerHTML = utilitiesArray[i].metric;

                tr.appendChild(tdId);
                tr.appendChild(tdAmbiente);

                tr.appendChild(tdName);
                tr.appendChild(tdMetric);

                var tbody = document.getElementById("myTableadmin");

                tbody.appendChild(tr);
            }
        
    }
}

function initEvents() {

    setArray3();
    setArray4();
    makeUtilitiesTable(arrayPrincipal,arrayPrincipalb);

}

document.addEventListener('DOMContentLoaded', initEvents);
