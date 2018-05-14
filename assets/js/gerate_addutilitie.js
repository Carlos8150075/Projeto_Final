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

    constructor(id, ambiente, name, metric) {

        this.id = id;
        this.ambiente = ambiente;
        this.name = name;
        this.metric = metric;

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
        arrayPrincipal[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric);
    }
}


function makeNavUtilities(utilitiesArray) {

    if (utilitiesArray == 0) {
        var varUL = document.getElementById("addUtilitie");
        varUL.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {
            // if (utilitiesArray[i].utility == 0) {    
           
            var utilitie = document.createElement("OPTION");
            utilitie.innerHTML = utilitiesArray[i].name;
            utilitie.setAttribute('id', 'utilitie');
            utilitie.setAttribute('value', i);
           

            var varUL = document.getElementById("addUtilitie");

            varUL.appendChild(utilitie);
            //    }
        }
    }
    
    


}


function initEvents() {

    setArray();
    makeNavUtilities(arrayPrincipal);
    
    
}

document.addEventListener('DOMContentLoaded', initEvents);
