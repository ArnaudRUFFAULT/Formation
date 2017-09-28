<?php
	session_start();

	if(isset($_GET['deco'])){
		session_destroy();
		header("Location:Index.php");
	}
	if(isset($_GET['viderpanier'])){
		unset($_SESSION['Panier']);
		$_SESSION['Total']="";
		header("Location:Index.php");
	}
	if(!isset($_SESSION['PrixArticle_1'])){
		$_SESSION['PrixArticle_1']=420;
	}
	if(!isset($_SESSION['PrixArticle_2'])){
		$_SESSION['PrixArticle_2']=60;
	}
	if(!isset($_SESSION['PrixArticle_3'])){
		$_SESSION['PrixArticle_3']=150;
	}
	if(!isset($_SESSION['PrixArticle_4'])){
		$_SESSION['PrixArticle_4']=25;
	}
	echo curl_init('Index.php');	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<meta charset="utf-8">

</head>
<body>
	<?php
		include 'Header.php';
	?>
	<div class="listeArticle">
		<a href="Article_1.php"><img src="Images/LapTop.png" alt="LapTop"></a>
		<a href="Article_2.php"><img src="Images/Clavier.jpg" alt="Clavier"></a>
		<a href="Article_3.php"><img src="Images/Souris.jpg" alt="Souris"></a>
		<a href="Article_4.php"><img src="Images/Casque.jpg" ></a>
	</div>
	<?php
		include 'Footer.php';
	?>
</body>
</html>