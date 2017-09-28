<!DOCTYPE html>
<html>
<head>
	<title>FormulaireStylise</title>
	<meta charset="utf-8">
	<style>
		body{
			background-color: black;
		}
		form{
			display: flex;
			margin: auto;
			flex-direction: column;
			max-width: 800px;
			background-color: #26a5cf;
			text-align: center;
		}
		h1,h2,.button{
			text-align: center;
			font-family: verdana;
			color:white;
			font-weight: bolder;
			text-decoration: underline;
		}
		h3{	position: relative;
			left:-10px;
			padding:5px 5px;
			margin: 5px 0px;
			font-family: cursive;
			color:#4c4f40;

		}
		input{
			border-radius: 20px;
			text-align: center;
			outline:none;
			font-family: verdana;
		}
		select{
			border-radius: 20px;
			outline:none;
			font-family: verdana;
		}
		textarea{
			border-radius: 20px;
			outline:none;
			font-family: verdana;
		}
		label{
			color:#75241a;
			font-weight: bolder;
		}


		.section{
			margin:10px 15px;
			padding: 10px 10px;
			box-shadow: 5px 5px black;
			border-radius: 20px;
			background-color: white;
		}
		.adresse{
			display: flex;
			align-items: top;
			justify-content: space-around;
		}
		.adresse .adresseTextarea{
			display: inline-block;
		}
		.adresse .adresseTextarea *{
			vertical-align: top;
			
		}
		

	</style>
</head>
<body>
	<?php
		print_r($_GET);
	?>
	<form action="Traitement_formulaire_stylise.php" method="POST">
		<h1>Formulaire de Contact</h1>
		<div class="donnes section">
			<h2>Données personelles</h2>
			<div>
				<label><h3>Civilité:</h3></label>
		    	<input id="Mr" name="Civilite" type="radio" value="Mr" <?php if(isset($_GET['Civilite']) AND $_GET['Civilite']=='Mr'){echo"checked";}?> />
			    <label class="inline" for="Mr">Monsieur</label>||
			    <input id="Mme" name="Civilite" type="radio" value="Mme" <?php if(isset($_GET['Civilite']) AND $_GET['Civilite']=='Mme'){echo"checked";}?>/>
			    <label class="inline" for="mme">Madame</label>||
			    <input id="Mlle" name="Civilite" type="radio" value="Mlle" <?php if(isset($_GET['Civilite']) AND $_GET['Civilite']=='Mlle'){echo"checked";}?>/>
			    <label class="inline" for="Mlle">Mademoiselle</label>
			</div>
			<label for="lastName"><h3>Nom</h3></label>
			<input type="text" name="lastName" value=<?php if(isset($_GET['lastName'])){echo"".$_GET['lastName'];} ?>>
			<label for="firstName"><h3>Prénom</h3></label>
			<input type="text" name="firstName" value=<?php if(isset($_GET['firstName'])){echo"".$_GET['firstName'];} ?> >
			<label><h3>Date de Naissance</h3></label>
			<label for="day">Jour</label>
			<select name="day" >
				<?php
					for($i=1;$i<=31;$i++){
						echo"<option ";
						if(isset($_GET['day']) AND $_GET['day']==$i ){
							echo"selected";
						}
						if($i<10){echo" >0".$i."</option>";}
						else{echo" >".$i."</option>";}
					}
				?>
			</select>
			<label for="month">Mois</label>
			<select name="month">
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Janvier'){echo" selected ";
				}?>>Janvier</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Fevrier'){echo" selected ";
				}?>>Fevrier</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Mars'){echo" selected ";
				}?>>Mars</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Avril'){echo" selected ";
				}?>>Avril</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Mai'){echo" selected ";
				}?>>Mai</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Juin'){echo" selected ";
				}?>>Juin</option>
				<option
				<?php if(isset($_GET['month']) AND $_GET['month']=='Juillet'){echo" selected ";
				}?>>Juillet</option>
				<option
				<?php if(isset($_GET['month']) AND $_GET['month']=='Aout'){echo" selected ";
				}?>>Aout</option>
				<option
				<?php if(isset($_GET['month']) AND $_GET['month']=='Septembre'){echo" selected ";
				}?>>Septembre</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Octobre'){echo" selected ";
				}?>>Octobre</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Novembre'){echo" selected ";
				}?>>Novembre</option>
				<option <?php if(isset($_GET['month']) AND $_GET['month']=='Decembre'){echo" selected ";
				}?>>Decembre</option>
			</select>
			<label for="year">Année</label>
			<select name="year">
				<?php
					for($i=date('Y');$i>=date('Y')-100;$i--){
						echo"<option ";
						if(isset($_GET['year']) AND $_GET['year']==$i ){
							echo"selected";
						}
						echo" >".$i."</option>";
					}
				?>
			</select>
			<label><h3>Adresse principale</h3></label>
			<div class="adresse">
				<div class="adresseTextarea">
					<label for="adress">Adresse:</label>
					<textarea name="adress" ><?php if(isset($_GET['adress'])){echo"".$_GET['adress'];} ?></textarea>
				</div>
				<div>
					<label for="postalCode" >Code postal:</label>
					<input type="text" name="postalCode" value=<?php if(isset($_GET['postalCode'])){echo"".$_GET['postalCode'];} ?>>
				</div>
				<div >
					<label for="city">Ville:</label>
					<input type="text" name="city" value=<?php if(isset($_GET['city'])){echo"".$_GET['city'];} ?>>
				</div>
			</div>
		</div>
		<div class="contact section">
			<h2>Contact</h2>
			<label for="mail"><h3>Adresse mail</h3></label>
			<input type="text" name="mail" value=<?php if(isset($_GET['mail'])){echo"".$_GET['mail'];} ?>>
			<label for="homePhone"><h3>Télephone fixe</h3></label>
			<input type="text" name="homePhone" value=<?php if(isset($_GET['homePhone'])){echo"".$_GET['homePhone'];} ?>>
			<label for="mobilePhone"><h3>Télephone portable</h3></label>
			<input type="text" name="mobilePhone" value=<?php if(isset($_GET['mobilePhone'])){echo"".$_GET['mobilePhone'];} ?>>
		</div>
		<div class="autre section">
			<h2>Autre</h2>
			<laber>Vous êtes venu par?</laber>
			<input type="checkbox" name="way[]" value="Car"
			<?php
				if(isset($_GET['way'])){
					for ($i=0;$i<count($_GET['way']);$i++){
						if($_GET['way'][$i]=='Car'){
							echo" checked ";
						}
					}
				}
			?>
			><label for="way[]">Voiture</label>/
			<input type="checkbox" name="way[]" value="Bus"
			<?php
				if(isset($_GET['way'])){
					for ($i=0;$i<count($_GET['way']);$i++){
						if($_GET['way'][$i]=='Bus'){
							echo" checked ";
						}
					}
				}
			?>
			><label for="way[]">Bus</label>/
			<input type="checkbox" name="way[]" value="Train"
			<?php
				if(isset($_GET['way'])){
					for ($i=0;$i<count($_GET['way']);$i++){
						if($_GET['way'][$i]=='Train'){
							echo" checked ";
						}
					}
				}
			?>
			><label for="way[]">Train</label>/
			<input type="checkbox" name="way[]" value="Bycicle"
			<?php
				if(isset($_GET['way'])){
					for ($i=0;$i<count($_GET['way']);$i++){
						if($_GET['way'][$i]=='Bycicle'){
							echo" checked ";
						}
					}
				}
			?>
			><label for="way[]">Vélo</label>/
			<input type="checkbox" name="way[]" value="Other"
			<?php
				if(isset($_GET['way'])){
					for ($i=0;$i<count($_GET['way']);$i++){
						if($_GET['way'][$i]=='Other'){
							echo" checked ";
						}
					}
				}
			?>
			><label for="way[]">Autre</label>
		</div>
		<p class="button"><input class="button" type="submit" value="ENVOYER"></p>
	</form>
	<!-- <?php
		switch (true) {
			case isset($_GET['errorNettoyerString']):
				echo "<script language='JavaScript'>alert('".$_GET['errorNettoyerString']."');</script>";
				break;
			case isset($_GET['errorNettoyerAlpha']):
				echo "<script language='JavaScript'>alert('".$_GET['errorNettoyerAlpha']."');</script>";
				break;
			case isset($_GET['errorNoNumber']):
				echo "<script language='JavaScript'>alert('".$_GET['errorNoNumber']."');</script>";
				break;
			case isset($_GET['errorMail']):
				echo "<script language='JavaScript'>alert('".$_GET['errorMail']."');</script>";
				break;
		}
	?> -->
</body>
</html>