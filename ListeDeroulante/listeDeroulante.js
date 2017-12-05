function afficherDepartement(result){
	if(result != '[]'){
		let data = JSON.parse(result);
		$('#departement').html('');
		for(departement in data){
			$('<option value="'+departement+'">'+data[departement]+'</option>').appendTo($('#departement'));
		}
		$('#departement').trigger('change');
	}
	else{
		$('#departement').html('<option>aucun departement</option>');
		$('#ville').html('<option>aucune ville</option>');
		$('#ficheVille').html('');
	}
}

function afficherVille(result){
	if(result != '[]'){
		let data = JSON.parse(result);
		$('#ville').html('');
		for(ville in data){
			$('<option value="'+data[ville]['id']+'">'+data[ville]['nom']+'</option>').appendTo($('#ville'));
		}
		$('#ville').trigger('change');
	}
	else{
		$('#ville').html('<option>aucune ville</option>');
		$('#ficheVille').html('');
	}
}

function afficherCaracteristiqueVille(result){
	if(result != '[]'){
		$('#ficheVille').text('');
		let data = JSON.parse(result);
		for(info in data){
			if(info != 'id' && info != 'commune'){
				if(info == 'surface'){
					$('<span id="cle">'+info+': </span><span id="valeur">'+data[info]+' km²</span><br />').appendTo($('#ficheVille'));
				}
				else{
					$('<span id="cle">'+info+': </span><span id="valeur">'+data[info]+'</span><br />').appendTo($('#ficheVille'));
				}
				
			}
		}
	}
	else{
		$('#ficheVille').html('');
	}
}

$(function(){
	$('#pays').on('change',function(){
		$.post('index.php',{idPays:$(this).val()},afficherDepartement);
	});
	$('#departement').on('change',function(){
		$.post('index.php',{idDepartement:$(this).val()},afficherVille);
	});

	$('#ville').on('change',function(){
		$.post('index.php',{idVille:$(this).val()},afficherCaracteristiqueVille);
	});

	$("#lecteur").hide();

	$("#test").mousemove(function(event){
	    $("#lecteur").show('fast');
	    myStopFunction();
	    myFunction();
	});


	function myFunction() {
	    myVar = setTimeout(function(){
	        $("#lecteur").hide();
	    }, 2000);
	}
	function myStopFunction() {
	    if(typeof myVar != 'undefined'){
	        clearTimeout(myVar);
	    }
	}
});