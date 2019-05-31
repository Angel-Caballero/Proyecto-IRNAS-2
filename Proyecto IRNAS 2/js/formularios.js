function recurso(){
    document.getElementById("recurso").style.display = "block";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function proveedor(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "block";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function almacen(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "block";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function mobiliario(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "block";
    document.getElementById("usuario").style.display = "none";
}

function usuario(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "block";
}

$(document).ready(function(){
    $("#tiporecurso").change(function(){
      if($("#tiporecurso").val() == "Fungible y kits"){
        $("#unidades").prop('disabled', false);
        $("#formula").prop('disabled', 'disabled');
        $("#cantidad").prop('disabled', false);
        $("#reserva").prop('disabled', false);
        $("#ficha").prop('disabled', 'disabled');
        $("#proveedores").prop('disabled', false);
      } else if($("#tiporecurso").val() == "Material biologico"){
        $("#unidades").prop('disabled', 'disabled');
        $("#formula").prop('disabled', 'disabled');
        $("#cantidad").prop('disabled', 'disabled');
        $("#reserva").prop('disabled', 'disabled');
        $("#ficha").prop('disabled', 'disabled');
        $("#proveedores").prop('disabled', 'disabled');
      } else{
        $("#unidades").prop('disabled', false);
        $("#formula").prop('disabled', false);
        $("#cantidad").prop('disabled', false);
        $("#reserva").prop('disabled', false);
        $("#ficha").prop('disabled', false);
        $("#proveedores").prop('disabled', false);
      }
    });
    $("input[name=tipo-mobiliario]").change(function(){
        if($("#ambiente").is(":checked")){
            $("#tipo").prop('disabled', false);
            $("#temperatura").prop('disabled','disabled');
        } else if($("#frio").is(":checked")){
            $("#tipo").prop('disabled', 'disabled');
            $("#temperatura").prop('disabled',false);
        }
    });
    $("li").click(function(){
      if (!$(this).hasClass("activo")) {
        $("li.activo").removeClass("activo");
        $(this).addClass("activo");
      }
    });
  });