function getJsonAmbientes(){
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

    constructor(id, name,principal) {

        this.id = id;
        this.name = name;
        this.user=principal;

    }

}

var arrayPrincipal = [];


function setArray() {
    //Get JSON
    var jsonString = getJsonAmbientes();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        arrayPrincipal[i] = new Ambiente(objetoJSON.id, objetoJSON.name, objetoJSON.principal);
    }
}


function makeNavUtilities(ambientesArray) {

var utilizador=localStorage.utilizadorID;
    if (ambientesArray == 0) {
        var varUL = document.getElementById("collapseExamplePages");
        varUL.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < ambientesArray.length; i++) {
            if (ambientesArray[i].user == utilizador) {
       //     var li = document.createElement("LI");

            var tdName = document.createElement("a");
            tdName.innerHTML = ambientesArray[i].name;
            tdName.setAttribute('href', 'Graficos_utilities.php');
            tdName.setAttribute('id', 'teste');
            tdName.setAttribute('value', ambientesArray[i].id);
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
