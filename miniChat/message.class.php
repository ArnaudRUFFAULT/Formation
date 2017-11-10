<?php
class Message implements JsonSerializable{
	private $m_id;
	private $m_auteur;
	private $m_date;
	private $m_contenu;

	public function __construct(array $data){
		$this->m_id = $data['m_id'];
		$this->m_auteur = $data['m_auteur'];
		$this->m_date = $data['m_date'];
		$this->m_contenu = $data['m_contenu'];
	}

	public function jsonSerialize() {
		$array = array(
			'm_id'=>$this->m_id,
			'm_auteur'=>$this->m_auteur,
			'm_date'=>$this->m_date,
			'm_contenu'=>$this->m_contenu
			);
        return $array;
    }

    /**
     * @return mixed
     */
    public function getMId()
    {
        return $this->m_id;
    }

    /**
     * @param mixed $m_id
     *
     * @return self
     */
    public function setMId($m_id)
    {
        $this->m_id = $m_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMAuteur()
    {
        return $this->m_auteur;
    }

    /**
     * @param mixed $m_auteur
     *
     * @return self
     */
    public function setMAuteur($m_auteur)
    {
        $this->m_auteur = $m_auteur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMDate()
    {
        return $this->m_date;
    }

    /**
     * @param mixed $m_date
     *
     * @return self
     */
    public function setMDate($m_date)
    {
        $this->m_date = $m_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMContenu()
    {
        return $this->m_contenu;
    }

    /**
     * @param mixed $m_contenu
     *
     * @return self
     */
    public function setMContenu($m_contenu)
    {
        $this->m_contenu = $m_contenu;

        return $this;
    }
}