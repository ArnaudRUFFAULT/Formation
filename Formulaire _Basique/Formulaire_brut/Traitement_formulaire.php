
	<?php
		function NettoyerString($cellule,$champs,&$erreur,&$PassageGET){
			$cellulePropre = preg_replace('#[^[:alnum:]]#u', '', $cellule);
			for($i=0;$i<=9;$i++){
				$cellulePropre = str_replace($i, '', $cellulePropre);
			}
			if($cellulePropre!=$cellule OR $cellule==""){
				$PassageGET=$PassageGET.'errorNettoyerString=Le champs '.$champs.' est vide ou incorrecte&';
				$erreur++;
			}
		}


		function NettoyerAlpha($cellule,$NombreDeChiffre,$champs,&$erreur,&$PassageGET){
			$cellule=str_replace(' ', '', $cellule);
			if($cellule!=""){
				if ((!is_numeric($cellule)) OR (strlen($cellule)!=$NombreDeChiffre)){
					$PassageGET=$PassageGET.'errorNettoyerAlpha=Le champs '.$champs.' est vide ou incorrecte&';
					$erreur++;
				}
			}
		}

		function NettoyerAlphaNumerique($cellule,$champs,&$erreur,&$PassageGET){
			$cellulePropre=htmlentities($cellule);
			$cellulePropre=htmlspecialchars($cellule);
			if($cellulePropre!=$cellule){
				$PassageGET=$PassageGET.'NettoyerAlphaNumerique=Le champs '.$champs.' est incorrecte&';
				$erreur++;
			}
		}



		function verifEmail($cellule,&$erreur,&$PassageGET){
			$cellulePropre=htmlentities($cellule);
			$posArobas=strpos($cellule,'@');
			$posPoint=strrpos($cellule,'.');
			if (
				$cellule!=$cellulePropre OR
				(strlen($cellule)<5 OR strlen($cellule)>320 OR $cellule=="" )OR
				($posArobas==false OR $posPoint==false) OR
				($posArobas>$posPoint OR $posPoint-1==$posArobas) OR
				(strlen(substr($cellule, $posPoint+1))<=1)
				){
				$PassageGET=$PassageGET.'errorMail=Champs adresse mail vide ou invalide&';
				$erreur++;
			}
		}


		$erreur=0;
		$PassageGET='nom='.$_GET['nom'].'&mdp='.$_GET['mdp'].'&confirm='.$_GET['confirm'].'&';

		foreach($_POST as $key=>$valeur){
			if($key !='way'){
				$PassageGET=$PassageGET.$key.'='.$valeur.'&';
			}
			else{				
				for($i=0;$i<count($_POST['way']);$i++){
					$PassageGET=$PassageGET."way%5B%5D=".$_POST['way'][$i].'&';	
				}				
			}
		}
		foreach($_POST as $key=>$value){
			if(isset($_POST['way'])){
				if($_POST[$key]!=$_POST['way']){
					NettoyerAlphaNumerique($_POST[$key],$key,$erreur,$PassageGET);
				}
				if($_POST[$key]==$_POST['way']){
					for($i=0;$i<count($_POST['way']);$i++){
						NettoyerAlphaNumerique($_POST['way'][$i],$_POST['way'][$i],$erreur,$PassageGET);
					}
				}
			}
			if(!isset($_POST['way'])){
				NettoyerAlphaNumerique($_POST[$key],$key,$erreur,$PassageGET);
			}
		}

		NettoyerString($_POST['lastName'],'Nom',$erreur,$PassageGET);
		NettoyerString($_POST['firstName'],'Prénom',$erreur,$PassageGET);
		NettoyerAlpha($_POST['homePhone'],10,'Téléphone fixe',$erreur,$PassageGET);
		NettoyerAlpha($_POST['mobilePhone'],10,'Téléphone portable',$erreur,$PassageGET);
		if($_POST['mobilePhone']=="" AND $_POST['homePhone']==""){
			$PassageGET=$PassageGET.'errorNoNumber=Saisissez un numéro de fixe ou de portable&';
			$erreur++;
		}
		verifEmail($_POST['mail'],$erreur,$PassageGET);
		
		echo"<br>Il y a $erreur erreur(s)";

		if($erreur>0){
			header("Location:Formulaire_Basique.php?".$PassageGET);
		}
		
		
		
	?>
