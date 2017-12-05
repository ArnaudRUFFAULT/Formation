$(function(){

	function drawResult(data){
		$('#resultat').html('');
		$(data).each(function(index,elem){
			$('#resultat').append($('<div>'+this.ville_nom_reel+'</div>'));
		});
		$('#resultat div').each(function(index,elem){
			$(this).hover(function(){
				$(this).toggleClass('hover');
				$('#input').val($(this).text());
				$(this).on('click',function(){
					let event = jQuery.Event('keyup');
					event.which = 13; 
					event.keyCode = 13;
					$(this).trigger(event);
				})
			});
		});
	}
	let value ="";
	$('#input').on('keyup',function(e){
		$.getJSON('index.php',{piece:$('#input').val()},drawResult);
		value = $('#input').val();
	});
	$('#input').hover(function(e){
		$('#input').val(value);
	});
	$(window).on('keyup',function(e){
		if(e.keyCode == 13) { // KeyCode de la touche entrée
			let ville = $('#input').val();
			window.location = 'index.php?request='+ ville;
        }
	})
});