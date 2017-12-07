<?php
class InscriptionHandler{
	/**
	 * pseudo à tester
	 * @var string
	 */
	private $pseudo;

	/**
	 * Tableau qui récupère toutes les erreurs détectées
	 * @var array
	 */
	private $error = array();

	/**
	 * Instancie un InscriptionHandler
	 * @param array $inscriptionData 
	 */
	public function __construct(array $inscriptionData){
		$this->pseudo = $inscriptionData['pseudo'];
	}

	/**
	 * fonction qui fait les vérifications et renvoie un tableau d'erreur
	 * @return [array]
	 */
	public function checkInfo(){
		$this->checkInfoPseudo();
		return $this->error;
	}

	/**
	 * Verifie la conformité du pseudo
	 */
	private function checkInfoPseudo(){
		if(!$this->isEmpty('pseudo', $this->pseudo)){
			if($this->isBetween('pseudo', $this->pseudo,MIN_PSEUDO,MAX_PSEUDO)){
				$this->isAlphaNumeric('pseudo', $this->pseudo);
			}
		}
	}


	/**
	 * Verifie que le string à tester soit alphanumerique avec des tirets
	 * @param  string  $errorName nom à donner à la clé dans le tableau erreur
	 * @param  string  $needle    string a tester
	 * @return boolean            
	 */
	private function isAlphaNumeric($errorName, $needle){
		if(!preg_match('#^[A-Za-z0-9_-]+$#', $needle)){
			$this->error[$errorName] = 'Le '.$errorName.' contient uniquement des chiffres,lettres et tirets';
			return false;
		}
		return true;
	}

	/**
	 * Verifie que le string a tester soit compris entre une borne MIN et MAX
	 * @param  string  $errorName nom à donner à la clé dans le tableau erreur
	 * @param @param  string  $needle    string a tester
	 * @param  int  $min       taille minimale du string
	 * @param  int  $max       taille maximale du string
	 * @return boolean
	 */
	private function isBetween($errorName, $needle, $min, $max){
		if($this->isSuperiorOrEqualTo($errorName, $needle,$min) && $this->isInferiorOrEqualTo($errorName, $needle, $max)){
			return true;
		}
		return false;
	}

	private function isSuperiorOrEqualTo($errorName, $needle, $min){
		if(strlen($needle)<$min){
			$this->error[$errorName] = 'Le '.$errorName.' doit contenir au moins '.MIN_PSEUDO.' caractères';
			return false;
		}
		return true;
	}

	private function isInferiorOrEqualTo($errorName, $needle, $max){
		if(strlen($needle)>$max){
			$this->error[$errorName] = 'Le '.$errorName.' doit contenir au maximum '.MAX_PSEUDO.' caractères';
			return false;
		}
		return true;
	}

	private function isEmpty($errorName, $needle){
		if(strlen($needle)==0){
			$this->error[$errorName] = 'Le '.$errorName.' ne doit pas être vide';
			return true;
		}
		return false;
	}
}