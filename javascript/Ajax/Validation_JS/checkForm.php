<?php
$error= array();
$message = 'Tout es Ok!';


function empty($string,$label){
	if(empty($string)){
	$error[$label]='Le ou la '.$label.' doit être remplie!';
}

if(empty($error)){
	echo $message;
}
else{
	foreach ($error as $key => $value) {
		echo $key .' : ' . $value . '<br />';
	}
}