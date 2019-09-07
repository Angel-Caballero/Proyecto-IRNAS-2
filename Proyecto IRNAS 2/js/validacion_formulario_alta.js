// Funciones de validación
	// EJERCICIO 3: Validación del formulario en cliente con Javascript (después de la validación de HTML5)
	function validateForm() {
		var noValidation = document.getElementById("#usuario-form").novalidate;
		
		if (!noValidation){
			// Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
			var error1 = passwordValidation();
	        
			var error2 = passwordConfirmation();
	        
			return (error1.length==0) && (error2.length==0);
		}
		else 
			return true;
	}

	// EJERCICIO 3.1: Comprobar la restricciones del password y aplicar clases CSS mediante JQuery
	function passwordValidation(){
		var password = document.getElementById("usuario-password");
		var pwd = password.value;
		var valid = true;

		// Comprobamos la longitud de la contraseña
		valid = valid && (pwd.length>=8) && (pwd.length<=16);
		
		// Comprobamos si contiene letras mayúsculas, minúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "La contraseña debe tener entre 8 y 16 caracteres y contener números y letras mayúsculas y minúsculas";
		}else{
			var error = "";
		}
	        password.setCustomValidity(error);
		return error;
	}
	
	// EJERCICIO 3.2: Campos de contraseña y confirmación de contraseña iguales
	function passwordConfirmation(){
		// Obtenemos el campo de password y su valor
        var password = document.getElementById("usuario-password");
		var pwd = password.value;
		// Obtenemos el campo de confirmación de password y su valor
		var passconfirm = document.getElementById("usuario-confirm-password");
		var confirmation = passconfirm.value;

		// Los comparamos
		if (pwd != confirmation) {
			var error = "Las contraseñas no coinciden";
		}else{
			var error = "";
		}

		passconfirm.setCustomValidity(error);

		return error;
	}

	// EJERCICIO 2: Calcula la fortaleza de una contraseña: frecuencia de repetición de caracteres
	function passwordStrength(password){
    		// Creamos un Map donde almacenar las ocurrencias de cada carácter
    		var letters = {};

    		// Recorremos la contraseña carácter por carácter
    		var length = password.length;
    		for(x = 0, length; x < length; x++) {
        		// Consultamos el carácter en la posición x
        		var l = password.charAt(x);

        		// Si NO existe en el Map, inicializamos su contador a uno
        		// Si ya existía, incrementamos el contador en uno
        		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    		}

    		// Devolvemos el cociente entre el número de caracteres únicos (las claves del Map)
		// y la longitud de la contraseña
    		return Object.keys(letters).length / length;
	}
	
	// EJERCICIO 4: Coloreado del campo de contraseña según su fortaleza
	function passwordColor(){
		var passField = document.getElementById("usuario-password");
		var strength = passwordStrength(passField.value);
		
		if(!isNaN(strength)){
			var type = "weakpass";
			if(passwordValidation()!=""){
				type = "weakpass";
			}else if(strength > 0.7){
				type = "strongpass";
			}else if(strength > 0.4){
				type = "middlepass";
			}
		}else{
			type = "nanpass";
		}
		passField.className = type;
		
		return type;
	}

	function posicionValidation(){
		var posicion = document.getElementById("recurso-posicion");
		var pos = posicion.value;
		var valid = true;
		
		// Comprobamos si contiene letras mayúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		valid = valid && ((hasNumber.test(pos)) && (hasUpperCases.test(pos)));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "La posición debe contener números y letras mayúsculas";
		}else{
			var error = "";
		}
	        posicion.setCustomValidity(error);
		return error;
	}

	function telefono1Validation(){
		var telefono = document.getElementById("proveedor-telefono1");
		var tef = telefono.value;
		var valid = true;
		
		var hasPhoneFormat = /^[6|7|8|9][0-9]{8}$/;
		valid = valid && hasPhoneFormat.test(tef);
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "El teléfono debe contener 9 números y empezar por 6,7,8 o 9";
		}else{
			var error = "";
		}
	        telefono.setCustomValidity(error);
		return error;
	}

	function telefono2Validation(){
		var telefono = document.getElementById("proveedor-telefono2");
		var tef = telefono.value;
		var valid = true;
		
		var hasPhoneFormat = /^[6|7|8|9][0-9]{8}$/;
		valid = valid && hasPhoneFormat.test(tef);
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "El teléfono debe contener 9 números y empezar por 6,7,8 o 9";
		}else{
			var error = "";
		}
	        telefono.setCustomValidity(error);
		return error;
	}

	function telefono3Validation(){
		var telefono = document.getElementById("proveedor-telefono3");
		var tef = telefono.value;
		var valid = true;
		
		var hasPhoneFormat = /^[6|7|8|9][0-9]{8}$/;
		valid = valid && hasPhoneFormat.test(tef);
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "El teléfono debe contener 9 números y empezar por 6, 7, 8 o 9";
		}else{
			var error = "";
		}
	        telefono.setCustomValidity(error);
		return error;
	}

	function iluminacionValidation(){
		var iluminacion = document.getElementById("almacen-iluminacion");
		var ilum = iluminacion.value;
		var valid = true;
		
		// Comprobamos si contiene letras mayúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		valid = valid && ((hasNumber.test(ilum)) && (hasUpperCases.test(ilum)) || (ilum == "Natural"));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "La iluminación debe contener números y letras mayúsculas o ser 'Natural'";
		}else{
			var error = "";
		}
	        iluminacion.setCustomValidity(error);
		return error;
	}

	function temperaturaValidation(){
		var temperatura = document.getElementById("mobiliario-temperatura");
		var temp = temperatura.value;
		var valid = true;
		
		valid = valid && (temp <= "15");
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
            var error = "La temperatura debe ser inferior a 15ºC";
		}else{
			var error = "";
		}
	        temperatura.setCustomValidity(error);
		return error;
	}