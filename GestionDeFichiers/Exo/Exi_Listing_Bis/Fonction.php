<?php
	function ScanDoss($path){
		if(is_file($path)){
			echo $path;
			//FindCSV($path);
		}
		else if(is_dir($path)){
			opendir($path);
			$TabScan=scandir($path);
			foreach ($TabScan as $key => $value) {
				ScanDoss($path.'\\'.$value);
			}
		}
	}

	$chemin = 'Z:\2017-05\Php_Exercices\Semaine-31\mardi_01_08';
	ScanDoss($chemin);
?>