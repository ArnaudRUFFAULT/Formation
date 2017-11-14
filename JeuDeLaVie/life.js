window.addEventListener('DOMContentLoaded',function(){

	const COLONNES = 100;
	const LIGNES = 100;

	function update(){
		let etatFinal = [];

		for( let TD of mesTD){

			let voisinAlive = 0;
			let id = TD.getAttribute('id');

			let voisin1X = parseInt(id.substr(0,2))-1 < 10 ? '0'+(parseInt(id.substr(0,2))-1).toString():(parseInt(id.substr(0,2))-1).toString();
			let voisin1Y = parseInt(id.substr(2,2))-1 < 10 ? '0'+(parseInt(id.substr(2,2))-1).toString():(parseInt(id.substr(2,2))-1).toString();
			let voisin1 = voisin1X+voisin1Y;
			voisin1ID = document.getElementById(voisin1);
			if(voisin1ID != null){
				voisinAlive = voisin1ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}			
			let voisin2X = parseInt(id.substr(0,2)) < 10 ? '0'+(parseInt(id.substr(0,2))).toString():(parseInt(id.substr(0,2))).toString();
			let voisin2Y = parseInt(id.substr(2,2))-1 < 10 ? '0'+(parseInt(id.substr(2,2))-1).toString():(parseInt(id.substr(2,2))-1).toString();
			let voisin2 = voisin2X+voisin2Y;
			voisin2ID = document.getElementById(voisin2);
			if(voisin2ID != null){
				voisinAlive = voisin2ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin3X = parseInt(id.substr(0,2))+1 < 10 ? '0'+(parseInt(id.substr(0,2))+1).toString():(parseInt(id.substr(0,2))+1).toString();
			let voisin3Y = parseInt(id.substr(2,2))-1 < 10 ? '0'+(parseInt(id.substr(2,2))-1).toString():(parseInt(id.substr(2,2))-1).toString();
			let voisin3 = voisin3X+voisin3Y;
			voisin3ID = document.getElementById(voisin3);
			if(voisin3ID != null){
				voisinAlive = voisin3ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin4X = parseInt(id.substr(0,2))+1 < 10 ? '0'+(parseInt(id.substr(0,2))+1).toString():(parseInt(id.substr(0,2))+1).toString();
			let voisin4Y = parseInt(id.substr(2,2)) < 10 ? '0'+(parseInt(id.substr(2,2))).toString():(parseInt(id.substr(2,2))).toString();
			let voisin4 = voisin4X+voisin4Y;
			voisin4ID = document.getElementById(voisin4);
			if(voisin4ID != null){
				voisinAlive = voisin4ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin5X = parseInt(id.substr(0,2))+1 < 10 ? '0'+(parseInt(id.substr(0,2))+1).toString():(parseInt(id.substr(0,2))+1).toString();
			let voisin5Y = parseInt(id.substr(2,2))+1 < 10 ? '0'+(parseInt(id.substr(2,2))+1).toString():(parseInt(id.substr(2,2))+1).toString();
			let voisin5 = voisin5X+voisin5Y;
			voisin5ID = document.getElementById(voisin5);
			if(voisin5ID != null){
				voisinAlive = voisin5ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin6X = parseInt(id.substr(0,2)) < 10 ? '0'+(parseInt(id.substr(0,2))).toString():(parseInt(id.substr(0,2))).toString();
			let voisin6Y = parseInt(id.substr(2,2))+1 < 10 ? '0'+(parseInt(id.substr(2,2))+1).toString():(parseInt(id.substr(2,2))+1).toString();
			let voisin6 = voisin6X+voisin6Y;
			voisin6ID = document.getElementById(voisin6);
			if(voisin6ID != null){
				voisinAlive = voisin6ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin7X = parseInt(id.substr(0,2))-1 < 10 ? '0'+(parseInt(id.substr(0,2))-1).toString():(parseInt(id.substr(0,2))-1).toString();
			let voisin7Y = parseInt(id.substr(2,2))+1 < 10 ? '0'+(parseInt(id.substr(2,2))+1).toString():(parseInt(id.substr(2,2))+1).toString();
			let voisin7 = voisin7X+voisin7Y;
			voisin7ID = document.getElementById(voisin7);
			if(voisin7ID != null){
				voisinAlive = voisin7ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			let voisin8X = parseInt(id.substr(0,2))-1 < 10 ? '0'+(parseInt(id.substr(0,2))-1).toString():(parseInt(id.substr(0,2))-1).toString();
			let voisin8Y = parseInt(id.substr(2,2)) < 10 ? '0'+(parseInt(id.substr(2,2))).toString():(parseInt(id.substr(2,2))).toString();
			let voisin8 = voisin8X+voisin8Y;
			voisin8ID = document.getElementById(voisin8);
			if(voisin8ID != null){
				voisinAlive = voisin8ID.getAttribute('class') == 'dead' ? voisinAlive:voisinAlive+1;
			}

			if(voisinAlive < 2 || voisinAlive > 3){
				etatFinal[id] = false;
			}

			else if(voisinAlive == 3){
				etatFinal[id] = true;
			}
		}
		for(let key in etatFinal){
			let element = document.getElementById(key);
			element.className = etatFinal[key] == true ? "alive" : "dead";
		}
	}

	let mesTD = document.querySelectorAll('#data td');
	let go = document.querySelector('#go');
	let step = document.querySelector('#step');
	let stop = document.querySelector('#stop');
	let restart = document.querySelector('#restart');
	let interval ="";

	for( let TD of mesTD){
		TD.addEventListener('click',function(){
			TD.className = TD.getAttribute('class') == "alive" ? "dead":"alive";
		});
	}

	go.addEventListener('click',function(event){
		event.preventDefault();
		interval = window.setInterval(update, 100);
	});

	step.addEventListener('click',function(event){
		event.preventDefault();
		update();
	});
	stop.addEventListener('click',function(event){
		event.preventDefault();
		window.clearInterval(interval);
	});

	restart.addEventListener('click',function(event){
		event.preventDefault();
		window.clearInterval(interval);
		for(TD of mesTD){
			TD.className="dead";
		}
	});
});