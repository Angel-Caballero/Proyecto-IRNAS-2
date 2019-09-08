function unidadesValidation(){
    var new_unidades = document.getElementById("UNIDADES");
    var new_uni = new_unidades.value;

    var old_unidades = document.getElementById("UNIDADES_ANTIGUAS");
    var old_uni = old_unidades.value;

    var valid = true;

    if(new_uni < old_uni){
        valid = valid && ((old_uni - new_uni) == 1) && (new_uni > 0);
    }
    
    // Si no cumple las restricciones, devolvemos un error
    if(!valid){
        var error = "Las nuevas unidades deben ser superiores a 0 y no se pueden sacar más de una a la vez";
    }else{
        var error = "";
    }
        new_unidades.setCustomValidity(error);
    return error;
}