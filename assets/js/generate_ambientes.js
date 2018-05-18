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

class Ambientes {

    constructor(id,  name, id_user, principal) {

        this.id = id;
        this.id_user = id_user;
        this.name = name;
        this.principal = principal;

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
        arrayPrincipal[i] = new Ambientes(objetoJSON.id, objetoJSON.name, objetoJSON.id_user, objetoJSON.principal);
    }
}


function makeNavUtilities(ambienteArray) {
    
    var utilizador=localStorage.utilizadorID;

    if (ambienteArray == 0) {
        var varUL = document.getElementById("addAmbiente");
        varUL.innerHTML = "Não existem resultados!";
        
    } else {
        for (var i = 0; i < ambienteArray.length; i++) {
            if (ambienteArray[i].id_user == utilizador) {    
           
            var ambiente = document.createElement("OPTION");
            ambiente.innerHTML = ambienteArray[i].name;
            ambiente.setAttribute('id', 'ambiente');
            ambiente.setAttribute('value', ambienteArray[i].id);
           

            var varUL = document.getElementById("addAmbiente");

            varUL.appendChild(ambiente);
            //    }
        }
    }}
    
    


}


function initEvents() {

    setArray();
    makeNavUtilities(arrayPrincipal);
    
    
}

document.addEventListener('DOMContentLoaded', initEvents);
