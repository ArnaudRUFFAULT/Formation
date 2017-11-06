"use strict";

function request(callback) {
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	
	xhr.open("GET", "monAjax.php", true);
	xhr.send(null);
}



function readData(data) {
	var monP = document.createElement("p");
	monP.textContent = data;
	console.log(monP);
	var maDiv = document.getElementById('test');
	maDiv.parentNode.appendChild(monP);
	
}


window.addEventListener('DOMContentLoaded',function(){
	var maDiv = document.getElementById('test');
	maDiv.addEventListener('mouseover',function(){
		maDiv.style.cursor = "pointer";
	})
	maDiv.addEventListener('click',function(){
		request(readData);
	})
});
