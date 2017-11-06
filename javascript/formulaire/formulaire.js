"use strict";
window.addEventListener('load',function(){



	let button = document.getElementById('submit');
	var texteVide;
	var nombreVide;
	button.addEventListener('click',function(e){
		var submit = true;
		let texte = document.getElementById('texte');
		let nombre = document.getElementById('nombre');
		let email = document.getElementById('email');
		let tel = document.getElementById('tel');
		let select = document.getElementById('select');

		if(texte.value === ''){
			if(typeof texteVide == "undefined"){
				console.log('reok');
				texteVide = document.createElement('span');
				texteVide.innerText = "Le champs texte doit être rempli";
				texteVide.style.color = 'red';	
			}
			texte.parentNode.insertBefore(texteVide,texte);
			e.preventDefault();
			submit = false;
		}
		else{
			if(typeof texteVide != "undefined"){
				texteVide.remove();
			}
		}
		if(nombre.value === ''){
			if(typeof nombreVide == "undefined"){
				nombreVide = document.createElement('span');
				nombreVide.innerText = "Le champs nombre doit être rempli";
				nombreVide.style.color = 'red';
			}
			texte.parentNode.insertBefore(nombreVide,nombre);
			e.preventDefault();
			submit = false;
		}
		else{
			if(typeof nombreVide != ""){
				nombreVide.remove();
			}
		}
		if(submit == true){
			this.submit();
		}	
	});		
});