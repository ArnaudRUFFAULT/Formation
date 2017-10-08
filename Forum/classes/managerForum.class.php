<?php
class managerForum{

	private $m_pdo;
	private static $m_instance = NULL;
	const PAGE_INEXISTANTE = true;


	public static function GetManagerForum(){
		if(is_null(self::$m_instance)){
			self::$m_instance = new self('localhost','cours_forum','root','');
		}

		return self::$m_instance;
	}

	private function __construct($host, $db, $user, $pass){
		$this->m_pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $pass);
		$this->m_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	private function MakeStatement($sql, $params = array()){
		$statement = false;
		if(count($params) == 0){
			$statement = $this->m_pdo->query($sql);
		}
		else{
			if(($statement = $this->m_pdo->prepare($sql)) !== false)
			{
				foreach ($params as $placeholder => $value){
					if($statement->bindValue($placeholder, $value==='' ? null : $value) === false)
						return false;
				}
				if(!$statement->execute()){
					return false;
				}
			}
		}
		
		return $statement;
	}

	private function MakeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL){
		$statement = $this->MakeStatement($sql, $params);

		if($statement === false)
		{
			return false;
		}

		$data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
		$statement->closeCursor();

		return $data;
	}

	public function GetAllConversations(){
		try{
			$datas = $this->MakeSelect('SELECT c_id, DATE_FORMAT(c_date,"%d %m %Y") AS date,DATE_FORMAT(c_date,"%H:%i:%s") AS heure , count(m_id) AS NbMessage , c_termine FROM conversation LEFT JOIN message ON c_id = m_conversation_fk GROUP BY c_id');
		foreach ($datas AS $data) {
			$conversations[] = $data;
		}
		return $conversations;

		}
		catch(Exception $e){
			echo "Ca marche pas";
		}
		
	}

	public function GetEtatConversation($C_ID){
		try{
			$data = $this->MakeSelect('SELECT c_termine FROM conversation WHERE  c_id = '.$C_ID);		
		$data = $data[0];

		$bool = $data['c_termine'] == 1 ? true : false;
		return $bool;
		}
		catch(Exception $e){
			echo "Ca marche pas";
		}
		
	}

	public function GetAllMessagebyConversation($C_ID){
		$convExist=$this->IssetConversation($C_ID);
		if($convExist){
			try{
				$messages=array();
				$datas = $this->MakeSelect('SELECT m_id, DATE_FORMAT(m_date,"%d %m %Y") AS date,DATE_FORMAT(m_date,"%H:%i:%s") AS heure , CONCAT(u_nom," ",u_prenom) AS auteur, m_contenu AS message FROM message INNER JOIN user ON m_auteur_fk = u_id WHERE m_conversation_fk = '.$C_ID.' ORDER BY m_date');
			foreach ($datas AS $data) {
				$messages[] = $data;
			}
			return $messages;
			}
			catch(Exception $e){
				echo "ca marche pas";
			}
		}
		else{
			$this->RedirectionErreur404();
		}			
	}

	private function IssetConversation($C_ID){
		try{
			$data = $this->MakeSelect('SELECT c_id FROM conversation WHERE c_id='.$C_ID);
			if(!empty($data)){
				return true;
			}
			else{
				return false;
			}
		}
		catch(Exception $e){
			echo "ca marche pas";
		}
	}

	private function RedirectionErreur404(){
		header('HTTP/1.0 404 Not Found');
    	exit;
	}

	private function IssetPage($C_ID,$Page){
		$nbPageRelle = $this->GetNbrPage($C_ID);
		$PageBool = $nbPageRelle >= $Page ? true : false ;
		return $PageBool;
	}

	public function GetNbrPage($C_ID){
		try{
			$datas = $this->MakeSelect('SELECT count(m_id) AS NbMessage FROM conversation INNER JOIN message ON c_id = m_conversation_fk WHERE c_id='.$C_ID);
			$NbMessages = $datas[0];
			$NbPage = $NbMessages['NbMessage'] % 20 == 0 ? ($NbMessages['NbMessage'] / 20) : (floor($NbMessages['NbMessage'] / 20))+1;
			return $NbPage;
		}
		catch(Exception $e){
			echo "ca marche pas";
		}
	}
	public function GET20Messages($C_ID,$Page,$tri){
		$convExist=$this->IssetConversation($C_ID);
		if($convExist){
			$MaPageExist = $this ->IssetPage($C_ID,$Page);
			if($MaPageExist){
				try{
					$start=($Page*20)-20;
					$messages=array();
					switch ($tri) {
						case 'date':
							$datas = $this->MakeSelect('SELECT m_id, DATE_FORMAT(m_date,"%d %m %Y") AS date,DATE_FORMAT(m_date,"%H:%i:%s") AS heure , CONCAT(u_nom," ",u_prenom) AS auteur, m_contenu AS message FROM message INNER JOIN user ON m_auteur_fk = u_id WHERE m_conversation_fk = '.$C_ID.' ORDER BY m_date LIMIT 20 OFFSET '.$start);
							break;
						case 'id':
							$datas = $this->MakeSelect('SELECT m_id, DATE_FORMAT(m_date,"%d %m %Y") AS date,DATE_FORMAT(m_date,"%H:%i:%s") AS heure , CONCAT(u_nom," ",u_prenom) AS auteur, m_contenu AS message FROM message INNER JOIN user ON m_auteur_fk = u_id WHERE m_conversation_fk = '.$C_ID.' ORDER BY m_id LIMIT 20 OFFSET '.$start);
							break;
						case 'auteur':
							$datas = $this->MakeSelect('SELECT m_id, DATE_FORMAT(m_date,"%d %m %Y") AS date,DATE_FORMAT(m_date,"%H:%i:%s") AS heure , CONCAT(u_nom," ",u_prenom) AS auteur, m_contenu AS message FROM message INNER JOIN user ON m_auteur_fk = u_id WHERE m_conversation_fk = '.$C_ID.' ORDER BY u_nom LIMIT 20 OFFSET '.$start);
							break;
						
					}
				foreach ($datas AS $data) {
					$messages[] = $data;
				}
				return $messages;
				}
				catch(Exception $e){
					echo "ca marche pas";
				}
			}			
		}
		else{
			$this->RedirectionErreur404();
		}
		
	}

	public function ConnexionUser($login,$id){
		try{
			$datas=$this->MakeSelect('SELECT u_id,u_prenom,u_nom FROM user WHERE u_login ="'.$login.'" AND u_id = '.$id);
				$datas=$datas[0];
			return $datas;

		}
		catch(Exception $e){
		}
		
	}

	public function AddMessage($user,$conversation,$message){
		try{
			$sql = 'INSERT INTO message (m_contenu, m_date, m_auteur_fk, m_conversation_fk) VALUES (:contenu, :laDate, :auteur, :conversation)';
		$data = array('contenu' =>$message , 'laDate' =>date('Y-m-d H:i:s') , 'auteur' =>$user , 'conversation' =>$conversation);

		$this->MakeStatement($sql, $data);
		}
		catch(Exception $e){
			echo "Erreur lors de l'ajout du message <hr />";
		}
		
	}

	public function HistoriqueMessage($user){
		try{
			$monHistorique=array();
			$datas=$this->MakeSelect('SELECT c_id,DATE_FORMAT(m_date,"%d %m %Y") AS date,DATE_FORMAT(m_date,"%H:%i:%s") AS heure,m_contenu FROM message INNER JOIN conversation ON m_conversation_fk = c_id WHERE m_auteur_fk ='.$user.' ORDER BY m_date DESC');
			foreach ($datas as $key => $value) {
				$monHistorique[]=$value;
			}
			return $monHistorique;

		}
		catch(Exception $e){
		}
	}
		
}