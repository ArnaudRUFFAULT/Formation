"use strict";



function debugMsg(msg) {
    console.log(msg);
}

function ajax(name, datas) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        switch (xhttp.readyState) {
            case 0:
                debugMsg("non initialisé");
                break;
            case 1:
                debugMsg("ouverture. La méthode open() a été appelée avec succès");
                break;
            case 2:
                debugMsg("envoyé. La méthode send() a été appelée avec succès");
                break;
            case 3:
                debugMsg("en train de recevoir. Des données sont en train d'être transférées, mais le transfert n'est pas terminé");
                break;
            case 4:
                debugMsg("Status " + xhttp.status);

                if (xhttp.status == 200) {
                    document.getElementById("result").innerHTML += this.responseText + '<br />';
                }
                break;
        }
    };

    xhttp.open("POST", name + '.php', true);
    xhttp.send(datas);
}


window.addEventListener('DOMContentLoaded', function () {
    var listButton = document.getElementsByTagName('button');

    for( var i=0; i<listButton.length; i++ ) {
        listButton[i].addEventListener('click', function() {
            var formElement = document.querySelector("#formulaire");
            var datas = new FormData(formElement);

            //datas.append("je rajoute cette ligne", 'why not');

            ajax(this.getAttribute('data-file'), datas);
        });
    }
})