<?php
function WriteSpeach(&$tab,$NbSentence){
	if($NbSentence<1 || $NbSentence== NULL){
		$NbSentence=1;
	}
	if($NbSentence>count($tab['debut'])){
		$NbSentence=count($tab['debut']);
	}
	for ($i=0; $i < $NbSentence; $i++) { 
		echo WriteSentence($tab).'<br />';
	}
}
function PickRandomPartOfSentence(&$tab){
	$rand = rand(0,count($tab)-1);
	$sentence = $tab[$rand];
	unset($tab[$rand]);
		
	$tab = array_merge($tab);
	return $sentence;


}
function PickIntroductionOfSentence(&$tab){
	$sentence = $tab[0];
	unset($tab[0]);		
	$tab = array_merge($tab);
	return $sentence;
}

function WriteSentence(&$tab){
	if(count($tab['debut']) == 8){
		$debut = PickIntroductionOfSentence($tab['debut']);
	}
	else{
		$debut = PickRandomPartOfSentence($tab['debut']);
	}	
	$partie1 =PickRandomPartOfSentence($tab['partie1']);
	$partie2 =PickRandomPartOfSentence($tab['partie2']);
	$fin =PickRandomPartOfSentence($tab['fin']);
	return $debut . ' ' . $partie1 . ' ' . $partie2 . ' ' . $fin ;
}

$nameFile='./data.txt';

if(file_exists($nameFile)){
	$Phrase=array();
	$Phrase['debut'] =array();
	$Phrase['partie1']=array();
	$Phrase['partie2']=array();
	$Phrase['fin']=array();
	$line = file($nameFile);
	foreach ($line as $key => $value) {
		if($key < floor(count($line)*0.25)){
			$Phrase['debut'][] = $value;
		}
		if($key > floor(count($line)*0.25) && $key < floor(count($line)*0.5)){
			$Phrase['partie1'][] = $value;
		}
		if($key > floor(count($line)*0.5) && $key < floor(count($line)*0.75)){
			$Phrase['partie2'][] = $value;
		}
		if($key > floor(count($line)*0.75)){
			$Phrase['fin'][] = $value;
		}
	}
 
	WriteSpeach($Phrase,5);
}
else{
	echo 'Aucun fichier ne porte ce nom <br />';
}




