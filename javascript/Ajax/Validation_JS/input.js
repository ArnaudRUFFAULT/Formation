"use strict";

function request(callback,data){
	var xhr =new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};

	xhr.open("POST","checkForm.php", true);
	xhr.send(data);
}

function checkForm(result){
	let message = document.createElement("p");
	message.innerHTML = result;
	let form = document.querySelector('form');
	form.parentNode.appendChild(message);
}

document.addEventListener("DOMContentLoaded", function(){
	let inputs = document.querySelectorAll("input,select,textarea");
	for(let input of inputs)
	{
		let selectable = false;

		if(input.nodeName != "SELECT")
		{
			if(input.nodeName == "TEXTAREA")
			{
				selectable = true;
			}
			else 	//Ici, on sait que c'est un input
			{
				switch(input.type)
				{
					case "submit":
					case "radio":
					case "checkbox":
						break;

					default:
						selectable = true;
				}
			}
		}

		if(selectable)
		{
			input.addEventListener("focus", function(){
				this.select();
			})
		}
	}

	let forms = document.getElementsByTagName("form");
	for(let form of forms)
	{
		form.addEventListener("submit", function(event){
			let required = this.querySelectorAll("input.required,textarea.required");
			for(let elem of required)
			{
				let valid = false;
				if(elem.nodeName == "INPUT" && (elem.type == "radio" || elem.type == "checkbox"))
				{
					let radios = document.getElementsByName(elem.name);
					for(let radio of radios)
					{
						if(radio.checked)
						{
							valid = true;
							break;
						}
					}
				}
				else
				{
					valid = elem.value != "";
				}

				/*if(!valid)
				{
					alert("L'input " + elem.name + " doit être remplie!");
					event.preventDefault();
					break;
				}*/
				
			}
			event.preventDefault();
			let data = new FormData(this);		
			request(checkForm,data);		
		});
	}
});