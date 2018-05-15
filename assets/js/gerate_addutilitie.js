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

    constructor(id, ambiente, name, metric, user) {

        this.id = id;
        this.ambiente = ambiente;
        this.name = name;
        this.metric = metric;
        this.user= user;

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
        arrayPrincipal[i] = new Utilities(objetoJSON.id, objetoJSON.id_ambiente, objetoJSON.name, objetoJSON.metric,objetoJSON.id_user);
    }
}


function makeNavUtilities(utilitiesArray) {
    
    var utilizador=localStorage.utilizadorID;

    if (utilitiesArray == 0) {
        var varUL = document.getElementById("addUtilitie");
        varUL.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {
            if (utilitiesArray[i].user == utilizador) {    
           
            var utilitie = document.createElement("OPTION");
            utilitie.innerHTML = utilitiesArray[i].name;
            utilitie.setAttribute('id', 'utilitie');
            utilitie.setAttribute('value', utilitiesArray[i].id);
           

            var varUL = document.getElementById("addUtilitie");

            varUL.appendChild(utilitie);
            //    }
        }
    }}
    
    


}


function initEvents() {

    setArray();
    makeNavUtilities(arrayPrincipal);
    
    
}

document.addEventListener('DOMContentLoaded', initEvents);
