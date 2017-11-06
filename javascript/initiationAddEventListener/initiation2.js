window.addEventListener('load',function(){	

	var nouvelleImage = document.createElement('img');
	nouvelleImage.setAttribute('src','http://icloudpicture.com/wp-content/uploads/2015/11/4K-Ultra-HD-Wallpapers.jpg');

	var troll = document.createElement('img');
	troll.setAttribute('src','https://escapepublishingblog.files.wordpress.com/2014/10/scary-sully.jpg');

	var chat = document.createElement('img');
	chat.setAttribute('src','https://dozodomo.com/wp-content/uploads/2015/08/chat-Japon.jpg');

	var chien = document.createElement('img');
	chien.setAttribute('src','https://wallpaper.wiki/wp-content/uploads/2017/04/wallpaper.wiki-Funny-Dog-Wallpaper-HD-PIC-WPD004507.jpg');


	var autruche = document.createElement('img');
	autruche.setAttribute('src','http://www.gratuit-en-ligne.com/telecharger-gratuit-en-ligne/telecharger-image-wallpaper-gratuit/image-wallpaper-animaux/img/images/image-wallpaper-animaux-autruche.jpg');

	nouvelleImage.addEventListener('load',function(){
		var image = document.getElementById('image');
		image.setAttribute('src',nouvelleImage.getAttribute('src'));
	});

	var test = document.getElementById('image');
	test.addEventListener('click',function(){
		test.style.width = "50%";
	});
	test.addEventListener('dblclick',function(){
		test.style.width = "100%";
	});
	window.addEventListener('keydown',function(){
		switch (event.keyCode){
		    case 65:
		    	test.setAttribute('src',autruche.getAttribute('src'));
		        break;
		    case 90:
		    	test.setAttribute('src',chat.getAttribute('src'));
		        break;
		    case 69:
		    	test.setAttribute('src',chien.getAttribute('src'));
		        break;
		    default:
		    	test.setAttribute('src',troll.getAttribute('src'));
		}	
	});
	window.addEventListener('keyup',function(){
		test.setAttribute('src',nouvelleImage.getAttribute('src'));
	});

});