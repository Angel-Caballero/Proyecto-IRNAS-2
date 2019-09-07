<?php	
    session_start();
    
    require_once("gestionBD.php");
    require_once("gestionarMobiliario.php");
    
    if (!isset($_SESSION['login'])) {
        Header("Location: login.php");
    } else {
        $usuario = $_SESSION['login'];
    }
    
    if(!isset($_SESSION['privilegios'])){
        Header("Location: interfazBuscador.php");
    }

	if (isset($_REQUEST["mobiliario_temperatura_ambiente"]) && isset($_REQUEST["mobiliario_equipo_frio"])) {
        $conexion = crearConexionBD();

        if($_REQUEST["mobiliario_temperatura_ambiente"] != "" && $_REQUEST["mobiliario_equipo_frio"] == ""){

            $id_ta = $_REQUEST["mobiliario_temperatura_ambiente"];	
            $excepcionTA = quitar_temperatura_ambiente($conexion, $id_ta);

        }else if($_REQUEST["mobiliario_temperatura_ambiente"] == "" && $_REQUEST["mobiliario_equipo_frio"] != "") {

            $id_ef = $_REQUEST["mobiliario_equipo_frio"];	
            $excepcionEF = quitar_equipo_frio($conexion, $id_ef);
            
        }else {

            $id_ta = $_REQUEST["mobiliario_temperatura_ambiente"];
            $id_ef = $_REQUEST["mobiliario_equipo_frio"];
            $excepcionTA = quitar_temperatura_ambiente($conexion, $id_ta);	
            $excepcionEF = quitar_equipo_frio($conexion, $id_ef);
            
        }
        cerrarConexionBD($conexion);

		if (($excepcionTA != "" && isset($excepcionTA)) && ($excepcionEF == "" || !isset($excepcionEF))) {
			$_SESSION["excepcion"] = $excepcionTA;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
		}elseif (($excepcionTA == "" || !isset($excepcionTA)) && ($excepcionEF != "" && isset($excepcionEF))) {
            $_SESSION["excepcion"] = $excepcionEF;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
        }elseif (($excepcionTA != "" && isset($excepcionTA)) && ($excepcionEF != "" && isset($excepcionEF))) {
            $_SESSION["excepcion"] = $excepcionEF . $excepcionTA;
			$_SESSION["destino"] = "formulario_baja.php";
			Header("Location: excepcion.php");
        }
		else{
            $_SESSION["mensjMobiliario"] = "Mobiliario eliminado correctamente";
            Header("Location: formulario_baja.php");
        } 
	}
	else{
        Header("Location: interfaz_buscador.php"); 
    }

?>