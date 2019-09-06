CREATE OR REPLACE PROCEDURE MODIFICAR_UNIDADES_RECURSO 
(NOMBRE_A_MOD IN RECURSOS.NOMBRE%TYPE,
 ALMACEN_A_MOD IN RECURSOS.ALMACEN%TYPE,
 UNIDADES_A_MOD IN RECURSOS.UNIDADES%TYPE) IS
BEGIN
  UPDATE RECURSOS SET UNIDADES=UNIDADES_A_MOD
  WHERE NOMBRE = NOMBRE_A_MOD AND ALMACEN = ALMACEN_A_MOD;
END;
/

CREATE OR REPLACE PROCEDURE MODIFICAR_CANTIDAD_RECURSO 
(NOMBRE_A_MOD IN RECURSOS.NOMBRE%TYPE,
 ALMACEN_A_MOD IN RECURSOS.ALMACEN%TYPE,
 CANTIDAD_A_MOD IN RECURSOS.CANTIDAD%TYPE) IS
BEGIN
  UPDATE RECURSOS SET CANTIDAD=CANTIDAD_A_MOD
  WHERE NOMBRE = NOMBRE_A_MOD AND ALMACEN = ALMACEN_A_MOD;
END;
/

CREATE OR REPLACE PROCEDURE MODIFICAR_RESERVA_RECURSO 
(NOMBRE_A_MOD IN RECURSOS.NOMBRE%TYPE,
 ALMACEN_A_MOD IN RECURSOS.ALMACEN%TYPE,
 RESERVA_A_MOD IN RECURSOS.RESERVAMINIMA%TYPE) IS
BEGIN
  UPDATE RECURSOS SET RESERVAMINIMA=RESERVA_A_MOD
  WHERE NOMBRE = NOMBRE_A_MOD AND ALMACEN = ALMACEN_A_MOD;
END;
/