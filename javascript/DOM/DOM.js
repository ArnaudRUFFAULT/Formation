"use strict";
var cpt = 0;
var tab = [];
function change_liste() {
	
	var maListe = document.getElementsByTagName("ul");
	if(cpt % 2 == 0){		
	    maListe[0].setAttribute('type','circle');
	    recupItemListe(maListe[0]);
		maListe[0].style.position = "absolute";
		maListe[0].style.top = Math.random()*800+"px";
		maListe[0].style.left = Math.random()*1600+"px";
	}
	else{
		maListe[0].setAttribute('type','disc');
		maListe[0].style.position = "relative";
		maListe[0].style.top = "0px";
		maListe[0].style.left = "0px";
		recupItemListe2(maListe[0]);

	}
	cpt++
}

function recupItemListe(maVar){
	var mesLi = maVar.getElementsByTagName("li");
	var y = 0 ;
	for(var Li of mesLi){
		tab[y]=Li.innerHTML;
		y++;
		var tab2 = tab;
		var cle = Math.floor(Math.random()*tab2.length)
		Li.innerHTML=tab2[cle];
		Li.style.color = '#' + (function co(lor){   return (lor +=
  [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
  && (lor.length == 6) ?  lor : co(lor); })('');;
		Li.style.fontSize = Math.random()*100+"px";
		}
		petitTexte();
	}

	


function recupItemListe2(maVar){
	console.log(tab);
	var mesLi = maVar.getElementsByTagName("li");
	var test = 0;
	var n = 0;
	for(var Li of mesLi){
		Li.innerHTML= tab[n];
		Li.style.color = "black";
		Li.style.fontSize = "16px";
		n++;
	}
}

function petitTexte(){
	alert("Hello\nHow are you?");
}