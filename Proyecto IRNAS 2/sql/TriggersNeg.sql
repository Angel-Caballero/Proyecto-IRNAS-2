--Creacion de Triggers asociados a reglas de negocio

--RN 1
CREATE OR REPLACE TRIGGER TR_Retiro_Reserva
BEFORE INSERT OR UPDATE OF Unidades ON Recursos
FOR EACH ROW
DECLARE
    nomUsuario VARCHAR(50);
BEGIN
    SELECT count(*) INTO nomUsuario
    FROM usuarios WHERE nombre = :NEW.nombre;
    IF :NEW.Unidades <= :OLD.Unidades-2 OR nomUsuario >1
THEN
    RAISE_APPLICATION_ERROR(-20001, 'No se puede retirar mas de una unidad a la vez');
    END IF;
END;
/

--RN 2
CREATE OR REPLACE TRIGGER TR_Unidades_Recursos_Nuevos
BEFORE INSERT OR UPDATE OF Unidades ON Recursos
FOR EACH ROW
DECLARE
    v_Unidades INTEGER := :NEW.Unidades;
BEGIN 
    If(v_Unidades = 0) THEN
    RAISE_APPLICATION_ERROR(-20002, 'No se puede quedar a 0 un recurso');
    END IF;
END;
/
 
--RN 3
CREATE OR REPLACE TRIGGER TR_Temperaturas_Almacenes
BEFORE INSERT OR UPDATE OF Temperatura ON Almacenes
FOR EACH ROW
DECLARE
    v_Temperatura INTEGER := :NEW.Temperatura;
BEGIN 
    If(v_Temperatura < -10) THEN
    RAISE_APPLICATION_ERROR(-20003, 'No se puede insertar un almacén con una temperatura inferior a -10ºC');
    END IF;
END;
/