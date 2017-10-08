<?php
class managerPersonnage{
	private $m_pdo;

	public function __construct($host, $db, $user, $pass){
		$this->m_pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $pass);
		$this->m_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	private function MakeStatement($sql, $params = array())
	{
		$statement = false;
		if(count($params) == 0)
		{
			$statement = $this->m_pdo->query($sql);
		}
		else
		{
			if(($statement = $this->m_pdo->prepare($sql)) !== false)
			{
				foreach ($params as $placeholder => $value)
				{
					if($statement->bindValue($placeholder, $value=='' ? null : $value) === false)
						return false;
				}
				if(!$statement->execute())
				{
					return false;
				}
			}
		}
		
		return $statement;
	}

	private function MakeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
	{
		$statement = $this->MakeStatement($sql, $params);

		if($statement === false)
		{
			return false;
		}

		$data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
		$statement->closeCursor();

		return $data;
	}

	public function getAllFighters(){
		$fighters=array();
		$datas=$this->MakeSelect('SELECT p_nom,p_degats,p_id FROM personnage ORDER BY p_id');
		foreach ($datas as  $unique) {
			$fighters[]=new personnage ($unique);
		}
		return $fighters;
	}

	public function Update($persoID,$entree,$statistique){
		$this->m_pdo->query('UPDATE personnage SET '.$entree.' = '.$statistique.' WHERE p_id = '.$persoID);
		
	}
 
	public function Supprimer(Personnage $perso,$personn){
		$this->m_pdo->query('DELETE FROM personnage WHERE p_id='.$personn);
		
	}

	public function Ajouter($perso){
		$bool=false;
		$datas=$this-> getAllFighters();
		foreach ($datas as $key => $value) {
			if ($value->_getNom()==$perso){
			$bool=true;
			}
		}
		if($bool==false){
			$req=$this->m_pdo->prepare('INSERT INTO personnage (p_nom,p_degats) VALUES (:nom, :degats)');
		$req->bindParam(':nom',$perso);
		$req->bindValue(':degats',0);
		$req->execute();
		}
		
	}
}