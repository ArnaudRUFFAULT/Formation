 "use restrict";

function ajouter() {	
    var liste = document.getElementById('listecommissions');
    var Ajouter = document.getElementById('course').value;
    var elementAjoute = document.createElement('li');
    if(Ajouter){
    	elementAjoute.innerText = Ajouter;
    	elementAjoute.setAttribute('name', Ajouter);
    	elementAjoute.setAttribute('onClick','supprimer2("'+Ajouter+'")');
    	liste.appendChild(elementAjoute);
    }
    couleur();
}

function supprimer() {
    var liste = document.getElementById('listecommissions');
    var Cible = liste.lastChild;
    liste.removeChild(Cible);
    couleur();
}

function supprimer2(name){	
	var maListe = document.getElementById('listecommissions');
	var mesLis = document.querySelectorAll('#listecommissions li');
	for(Cible of mesLis){
		if(name == Cible.getAttribute('name')){
			maListe.removeChild(Cible);
		}
	}
	couleur();
}
function couleur(){
	var mesLis = document.querySelectorAll('#listecommissions li:nth-child(2n)');
	for(Cible of mesLis){
		Cible.style.color="red";
	}
}

couleur();

