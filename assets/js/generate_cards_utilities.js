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


function makeNavUtilities(utilitiesArray) {

    var utilizador = localStorage.utilizadorID;
    var ambiente = localStorage.ambienteID;
//    alert(ambiente);


    if (utilitiesArray == 0) {
        var varUL = document.getElementById("addUtilitie");
        varUL.innerHTML = "Não existem resultados!";

    } else {
        for (var i = 0; i < utilitiesArray.length; i++) {

            //  alert(utilitiesArray.length);
            //  alert(utilitiesArray[i].user);
            if (ambiente == utilitiesArray[i].ambiente) {
                if (utilitiesArray[i].user == utilizador) {
                    var div1 = document.createElement("div");
                    div1.setAttribute('class', 'col-xl-3 col-sm-6 mb-3')
                    var div2 = document.createElement("div");
                    div2.setAttribute('class', 'card text-white bg-light o-hidden h-100 fundo')


                    var link = document.createElement("a");
                    link.innerHTML = utilitiesArray[i].name;
                    link.setAttribute('class', 'card-footer text-primary clearfix small z-1');
                    link.setAttribute('href', 'Graficos_utilities.php');
                    link.setAttribute('value', utilitiesArray[i].id);
                    link.setAttribute('onclick', 'myFunction2()');
                    var span1 = document.createElement("SPAN");
                    var span2 = document.createElement("SPAN");
                    span2.setAttribute('class', 'float-right');
                    link.appendChild(span1);
                    link.appendChild(span2);

                    div1.appendChild(div2);

                    div2.appendChild(link);
                    var varUL = document.getElementById("cardsUtilities");

                    varUL.appendChild(div1);

                }
            }
        }
    }
}







function initEvents() {

    setArray();
    makeNavUtilities(arrayPrincipal);


}

document.addEventListener('DOMContentLoaded', initEvents);
