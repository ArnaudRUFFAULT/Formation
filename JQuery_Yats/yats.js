"use strict";

function isEmptyText(){
	let result = $(this).text() == '' ? true : false;
	return result;
}

function Additionner(){
	let bool = true;
	if($(this).parent().attr('id') == 'ligneTotalPts'){
		bool =false;
	}
	if($(this).parent().attr('id') == 'ligneTotalPrime'){
		bool =false;
	}
	if($(this).parent().attr('id') == 'ligneTotalPtsPrime'){
		bool =false;
	}
	if($(this).parent().attr('id') == 'ligneTotalPtsInf'){
		bool =false;
	}
	if($(this).parent().attr('id') == 'ligneTotalCol'){
		bool =false;
	}
	return bool;
}

function Add(valeur,element){
	if($(element).text() != ''){
		valeur += parseInt($(element).text());
	}
	return valeur;
}

function Write(valeur, element){
	if(valeur != 0){
		$(element).text(valeur);
	}	
}

class Partie{
	constructor(){
		this.manche = 1;
		this.NbrLance = 0;
		this.tapis = null;
		this.main = null;
	}

	lancer(){
		if(this.NbrLance < 3){
			this.tapis.lancerDe();
			this.refreshAffichage();
			this.NbrLance+=1;
			this.mesJets();
		}	
	}

	mancheSuivante(){
		this.manche += 1;
		this.NbrLance = 0;
		this.main.viderDe();
		this.tapis.viderDe();
		this.tapis.remplirDe();
		this.lancer();
	}

	rejouer(){
		this.viderTableau();
		this.manche = 1;
		this.NbrLance = 0;
		this.main.viderDe();
		this.tapis.viderDe();
		this.tapis.remplirDe();
		this.refreshAffichage();
	}

	viderTableau(){
		$('.colN').text('');
	}
	
	refreshAffichage(){
		this.tapis.refreshAffichage();
		this.main.refreshAffichage();
		this.pointsMoitieSuperieur('.colN');
		this.pointsMoitieInferieur('.colN');
		this.totalColonne('.colN');
	}

	pointsMoitieSuperieur(colonne){
		let total = 0 ;
		total = Add(total, $('#ligneAs '+colonne));
		total = Add(total, $('#ligneDeux '+colonne));
		total = Add(total, $('#ligneTrois '+colonne));
		total = Add(total, $('#ligneQuatre '+colonne));
		total = Add(total, $('#ligneCinq '+colonne));
		total = Add(total, $('#ligneSix '+colonne));
		Write(total,$('#ligneTotalPts '+colonne));
		if(parseInt($('#ligneTotalPts '+colonne).text()) >= 63){
			Write(total + 35 , $('#ligneTotalPtsPrime '+colonne));
			$('#ligneTotalPrime '+colonne).text('35');
		}
		else{
			Write(total  , $('#ligneTotalPtsPrime '+colonne));
			$('#ligneTotalPrime '+colonne).text('0');
		}
	}

	pointsMoitieInferieur(colonne){
		let total = 0 ;
		total = Add(total, $('#ligneBrelan '+colonne));
		total = Add(total, $('#ligneCarre '+colonne));
		total = Add(total, $('#ligneFull '+colonne));
		total = Add(total, $('#lignePetiteSuite '+colonne));
		total = Add(total, $('#ligneGrandeSuite '+colonne));
		total = Add(total, $('#ligneYats '+colonne));
		total = Add(total, $('#ligneChance '+colonne));
		Write(total,$('#ligneTotalPtsInf '+colonne));
	}

	totalColonne(colonne){
		let total = 0 ;
		total = Add(total, $('#ligneTotalPtsPrime '+colonne));
		total = Add(total, $('#ligneTotalPtsInf '+colonne));
		Write(total,$('#ligneTotalCol '+colonne));
	}

	mesJets(){
		maMain.empty();
		this.ajouterALaMain(this.tapis);
		this.ajouterALaMain(this.main);
		this.checkCondition();
	}
	ajouterALaMain(lieu){
		if(lieu.De1 != null && lieu.De1.getScore()!=null){
			maMain.add(lieu.De1.getScore());
		}
		if(lieu.De2 != null && lieu.De2.getScore()!=null){
			maMain.add(lieu.De2.getScore());
		}
		if(lieu.De3 != null && lieu.De3.getScore()!=null){
			maMain.add(lieu.De3.getScore());
		}
		if(lieu.De4 != null && lieu.De4.getScore()!=null){
			maMain.add(lieu.De4.getScore());
		}
		if(lieu.De5 != null && lieu.De5.getScore()!=null){
			maMain.add(lieu.De5.getScore());
		}
	}

	getNbrLance(){
		return this.NbrLance;
	}

	setTapis(tapis){
		this.tapis = tapis;
	}

	setMain(main){
		this.main = main;
	}

	checkCondition(){
		console.log(maMain);
		let mesCases = $('');
		if(maMain.isBrelan()){
			console.log('La main contient un BRELAN');
			mesCases+=$('#ligneBrelan .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.sumNumber());
				partie.mancheSuivante();
			});
		}
		else{
			mesCases+=$('#ligneBrelan .colN').css('backgroundColor','white').off();
		}
		if(maMain.isCarre()){
			console.log('La main contient un CARRE');
			mesCases+=$('#ligneCarre .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.sumNumber());
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneCarre .colN').css('backgroundColor','white').off();
		}

		if(maMain.isFull()){
			console.log('La main contient un FULL');
			mesCases+=$('#ligneFull .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text('25');
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneFull .colN').css('backgroundColor','white').off();
		}

		if(maMain.isPetiteSuite()){
			console.log('La main contient une petite suite');
			mesCases+=$('#lignePetiteSuite .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text('30');
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#lignePetiteSuite .colN').css('backgroundColor','white').off();
		}

		if(maMain.isGrandeSuite()){
			console.log('La main contient une grande suite');
			mesCases+=$('#ligneGrandeSuite .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text('40');
				partie.mancheSuivante()
			});

		}
		else{
			mesCases+=$('#ligneGrandeSuite .colN').css('backgroundColor','white').off();
		}

		if(maMain.isYats()){
			console.log('La main contient un YATS');
			mesCases+=$('#ligneYats .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text('50');
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneYats .colN').css('backgroundColor','white').off();
		}

		if(maMain.isAs()){
			mesCases+=$('#ligneAs .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(1));
				console.log('coucou' + $(this).text());
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneAs .colN').css('backgroundColor','white').off();
		}

		if(maMain.is2()){
			mesCases+=$('#ligneDeux .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(2));
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneDeux .colN').css('backgroundColor','white').off();
		}

		if(maMain.is3()){
			mesCases+=$('#ligneTrois .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(3));
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneTrois .colN').css('backgroundColor','white').off();//unbind('click');
		}

		if(maMain.is4()){
			mesCases+=$('#ligneQuatre .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(4));
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneQuatre .colN').css('backgroundColor','white').off();
		}

		if(maMain.is5()){
			mesCases+=$('#ligneCinq .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(5));
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneCinq .colN').css('backgroundColor','white').off();
		}

		if(maMain.is6()){
			mesCases+=$('#ligneSix .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.addNumber(6));
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneSix .colN').css('backgroundColor','white').off();
		}

		if(maMain.isChance()){
			console.log('Vous pouvez jouer dans Chance');
			mesCases+=$('#ligneChance .colN').filter(isEmptyText).css('backgroundColor','green').off().click(function(){
				$(this).css('backgroundColor','white').off();
				$(this).text(maMain.sumNumber());
				partie.mancheSuivante()
			});
		}
		else{
			mesCases+=$('#ligneSix .colN').css('backgroundColor','white').off();
		}
	}
}

class ensembleDeDes{
	constructor(){
		this.main = [];
	}

	see(){
		return this.main;
	}

	empty(){
		this.main = [];
	}

	isEmpty(){
		let bool = this.main.length == 0 ? true : false;
		return bool;
	}

	add(element){
		this.main.push(element);
	}

	length(){
		return this.main.length;
	}

	isSameValue(){
		if(!this.isEmpty()){
			for(let score of this.main){
				if(this.main[0] != score){
					return false
				}
			}
		}
		else{
			return false;
		}
		return true
	}

	addScore(){
		if(!this.isEmpty()){
			let result = 0 ;
			for(let score of this.main){
				result += score;
			}
			return result;
		}
	}

	isBrelan(){
		if(this.main.length >= 3){
			for(let score of this.main){
				let cpt = 0 ;
				for (let score2 of this.main){
					if(score2 == score){
						cpt++
					}
				}
				if (cpt >= 3){
					return true;
				}
			}
			return false;
		}
		return false;
	}

	isCarre(){
		if(this.main.length >= 4){
			for(let score of this.main){
				let cpt = 0 ;
				for (let score2 of this.main){
					if(score2 == score){
						cpt++
					}
				}
				if (cpt >= 4){
					return true;
				}
			}
			return false;
		}
		return false;
	}

	isBrelanStrict(){
		if(this.main.length >= 3){
			for(let score of this.main){
				let cpt = 0 ;
				for (let score2 of this.main){
					if(score2 == score){
						cpt++
					}
				}
				if (cpt == 3){
					return true;
				}
			}
			return false;
		}
		return false;
	}

	isDuoStrict(){
		if(this.main.length >= 2){
			for(let score of this.main){
				let cpt = 0 ;
				for (let score2 of this.main){
					if(score2 == score){
						cpt++
					}
				}
				if (cpt == 2){
					return true;
				}
			}
			return false;
		}
		return false;
	}

	isFull(){
		if(this.main.length == 5){
			if(this.isBrelanStrict() && this.isDuoStrict()){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	isPetiteSuite(){
		if(this.main.length >= 4){
			if($.inArray(1,this.main)!= -1 && $.inArray(2,this.main)!= -1 && $.inArray(3,this.main)!= -1 && $.inArray(4,this.main)!= -1){
				return true;
			}
			if($.inArray(2,this.main)!= -1 && $.inArray(3,this.main)!= -1 && $.inArray(4,this.main)!= -1 && $.inArray(5,this.main)!= -1){
				return true;
			}
			if($.inArray(3,this.main)!= -1 && $.inArray(4,this.main)!= -1 && $.inArray(5,this.main)!= -1 && $.inArray(6,this.main)!= -1){
				return true;
			}
			return false;
		}
		else{
			return false;
		}
	}

	isGrandeSuite(){
		if(this.main.length == 5){
			if($.inArray(1,this.main)!= -1 && $.inArray(2,this.main)!= -1 && $.inArray(3,this.main)!= -1 && $.inArray(4,this.main)!= -1 && $.inArray(5,this.main)!= -1){
				return true;
			}
			if($.inArray(2,this.main)!= -1 && $.inArray(3,this.main)!= -1 && $.inArray(4,this.main)!= -1 && $.inArray(5,this.main)!= -1 && $.inArray(6,this.main)!= -1){
				return true;
			}
			return false;
		}
		else{
			return false;
		}
	}

	isYats(){
		if(this.main.length == 5 && this.isSameValue()){	
			return true;
		}
		return false;	
	}

	isAs(){
		for(let score of this.main){
			if(score == 1){
				return true;
			}
		}
		return false;
	}

	is2(){
		for(let score of this.main){
			if(score == 2){
				return true;
			}
		}
		return false;
	}

	is3(){
		for(let score of this.main){
			if(score == 3){
				return true;
			}
		}
		return false;
	}

	is4(){
		for(let score of this.main){
			if(score == 4){
				return true;
			}
		}
		return false;
	}

	is5(){
		for(let score of this.main){
			if(score == 5){
				return true;
			}
		}
		return false;
	}
	is6(){
		for(let score of this.main){
			if(score == 6){
				return true;
			}
		}
		return false;
	}

	addNumber(number){
		let cpt = 0 ;
		for( let score of this.main){
			if(score == number){
				cpt++;
			}
		}
		let result = number * cpt;
		console.log(number + '*' + cpt + ' = ' + result);
		return result;
	}
	sumNumber(){
		let result = 0;
		for( let score of this.main){
				result += score;
		}
		return result;
	}

	isChance(){
		let bool = $('#ligneChance .colN').text() == '' ? true : false ;
		return bool;
	}
}

class Lieu  {
	constructor(nom){
		this.nom = nom;
		this.De1 = null;
		this.De2 = null;
		this.De3 = null;
		this.De4 = null;
	 	this.De5 = null;
	}

	getName(){
		return this.nom;
	}

	addDe(De){
		if(De.getName()== 'deNum1'){
			this.De1 = De;
			return true;
		}
		else if(De.getName()== 'deNum2'){
			this.De2 = De;
			return true;
		}
		else if(De.getName()== 'deNum3'){
			this.De3 = De;
			return true;
		}
		else if(De.getName()== 'deNum4'){
			this.De4 = De;
			return true;
		}
		else if(De.getName()== 'deNum5'){
			this.De5 = De;
			return true;
		}
		else{
			return false;
		}
	}

	lancerDe(){
		if(this.De1 != null){
			this.De1.lancerDe();
		}
		if(this.De2 != null){
			this.De2.lancerDe();
		}
		if(this.De3 != null){
			this.De3.lancerDe();
		}
		if(this.De4 != null){
			this.De4.lancerDe();
		}
		if(this.De5 != null){
			this.De5.lancerDe();
		}
	}

	switch(element, whereIGo){
		if(this.De1 != null && element.attr('data-nameOfde') == this.De1.name){
			whereIGo.addDe(this.De1);
			this.De1 = null;
		}
		else if(this.De2 != null && element.attr('data-nameOfde') == this.De2.name){
			whereIGo.addDe(this.De2);
			this.De2 = null;
		}
		else if(this.De3 != null && element.attr('data-nameOfde') == this.De3.name){
			whereIGo.addDe(this.De3);
			this.De3 = null;
		}
		else if(this.De4 != null && element.attr('data-nameOfde') == this.De4.name){
			whereIGo.addDe(this.De4);
			this.De4 = null;
		}
		else if(this.De5 != null && element.attr('data-nameOfde') == this.De5.name){
			whereIGo.addDe(this.De5);
			this.De5 = null;
		}
		partie.refreshAffichage();
	}

	refreshAffichage(){
		let parent = this.nom == 'tapis' ? $('#lstDesLances'): $('#lstDesRetenus');
		let mesDes = [this.De1,this.De2,this.De3,this.De4,this.De5];
		let monLieu = this.nom == 'tapis' ? tapis : main;
		let maDestination = this.nom == 'tapis' ? main : tapis;
		parent.children().remove();
		for(De of mesDes){
			if(De != null && De.getScore()!= null){
				let de = $('<img data-nameOfDe="'+De.getName()+'">');
				de.attr('src','./img/'+De.getScore()+'.png').appendTo(parent);
				de.click(function(){
					monLieu.switch($(this), maDestination);
				});
			}
		}
	}

	viderDe(){
		this.De1 = null;
		this.De2 = null;
		this.De3 = null;
		this.De4 = null;
	 	this.De5 = null;
	}

	remplirDe(){
		this.addDe(de1);
		this.De1.rangerDe();
		this.addDe(de2);
		this.De2.rangerDe();
		this.addDe(de3);
		this.De3.rangerDe();
		this.addDe(de4);
		this.De4.rangerDe();
		this.addDe(de5);
		this.De5.rangerDe();
	}
}


class De{
	constructor(Nbface, num){
		this.name = num;
		this.face = Nbface;
		this.score = null;
	}

	lancerDe(){
		this.score = Math.floor(Math.random() * (Math.floor(this.face) - Math.ceil(1) +1)) + Math.ceil(1);
	}

	getScore(){
		return this.score;
	}

	getName(){
		return this.name;
	}

	rangerDe(){
		this.score = null;
	}
}



let de1 = new De(6, 'deNum1');
	
let de2 = new De(6, 'deNum2');

let de3 = new De(6, 'deNum3');

let de4 = new De(6, 'deNum4');

let de5 = new De(6, 'deNum5');

let mesDesDeDepart = [de1,de2,de3,de4,de5];

let tapis = new Lieu('tapis');

let main = new Lieu('main');

for(let de of mesDesDeDepart){
	tapis.addDe(de);
}

let partie = new Partie();

partie.setTapis(tapis);

partie.setMain(main);

let maMain = new ensembleDeDes();


$(function(){

	$('#btnLancer').click(function(){
		partie.lancer();
	});

	$('#btnRejouer').click(function(){
		partie.rejouer();
	});

	//$('.colN').filter(Additionner).css('background','red');
});