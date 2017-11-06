"use strict";

function request(callback,url) {
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	
	xhr.open("GET", url, true);
	xhr.send(null);
}



function readData(data) {
	var monP = document.createElement("p");
	monP.textContent = data;
	var maDiv = document.getElementById('test');
	maDiv.parentNode.appendChild(monP);
	maDiv.remove();
	
}

function readData2(data) {
	var monP = document.createElement("p");
	monP.textContent = data;
	var maDiv = document.getElementById('test2');
	maDiv.parentNode.appendChild(monP);
	maDiv.remove();
	
}


window.addEventListener('DOMContentLoaded',function(){
	var maDiv = document.getElementById('test');
	maDiv.addEventListener('mouseover',function(){
		maDiv.style.cursor = "pointer";
	})
	maDiv.addEventListener('click',function(){
		request(readData,"index.php?action=patate");
	})

	var maDiv2 = document.getElementById('test2');
	maDiv2.addEventListener('mouseover',function(){
		maDiv2.style.cursor = "pointer";
	})
	maDiv2.addEventListener('click',function(){
		request(readData2,"index.php?action=comcombre");
	})
});
