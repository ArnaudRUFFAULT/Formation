<?php
class Personnage{
	private $id;
	private $nom;
	private $degats;

	public function __construct($tab){
		$this->_setNom($tab['p_nom']);
		$this->_setDegats($tab['p_degats']);
		$this->_setID($tab['p_id']);

	}

	public function __toString(){
		$class='';
		switch (true): 
			case $this->_getDegats()>75:
				$class='red';
				break;
			case $this->_getDegats()>50:
				$class='orange';
				break;			
			default:
				$class='green';
				break;
		endswitch;
		
		return '
		<table class="'.$class.'">
			<tr>
				<td>'.$this->nom.'</td>
			</tr>
			<tr>
				<td>'.$this->degats.'/100</td>
			</tr>
		</table>';
	}

	public function _getNom(){
		return $this->nom;
	}

	public function _getID(){
		return $this->id;
	}

	public function _getDegats(){
		return $this->degats;
	}

	public function _setNom($name){
		if(!is_numeric($name)){
			$this->nom=$name;
		}
	}

	public function _setDegats($degats){
		if(is_numeric($degats)){
			
			$this->degats=$degats;			
		}
	}

	public function _setID($ID){
		if(is_numeric($ID)){
			$this->id=$ID;
		}
	}

	public function Frapper(Personnage $perso){
		$m_manager= new managerPersonnage('localhost','street_fighter','root','');
		$coup=rand(0,25);
		$degat=$perso->_getDegats();
		$degat=$degat+$coup;
		if($degat<100){
			$m_manager->Update($perso->_getID(),'p_degats',$degat);
			return $etat=array('blesse',$perso->_getNom(),$coup);	
		}
		else{
			$this->_setDegats(0);
			$_SESSION['m_personnage']['p_degats']=$this->_getDegats();
			$m_manager->Update($this->_getID(),'p_degats',$this->_getDegats());
			$personn=$perso->_getID();			
			$m_manager->Supprimer($perso,$personn);
			return $etat=array('mort',$perso->_getNom());
		}
	}
}