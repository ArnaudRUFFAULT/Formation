<?php
	session_start();
	echo "<br>";
	print_r($_SESSION);
	echo "<br>";
	print_r($_POST);
	if(!isset($_POST['Modif'])){
		if(!isset($_SESSION['Total'])){$_SESSION['Total']==0;}
		if(isset($_SESSION['Supprimer'])){

		}
		else if(!isset($_SESSION['Panier'][$_POST['Article']]) AND(isset($_POST['Article']))){
			$_SESSION['Panier'][$_POST['Article']]=$_POST['Article'];
			$_SESSION['Panier'][$_POST['Article']]=array();
			$_SESSION['Panier'][$_POST['Article']]['Quantite']=$_POST['Nombre'];
			$_SESSION['Panier'][$_POST['Article']]['Montant']=$_POST['Nombre']*$_SESSION['Prix'.$_POST['Article']];
			$_SESSION['Total']=$_SESSION['Total']+$_POST['Nombre']*$_SESSION['Prix'.$_POST['Article']];
			header("Location:".$_POST['Article'].".php");
		}
		else if(isset($_SESSION['Panier'][$_POST['Article']])){
			$_SESSION['Panier'][$_POST['Article']]['Quantite']=$_SESSION['Panier'][$_POST['Article']]['Quantite']+$_POST['Nombre'];
			$_SESSION['Panier'][$_POST['Article']]['Montant']=$_SESSION['Panier'][$_POST['Article']]['Montant']+($_POST['Nombre']*$_SESSION['Prix'.$_POST['Article']]);
			$_SESSION['Total']=$_SESSION['Total']+$_POST['Nombre']*$_SESSION['Prix'.$_POST['Article']];
			header("Location:".$_POST['Article'].".php");
		}
	}
	if(isset($_POST['Modif'])){
		foreach ($_SESSION['Panier'] as $key => $value) {
			$difference=$_POST[$key.'_Quantite']-$_SESSION['Panier'][$key]['Quantite'];
			if ($_POST[$key.'_Quantite']==0){
				$_SESSION['Total']=$_SESSION['Total']-$_SESSION['Panier'][$key]['Quantite']*$_SESSION['Prix'.$key];
				unset($_SESSION['Panier'][$key]);
				header("Location:Index.php");
			}
			else if ($difference<0){
				$_SESSION['Total']=$_SESSION['Total']+$difference*$_SESSION['Prix'.$key];
				$_SESSION['Panier'][$key]['Quantite']=$_POST[$key.'_Quantite'];
				$_SESSION['Panier'][$key]['Montant']=$_POST[$key.'_Quantite']*$_SESSION['Prix'.$key];
				header("Location:Index.php");
				
			}
			else if ($difference>0){
				$_SESSION['Total']=$_SESSION['Total']-$difference*$_SESSION['Prix'.$key];
				$_SESSION['Panier'][$key]['Quantite']=$_POST[$key.'_Quantite'];
				$_SESSION['Panier'][$key]['Montant']=$_POST[$key.'_Quantite']*$_SESSION['Prix'.$key];
				header("Location:Index.php");
			}
		}
	}
		
?>