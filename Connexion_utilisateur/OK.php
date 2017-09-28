<?php
	function VerifString($cellule,$champs,&$verif,&$PassageGET){
		$cellulePropre = preg_replace('#[^[:alnum:]]#u', '', $cellule);
		if($cellulePropre!=$cellule OR is_numeric($cellule)){
			$verif=false;
			$PassageGET=$PassageGET.'Error'.$champs.'=le champs '.$champs.' doit contenir au moins une lettre et pas de caractères spéciaux&';
		}
		if(strlen($cellule)<8 OR strlen($cellule)>16){
			$verif=false;
			$PassageGET=$PassageGET.'ErrorSize'.$champs.'=le champs '.$champs.' doit être compris entre 8 et 16 caractères&';
		}
	}

	$PassageGET='nom='.$_GET['nom'].'&mdp='.$_GET['mdp'].'&confirm='.$_GET['confirm'].'&';
	$Verifcondition=true;		
	if(
		(isset($_GET['nom'])AND $_GET['nom']=="") OR
	 	(isset($_GET['mdp'])AND $_GET['mdp']=="") OR 
	 	(isset($_GET['confirm'])AND $_GET['confirm']=="")
	 	){
		$Verifcondition=false;
		$PassageGET=$PassageGET.'ErrorEmpty=Tous les champs doivent être complétés&';
	}
	VerifString($_GET['nom'],'nom',$Verifcondition,$PassageGET);
	if($_GET['mdp']!=$_GET['confirm']){
		$Verifcondition=false;
		$PassageGET=$PassageGET.'ErrorConfirm=Les mots de passes ne sont pas identiques!&';
	}
	if($Verifcondition==false){
		header("Location:interface_connection.php?".$PassageGET);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page_OK</title>
</head>
<body>
	
		<?php echo "Bonjour ".$_GET['nom']."!";?>

</body>
</html>