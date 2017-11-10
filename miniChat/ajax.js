"use strict";

function request(callback,url,data = null){
	var xhr =new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};

	xhr.open("POST",url, true);
	xhr.send(data);
}

function afficherHistorique(result){
	let historique = document.querySelector('#historique');
	historique.innerHTML = '';
	result = JSON.parse(result);
	for(let message of result){
		let ligne = document.createElement('div');

		let auteur = document.createElement('span');
		auteur.innerText = message['m_auteur']+' -> ';

		let date = document.createElement('span');
		date.innerText = message['m_date']+' : ';

		let contenu = document.createElement('span');
		contenu.innerText = message['m_contenu'];

		ligne.appendChild(date);
		ligne.appendChild(auteur);
		ligne.appendChild(contenu);
		
		historique.appendChild(ligne);
		
	}
}

function envoi(result){
	let input = document.querySelector('#contenu');
	input.value= '' ;
}


window.addEventListener('DOMContentLoaded',function(){
	setInterval(function(){request(afficherHistorique,'traitement.php');},2000);
	let form = document.querySelector('#chat');
	form.addEventListener('submit',function(event){
		event.preventDefault();
		let monForm = new FormData(this);
		let inputMessage = document.querySelector('#auteur');
		let inputAuteur = document.querySelector('#contenu');
		if(inputMessage.value != '' && inputAuteur.value != ''){
			request(envoi,'traitement.php',monForm)
		}
		
	})

});