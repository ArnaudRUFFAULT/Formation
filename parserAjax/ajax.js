"use strict";

function request(data,callback){
	var xhr =new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};

	xhr.open("POST","index.php", true);
	xhr.send(data);
}

function reponseAjax(result){
	var resultat = document.createElement("p");
	resultat.innerHTML = result;
	var affichageResultat = document.getElementById("affichageResultat");
	var historique = affichageResultat.firstChild;
	affichageResultat.insertBefore(resultat,historique);
}
	
function checkForm(result){
	if(document.getElementById('reponse') == null ){
		let message = document.createElement("p");
		message.setAttribute('id','reponse');
		message.innerHTML = result;
		let form = document.querySelector('form');
		form.parentNode.appendChild(message);
	}
	else{
		let message = document.getElementById('reponse');
		message.innerHTML = result;
	}
	
}

window.addEventListener('DOMContentLoaded',function(){
	var form = document.getElementById("form");
	form.addEventListener('submit',function(e){
		e.preventDefault();
		var monCalcul = document.getElementById("monCalcul").value;
		var data = new FormData();
		data.append('calcul',monCalcul);
		request(data,reponseAjax);

	});
	
});