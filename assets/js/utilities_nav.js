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
        var varUL = document.getElementById("collapseExamplePages");
        varUL.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {
            if (utilitiesArray[i].user == utilizador) {
            var li = document.createElement("LI");

            var tdName = document.createElement("a");
            tdName.innerHTML = utilitiesArray[i].name;
            tdName.setAttribute('href', 'Graficos_utilities.php');
            tdName.setAttribute('id', 'teste');
            tdName.setAttribute('value', utilitiesArray[i].id);
            tdName.setAttribute('onclick','myFunction()');
            
            li.appendChild(tdName);

            var varUL = document.getElementById("collapseExamplePages");

            varUL.appendChild(li);
               }
        }}
   // }
    
    


}


function initEvents() {

    setArray();
    makeNavUtilities(arrayPrincipal);
    
    
}

document.addEventListener('DOMContentLoaded', initEvents);
