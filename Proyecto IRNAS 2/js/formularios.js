function recursoform(){
    document.getElementById("recurso").style.display = "block";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function proveedorform(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "block";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function almacenform(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "block";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "none";
}

function mobiliarioform(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "block";
    document.getElementById("usuario").style.display = "none";
}

function usuarioform(){
    document.getElementById("recurso").style.display = "none";
    document.getElementById("proveedor").style.display = "none";
    document.getElementById("almacen").style.display = "none";
    document.getElementById("mobiliario").style.display = "none";
    document.getElementById("usuario").style.display = "block";
}

$(document).ready(function(){
    $("#recurso-tipo").change(function(){
      if($("#recurso-tipo").val() == "Fungible"){
        $("#recurso-unidades").prop('disabled', false);
        $("#recurso-formula").prop('disabled', 'disabled');
        $("#recurso-cantidad").prop('disabled', false);
        $("#recurso-reserva").prop('disabled', false);
        $("#recurso-ficha").prop('disabled', 'disabled');
        $("#recurso-proveedores").prop('disabled', false);
      } else if($("#recurso-tipo").val() == "Biológico"){
        $("#recurso-unidades").prop('disabled', 'disabled');
        $("#recurso-formula").prop('disabled', 'disabled');
        $("#recurso-cantidad").prop('disabled', 'disabled');
        $("#recurso-reserva").prop('disabled', 'disabled');
        $("#recurso-ficha").prop('disabled', 'disabled');
        $("#recurso-proveedores").prop('disabled', 'disabled');
      } else{
        $("#recurso-unidades").prop('disabled', false);
        $("#recurso-formula").prop('disabled', false);
        $("#recurso-cantidad").prop('disabled', false);
        $("#recurso-reserva").prop('disabled', false);
        $("#recurso-ficha").prop('disabled', false);
        $("#recurso-proveedores").prop('disabled', false);
      }
    });
    $("#tipo-mobiliario").change(function(){
      if($("#tipo-mobiliario option:checked").val() == "ambiente"){
        $("#mobiliario-temp-amb").prop('disabled', false);
        $("#mobiliario-temperatura").prop('disabled','disabled');
      } else if($("#tipo-mobiliario option:checked").val() == "frio"){
        $("#mobiliario-temp-amb").prop('disabled', 'disabled');
        $("#mobiliario-temperatura").prop('disabled',false);
      }
    });
    $("li").click(function(){
      if (!$(this).hasClass("activo")) {
        $("li.activo").removeClass("activo");
        $(this).addClass("activo");
      }
    });
  });