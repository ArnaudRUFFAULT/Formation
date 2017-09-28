<?php
session_start();
echo "<br>";
//print_r($_SESSION);
echo "<br>";
if(isset($_GET['reinitialiser'])){
	session_destroy();
	header("Location:Combat.php");
}
class Personnage{
	private $name;
	private $PdV;
	private $force;
	private $degats;
	


	function __construct($name,$forceInitiale,$PointDeVie){
		$this->setForce($forceInitiale);
		$this->degats=0;
		$this->name=$name;
		$this->setPdV($PointDeVie);
	}

	function setForce($force){
		if(is_numeric($force)){
			$this->force=$force;
		}
		else{
			echo "La force doit être un nombre!<br>";
		}
	}

	function setPdV($PointDeVie){
		if(is_numeric($PointDeVie)){
			$this->PdV=$PointDeVie;
		}
		else{
			echo "La vie doit être un nombre!<br>";
		}
	}

	function setDegats($degats){
		if(is_numeric($degats)){
			$this->degats=$this->degats;
		}
		else{
			echo "Les degats doivent être un nombre!<br>";
		}
	}
	function force(){
		echo $this->force;
		return $this->force;
	}

	function name(){
		echo $this->name."<br>";
		return $this->name;
	}

	function degats(){
		echo $this->degats."<br>";
		return $this->degats;
	}
	function getPdV(){
		return $this->PdV;
	}

	function frapper(Personnage $PersoAFrapper){
		switch ($this->force) {
			case $this->force<=25:
				$PersoAFrapper->degats=$PersoAFrapper->degats+$this->force;
				$PersoAFrapper->PdV=$PersoAFrapper->PdV-$PersoAFrapper->degats;
				echo "echec critique!<br>";
				echo $this->name." n'inflige que ".$this->force." à ".$PersoAFrapper->name."!<br>";
				break;
			
			case $this->force>25 AND $this->force<75:
				$PersoAFrapper->degats=$PersoAFrapper->degats+$this->force;
				$PersoAFrapper->PdV=$PersoAFrapper->PdV-$PersoAFrapper->degats;
				echo $this->name." inflige ".$this->force." point de dégats à ".$PersoAFrapper->name."!<br>";
				break;
			case $this->force>=75:
				echo $this->name." inflige ".$this->force." point de dégats à ".$PersoAFrapper->name."!<br>";
				echo "coup critique!<br>";
				$PersoAFrapper->degats=$PersoAFrapper->degats+$this->force;
				$PersoAFrapper->PdV=$PersoAFrapper->PdV-$PersoAFrapper->degats;
				break;
		}
	
		
	}
	function AfficherStatPerso(){
		$TabPerso= get_object_vars($this);
		foreach ($TabPerso as $key => $value) {
				echo "<span style='text-decoration:underline;'>".$key." </span>: ".$value."<br>";
			}
	}

	function punchlineAttaquant(){
		$punchline=array('Je t\'ai bien eu','Tu vas mourir!','Mécréant','Vil gredin!','Sombre crétin!','Sale gueu!');
		echo $this->name." cria: ".$punchline[rand(0,count($punchline)-1)]."<br>";
	}
	function punchlineDefenseur(){
		$punchline=array('Je me vengerai','Tu vas le regretter!','La vengeance est un plat qui se mange froid!','Rira bien qui rira la dernier!','Tu ne perds rien pour attendre');
		echo $this->name." repondit alors: ".$punchline[rand(0,count($punchline)-1)]."<br>";
	}
}
if(!isset($_SESSION['Paul'])){
	$Paul=new Personnage('Paul',rand(0,100),rand(100,300));
	$_SESSION['Paul']=$Paul;
	$_SESSION['PaulDepart']=clone($Paul);
}
if(!isset($_SESSION['Julie'])){
	$Julie=new Personnage('Julie',rand(0,100),rand(100,300));
	$_SESSION['Julie']=$Julie;
	$_SESSION['JulieDepart']=clone($Julie);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Combat</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			text-align: center;
		}
		section{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
		}
	</style>
</head>
<body>
<?php

echo "<section>";
	echo "<div class='Perso'>";
		$_SESSION['PaulDepart']->AfficherStatPerso();
		echo "<a href='Combat.php?taperqui=Julie'>Taper Julie</a>";
	echo "</div>";
	echo "<div class='Perso'>";
		$_SESSION['JulieDepart']->AfficherStatPerso();
		echo "<a href='Combat.php?taperqui=Paul'>Taper Paul</a>";
	echo "</div>";
echo "</section>";


if($_SESSION['Julie']->getPdV()<=0){
	echo "Julie a perdu, Bravo Paul!";
}

if($_SESSION['Paul']->getPdV()<=0){
	echo "Paul a perdu, Bravo Julie!";

}

if(isset($_GET['taperqui']) AND $_GET['taperqui']=='Julie' AND $_SESSION['Paul']->getPdV()>0 AND $_SESSION['Julie']->getPdV()>0){
	$_SESSION['Paul']->frapper($_SESSION['Julie']);
	$_SESSION['Paul']->punchlineAttaquant();
	$_SESSION['Julie']->punchlineDefenseur();
	echo "<section>";
		echo "<div class='Perso'>";
		$_SESSION['Paul']->AfficherStatPerso();
	echo "</div>";
		echo "<div class='Perso'>";
		$_SESSION['Julie']->AfficherStatPerso();
	echo "</div>";
	echo "</section>";

	
}
if(isset($_GET['taperqui']) AND $_GET['taperqui']=='Paul' AND $_SESSION['Paul']->getPdV()>0 AND $_SESSION['Julie']->getPdV()>0){
	$_SESSION['Julie']->frapper($_SESSION['Paul']);
	$_SESSION['Julie']->punchlineAttaquant();
	$_SESSION['Paul']->punchlineDefenseur();
	echo "<section>";
		echo "<div class='Perso'>";
		$_SESSION['Paul']->AfficherStatPerso();
	echo "</div>";
		echo "<div class='Perso'>";
		$_SESSION['Julie']->AfficherStatPerso();
	echo "</div>";
	echo "</section>";

	
}



echo "<p><a href='Combat.php?reinitialiser=1&'>Recommencer</a></p>" 
?>

</body>
</html>
