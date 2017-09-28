<?php
	


	if( !defined( 'PHP_EOL') ) { // Si la constante PHP_EOL n'existe pas (http://php.net/manual/fr/reserved.constants.php), 
	    if( strtoupper( substr( PHP_OS, 0, 3 ) ) == 'WIN' ) { // Si la version du système d'exploitation (fournie par la constantes pré-définie PHP_OS) correspond à un noyau Windows,
	        define( 'PHP_EOL', "\r\n" ); // On définit la constante avec les caractères Windows.
	    } else { // Sinon,
	        define( 'PHP_EOL', "\n" ); // On définit la constante avec les caractères UNIX.
	    }
	}
	/*	$test=fopen($file, 'r+');
	fwrite($test, $fileVar.$fileVar2);
	fseek($test,0);
	echo fgets($test);
	fseek($test,6);
	echo fgets($test);
	fclose($test);*/
	$file='Test3.txt';
	$fileVar="Jean".PHP_EOL;
	$fileVar2="Bernard";
	file_put_contents($file, $fileVar.$fileVar2);
	echo file_get_contents($file);
	/*$test3=fopen($file, 'r');
	while(!feof($test3)){
		echo nl2br(fgets($test3));
	}
	fclose($test3);*/

?>