<!DOCTYPE html>
<html>
<head>
	<title>Calculatrice</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		print_r($_POST);
	?>
	<form action="" name="calculette" method="POST">
		<input type="text" name="nombre1" placeholder="ex:7" value=
		<?php 
			if(isset($_POST["nombre1"])){
				echo"'".$_POST["nombre1"]."'";
			}
			else{
				echo "";
			}
		?>
		>
		<select name="operateur">
			<option value="+">+</option>
			<option value="-">-</option>
			<option value="*">x</option>
			<option value="/">÷</option>
		</select>
		<input type="text" name="nombre2" placeholder="ex:42" value=
		<?php 
			if(isset($_POST["nombre2"])){
				echo"'".$_POST["nombre2"]."'";
			}
			else{
				echo "";
			}
		?>
		>
		<input type="submit" value="=">
		<?php
			if(isset($_POST["nombre1"])){
				$_POST["nombre1"]=str_replace(',', '.', $_POST["nombre1"]);
				$_POST["nombre1"]=str_replace(' ', '', $_POST["nombre1"]);
			}
			if (isset($_POST["nombre2"])){
				$_POST["nombre2"]=str_replace(',', '.', $_POST["nombre2"]);
				$_POST["nombre2"]=str_replace(' ', '', $_POST["nombre2"]);
			}
			if(isset($_POST["nombre1"])AND isset($_POST["nombre2"])){
				if(is_numeric($_POST["nombre1"]) AND is_numeric($_POST["nombre2"])){
					$resultat="";
					switch($_POST["operateur"]){
						case "+":
							$resultat=$_POST["nombre1"]+$_POST["nombre2"];
							$resultat=str_replace('.', ',', $resultat);
							break;
						case "-":
							$resultat=$_POST["nombre1"]-$_POST["nombre2"];
							$resultat=str_replace('.', ',', $resultat);
							break;
						case "*":
							$resultat=$_POST["nombre1"]*$_POST["nombre2"];
							$resultat=str_replace('.', ',', $resultat);
							break;
						case "/":
							if($_POST["nombre2"]==0){
							$resultat='On ne peut pas diviser par zero!';
							break;
							}
							else{
							$resultat=$_POST["nombre1"]/$_POST["nombre2"];
							$resultat=str_replace('.', ',', $resultat);
							break;
							}
					}
				}
				else{
					$resultat="Veuillez saisir 2 nombres!";
				}
			}
		?>
		<span>
			<?php 
				if(isset($resultat)){
					echo"$resultat";


				}
				else{
					echo"";
				}
			?>
		</span>
		<p><textarea name="historique" cols="60" rows="10">

		</textarea></p>

	</form>
	




</body>
</html>