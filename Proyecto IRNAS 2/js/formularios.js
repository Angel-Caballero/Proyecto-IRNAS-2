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