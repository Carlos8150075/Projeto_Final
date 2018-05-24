function eliminarUtilities() {
    $.ajaxSetup({async: false});

    var button = this;

    var delUtil = localStorage.delUtilID;
   

    $.post("assets/Services/deleteUtilitiesService.php", {action: 'disable', id: delUtil})
            .fail(function () {
                alert('Ajax error');
            });


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


function setArray2() {
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
                for (var j = 0; j < ambientesarray.length; j++) {
                     if(ambientesarray[j].id==utilitiesArray[i].ambiente){
                        var ambiente=ambientesarray[j].name;
                     }
                     
                 }
                tdAmbiente.innerHTML = ambiente;
                var tdName = document.createElement("td");
                tdName.innerHTML = utilitiesArray[i].name;
                var tdMetric = document.createElement("td");
                tdMetric.innerHTML = utilitiesArray[i].metric;
                
                var td1=document.createElement("td");
            
            
            var del=document.createElement("button");
            del.setAttribute("class","btn btn-danger");
           
           
            del.setAttribute("id",utilitiesArray[i].id);
            del.setAttribute("onclick","myFunctionUtiliess()");
            
            del.addEventListener('click', eliminarUtilities);
           
             del.innerHTML="Eliminar";
            td1.appendChild(del);

                tr.appendChild(tdId);
                tr.appendChild(tdAmbiente);

                tr.appendChild(tdName);
                tr.appendChild(tdMetric);
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
    makeUtilitiesTable()(arrayPrincipal);
}

function initEvents() {

    setArray();
    setArray2();
    makeUtilitiesTable(arrayPrincipal,arrayPrincipalb);

}

document.addEventListener('DOMContentLoaded', initEvents);
