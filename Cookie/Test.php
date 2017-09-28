<?php
	session_start();
	if((isset($_GET['deco']))){
		session_destroy();
		header("Location:Test.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$SECURITE=time()+rand(1,1000000);
		echo "Le nombre aléatoire est $SECURITE<br>";
		if(!isset($_SESSION['Securite'])){
			$_SESSION['Securite']=$SECURITE;
			setcookie('test',$SECURITE,time()+60*3);
		}
		if(isset($_SESSION['Securite'])){echo "La Session est: ".$_SESSION['Securite']."<br>";}
		echo "Le cookie est: ".$_COOKIE['test']."<br>";
		if(isset($_SESSION['Securite']) AND isset($_COOKIE['test']) AND $_SESSION['Securite']==$_COOKIE['test']){
			echo "Vous pouvez Naviguer <br>";
		}	
		else{
			echo "Navigation impossible<br>";
		}
		echo "<p><a href='Test.php'>recharger la page</a></p>";
		echo "<p><a href='Test.php?deco=1&'>Reboot Session</a></p>";


	?>
</body>
</html>