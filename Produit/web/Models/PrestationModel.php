<?php
class PrestationModel extends CoreModel{
	public function getPrestations(){
		$sql = 'SELECT * FROM service WHERE s_id != 4';
		$request = $this->makeSelect($sql);
		$services = array();
		foreach ($request as $key => $value) {
			$services[] = $value;
		}
		return $services;
	}
}