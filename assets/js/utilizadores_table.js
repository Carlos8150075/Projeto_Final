function eliminarUsers() {
    $.ajaxSetup({async: false});

    var button = this;

    var userID = localStorage.utilizadoresID;
   

    $.post("assets/Services/deleteUsersService.php", {action: 'disable', id: userID})
            .fail(function () {
                alert('Ajax error');
            });


}


function getJsonUsers() {
    $.ajaxSetup({async: false});
    var json = "";
    $.post("assets/Services/getUsersService.php",
            {},
            function (data) {
                json = data;
            });
    return json;
}

class User {

    constructor(id, name, surname, email, password, regiao, level, foto) {

        this.id = id;
        this.name = name;
        this.surname = surname;
        this.email = email;
        this.pasword = password;
        this.regiao = regiao;
        this.level = level;
        this.foto = foto;

    }

}

var d = [];


function setArrayUsers() {

    var jsonString = getJsonUsers();
    var obj = JSON.parse(jsonString);
    var array = obj;
    for (var i = 0; i < array.length; i++) {
        var objetoJSON = array[i];
        d[i] = new User(objetoJSON.id, objetoJSON.name, objetoJSON.surname, objetoJSON.email, objetoJSON.password,
                objetoJSON.regiao, objetoJSON.level, objetoJSON.foto);
    }

}


function makeUtilizadoresTable(UsersArray) {

    var utilizador = localStorage.utilizadorID;

    if (UsersArray == 0) {
        var tbody = document.getElementById("utilizaadoresTableadmin");
        tbody.innerHTML = "Não existem resultados!";
    } else {
        for (var i = 0; i < UsersArray.length; i++) {

            var tr = document.createElement("tr");

            var tdId = document.createElement("td");
            tdId.innerHTML = UsersArray[i].id;
            var tdName = document.createElement("td");

            tdName.innerHTML = UsersArray[i].name;
            ;
            var tdsurName = document.createElement("td");
            tdsurName.innerHTML = UsersArray[i].surname;
            var tdemail = document.createElement("td");
            tdemail.innerHTML = UsersArray[i].email;
            
            var td1=document.createElement("td");
            
            
            var del=document.createElement("button");
            del.setAttribute("class","btn btn-danger");
            del.setAttribute("id",UsersArray[i].id);
            del.setAttribute("onclick","myFunctionUtilizadores()");
            
            del.addEventListener('click', eliminarUsers);
             del.innerHTML="Eliminar";
            td1.appendChild(del);
            

            var tdRegiao = document.createElement("td");
            tdRegiao.innerHTML = UsersArray[i].regiao;
            tr.appendChild(tdId);
            tr.appendChild(tdName);
            tr.appendChild(tdsurName);
            tr.appendChild(tdemail);
            tr.appendChild(tdRegiao);
            tr.appendChild(td1);

            var tbody = document.getElementById("utilizaadoresTableadmin");

            tbody.appendChild(tr);

        }
    }
}



function initEvents() {

    setArrayUsers();

    makeUtilizadoresTable(d);

}

document.addEventListener('DOMContentLoaded', initEvents);
