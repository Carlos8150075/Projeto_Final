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




function makeCardsAmbientes(ambientesArray) {

    var utilizador = localStorage.utilizadorID;
    if (ambientesArray == 0) {
        var varUL = document.getElementById("cards");
        varUL.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < ambientesArray.length; i++) {
            if (ambientesArray[i].id_user == utilizador) {
                var div1 = document.createElement("div");
                div1.setAttribute('class', 'col-xl-3 col-sm-6 mb-3');
                var div2 = document.createElement("div");
                div2.setAttribute('class', 'card text-white  bg-white o-hidden h-100 fundo');
                var div3 = document.createElement("div");
                div3.setAttribute('class', 'card-body fundo');
              
                div3.innerHTML = ambientesArray[i].name; 
                var divIcon = document.createElement("div");
                divIcon.setAttribute('class','card-body-icon');
                var div4=document.createElement("i");
                div4.setAttribute('class','fa far fa-align-justify');
                div4.setAttribute('style','zoom:70%; padding-bot:50px')
                var div5 = document.createElement("div");
                
                div5.setAttribute('class', 'mr-5')
                var h1 =document.createElement("h1");
                h1.innerHTML="<?= $sizeof($array) ?>";
                var link = document.createElement("a");
                link.setAttribute('class', 'card-footer text-primary clearfix small z-1');
                link.setAttribute('href', 'Ambientes.php');
                link.setAttribute('value', ambientesArray[i].id);
                link.setAttribute('id', ambientesArray[i].name);
                
               
                var span1 = document.createElement("SPAN");
                var span2 = document.createElement("SPAN");
                span1.setAttribute('class', 'float-left');
                span1.setAttribute('href', 'Ambientes.php');
                span1.setAttribute('value', ambientesArray[i].id);
                span1.setAttribute('id', ambientesArray[i].name);
                span1.innerHTML = "View Details";
                span2.setAttribute('class', 'float-right');
                link.setAttribute('onclick','myFunction3()');
                link.appendChild(span1);
                link.appendChild(span2);

                div1.appendChild(div2);
                div2.appendChild(div3);
                div3.appendChild(divIcon);
                divIcon.appendChild(div4);
                div3.appendChild(div5);
                div3.appendChild(h1);
                div2.appendChild(link);
                var varUL = document.getElementById("cards");

                varUL.appendChild(div1);
            }
        }
    }



}


function initEvents2() {

    setArray2();
    makeCardsAmbientes(arrayPrincipalb);


}

document.addEventListener('DOMContentLoaded', initEvents2);
