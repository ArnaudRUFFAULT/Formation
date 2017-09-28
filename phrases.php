<?php

	require('FPDF.php');
	class Phrase{
	 	private $sujet;
	 	private $verbe;
	 	private $complement;
	 	private $finDePhrase;
	 	
		function __construct(){
			$qui=array('Je','Tu','Il','Nous','Vous','Ils','Un clown', 'Des suricates albinos','Les power rangers et moi','Toi et Pikachu','Ta grand mere et Naruto','Micheal Jackson');
			$comment=array('vais','pars','cours','saute','rage','combat','danse','lance des boulettes de riz');
			$ou=array('au cinema','a l\'hopital','a la boulangerie',"au lycee","en prison","en vacances",'a la poste',' a l\'hotel','a la plage','a la montagne', 'a Obectif 3W','a pole emploi');
			$bonus=array("avec une epee",'en moonwalk','en chantant','en calecon','avec un chat', 'en mangeant des gnocchis','en pleurant','en applaudissant','avec des chouquettes','en kimono','en pyjama','en charentaises','en jouant a chifumi','en récitant le code civil');

	 		$this->sujet=$qui[rand(0,count($qui)-1)];
	 		$this->verbe=$comment[rand(0,count($comment)-1)];
	 		$this->complement=$ou[rand(0,count($ou)-1)];
	 		$this->finDePhrase=$bonus[rand(0,count($bonus)-1)];
	 	
	 	}
	 	public function affiche_phrase(){
	 		$contenu =  $this->sujet.' '.$this->verbe.' '.$this->complement.' '.$this->finDePhrase.".";
	 		return $contenu;
	 	}

	 	public function conjuger(){
	 		if($this->verbe=='vais'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="vas";
		 		}
		 		else if($this->sujet == "Il" OR $this->sujet == "Un clown" OR $this->sujet == "Micheal Jackson"){
		 			$this->verbe="va";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="allons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="allez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="vont";
		 		}
		 	}
		 	if($this->verbe=='pars'){
		 		if($this->sujet == "Il" OR $this->sujet == "Un clown" OR $this->sujet == "Micheal Jackson"){
		 			$this->verbe="part";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="partons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="partez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="partent";
		 		}
		 	}
		 	if($this->verbe=='cours'){
		 		if($this->sujet == "Il" OR $this->sujet == "Un clown" OR $this->sujet == "Micheal Jackson"){
		 			$this->verbe="court";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="courons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="courez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="courent";
		 		}
		 	}
		 	if($this->verbe=='saute'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="sautes";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="sautons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="sautez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="sautent";
		 		}
		 	}
		 	if($this->verbe=='lance des boulettes de riz'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="lances des boulettes de riz";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="lancons des boulettes de riz";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="lancez des boulettes de riz";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="lancent des boulettes de riz";
		 		}
		 	}
		 	if($this->verbe=='danse'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="danses";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="dansons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="dansez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="dansent";
		 		}
		 	}

		 	if($this->verbe=='rage'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="rages";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="rageons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="ragez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="ragent";
		 		}
		 	}
		 	if($this->verbe=='combat'){
		 		if($this->sujet == "Tu"){
		 			$this->verbe="combats";
		 		}
		 		else if($this->sujet == "Nous" OR $this->sujet == 'Les power rangers et moi'){
		 			$this->verbe="combattons";
		 		}
		 		else if($this->sujet == "Vous" OR $this->sujet == 'Toi et Pikachu'){
		 			$this->verbe="combattez";
		 		}
		 		else if($this->sujet == "Ils" OR $this->sujet == "Des suricates albinos" OR $this->sujet=='Ta grand mere et Naruto'){
		 			$this->verbe="combattent";
		 		}
		 	}
	 	}
	 }
	
	class Document{
		private $phrases = array();

		public function addPhrase($nombre){
			$string="";
			for ($i=0; $i < $nombre; $i++) { 
				$phrase= new Phrase();
				$phrase->conjuger();
				$contenu=$phrase->affiche_phrase();
				$string=$string.$contenu.PHP_EOL;
				$this->phrases[]=$contenu;
			}
			return $string;
		}

		public function afficherDocument(){
			for ($i=0; $i < count($this->phrases); $i++) { 
				echo $this->phrases[$i]."<br>";
			}
		}	
	}

	$doc= new Document();
	$recupstring=$doc->addPhrase(20);

	$doc2= new Document();
	$recupstring2=$doc->addPhrase(10);
	
	



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(204,0,0);
$pdf->multiCell(300,8,$recupstring);
$pdf->AddPage();
$pdf->SetY(15);
$pdf->SetX(25);
$pdf->SetFont('Arial','i',16);
$pdf->SetTextColor(0,51,102);
$pdf->multiCell(200,16,$recupstring2);
$pdf->Output();





?>