"use strict";
function supprimer(el) {   
        el.remove();
        let fond = document.getElementById('conteneur');
        fond.style.filter = "blur(0px)";
}
window.addEventListener('load',function(){	



	var mesBlocs = document.querySelectorAll('.bloc img');
	var monTableau = [];
	for( let monBloc of mesBlocs){
		monBloc.addEventListener('mouseover',function(){
			monBloc.style.cursor = 'move';
		});
		let realImg = document.createElement('img');
		realImg.setAttribute('src',monBloc.getAttribute("data-img"));
		realImg.addEventListener('load',function(){
			var Blocs = document.querySelectorAll(".bloc");
			for(let Bloc of Blocs){
				Bloc.style.margin = "20px 50px";
			}
			monBloc.setAttribute("src",realImg.getAttribute("src"));
			monBloc.style.width = "100%";
			monTableau.push(monBloc.getAttribute("data-img"));
		});

		monBloc.addEventListener('click',function($this){
			var monCadre = document.createElement('div');
			let fond = document.getElementById('conteneur');
			monCadre.style.position = "fixed";
			monCadre.style.width = "100%";
			monCadre.style.height = "100%";
			monCadre.style.zIndex = "2";
			monCadre.style.top = "0";
			monCadre.style.left = "0";
			monCadre.style.backgroundColor = "rgba(255, 255, 255, 0.5)";
			fond.style.filter = "blur(5px)";
			monCadre.setAttribute('onClick', 'supprimer(this)');

			var monImage = document.createElement('img');
			monImage.setAttribute('src',this.getAttribute("src"));
			monImage.style.width = "70%";
			monImage.style.position = "relative";
			monImage.style.left = "15%";
			monImage.style.top = "7%";

			monCadre.appendChild(monImage);

			var conteneur = document.querySelector('body');

			conteneur.appendChild(monCadre);
		});
	}

});