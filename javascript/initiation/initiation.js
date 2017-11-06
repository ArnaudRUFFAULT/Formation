"use strict";

function calculerMoyenne (tab){
	var moy = 0;
	for(var valeur of tab){
		moy += valeur;
	}
	return moy / tab.length;
}

var mesNotes = new Array;
var saisie;

do{
	saisie = prompt("Entrez une note entre 0 et 20, ou appuyer directement sur Ok pour arreter la saisie");
	if (!(saisie)) {
		if(mesNotes.length>0){
			saisie = "stop";
		}
		else{
			alert("Entrez au moins une note!");
		}	
	}
	else{
		var note = parseInt(saisie);
		if(note >= 0 && note <= 20){
			mesNotes.push(note);
		}
		else{
			alert("Entrer un nombre compris entre 0 et 20!");
		}	
	}
}
while(saisie !== "stop");

console.log( "La moyenne est de " + calculerMoyenne(mesNotes));


