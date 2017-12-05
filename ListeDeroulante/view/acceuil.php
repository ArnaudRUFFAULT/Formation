<!DOCTYPE html>
<html>
<head>
	<title>Liste Deroulante</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery-3.2.1.js"></script>
	<script type="text/javascript" src="listeDeroulante.js"></script>

</head>
<body>
	<div id="conteneur">
		<form>
			<label for="pays">Séléctionnez un pays</label>
			<select id="pays" name="pays">
				<?php
				foreach ($pays as $key => $value) {
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
				?>
			</select>
			<hr />
			<label for="departement">Séléctionnez un département</label>
			<select id="departement" name="departement"></select>
			<hr />
			<label for="ville">Séléctionnez une ville</label>
			<select id="ville" name=ville"ville"></select>
		</form>
		<hr />
		<div id="ficheVille">
		</div>
	</div>
	<div id="test">
		<div id="lecteur">
		</div>
	</div>
	<button id="ajouter">Ajouter animation</button>
	<button id="annuler">Annuler la file d'attente</button><br />
	<button id="remplacer">Remplacer la file d'attente</button>
	<button id="retour">Ajouter une fonction de retour</button><br />
	<img src="petitchat.png" id="bon" style="position: relative;">
	<img src="petitchien.png" id="mauvais" style="position: relative;">
	<script>
	  $(function() {
	    $('#ajouter').click( function() {
	      $('#bon').toggle(2000).clearQueue();
	    });  
	    $('#annuler').click( function() {
	        $('img').clearQueue();
	    });  
	    $('#remplacer').click( function() {
	      $('#mauvais').css('left', 200).css('top', 200);
	      $('#mauvais').queue(function() {
	                   $(this).animate({top: '-=200'}, 'slow')
	                          .animate({top: '+=200', 'left': '-=200'}, 'slow')
	                          .animate({top: '-=200'}, 'slow');
	                   $(this).dequeue();
	                   });
	    });  
	    $('#retour').click( function() {
	      $('img').queue(function() {
	            alert('Animation terminée.');
	            $(this).dequeue();
	       });
	    });  
	  });
	</script>
</body>
</html>