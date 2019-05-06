--RF 3
CREATE OR REPLACE PROCEDURE PR_Rec_Alm (v_nombre IN Recursos.Almacen%TYPE) 
IS  
    CURSOR C IS
        SELECT Nombre, Unidades, ReservaMinima FROM Recursos WHERE Almacen LIKE v_nombre;
    v_Recursos C%ROWTYPE;
BEGIN   
    OPEN C;
    FETCH C INTO v_Recursos;
    DBMS_OUTPUT.PUT_LINE(RPAD('Nombre del Recurso:', 25) || RPAD('Unidades:', 25) || RPAD('Reserva Minima:', 25));
    DBMS_OUTPUT.PUT_LINE(LPAD('-', 140, '-'));
     WHILE C%FOUND LOOP
          DBMS_OUTPUT.PUT_LINE(RPAD(v_Recursos.Nombre, 25) || RPAD(v_Recursos.Unidades, 25) || RPAD(v_Recursos.ReservaMinima, 25)); 
    FETCH C INTO v_Recursos;
    END LOOP;
    CLOSE C;
END;
/

--RF 4
CREATE OR REPLACE PROCEDURE PR_Pos_Alm (v_nombre IN Posiciones.Almacen%TYPE) 
IS  
    CURSOR C IS
        SELECT Recurso, Posicion FROM Posiciones WHERE Almacen LIKE v_nombre ;
    v_Posiciones C%ROWTYPE;
BEGIN   
    OPEN C;
    FETCH C INTO v_Posiciones;
    DBMS_OUTPUT.PUT_LINE(RPAD('Nombre del Recurso:', 25) || RPAD('Posiciones:', 25));
    DBMS_OUTPUT.PUT_LINE(LPAD('-', 140, '-'));
     WHILE C%FOUND LOOP
          DBMS_OUTPUT.PUT_LINE(RPAD(v_Posiciones.Recurso, 25) || RPAD(v_Posiciones.Posicion, 25)); 
    FETCH C INTO v_Posiciones;
    END LOOP;
    CLOSE C;
END;
/

--RF 5
CREATE OR REPLACE PROCEDURE PR_Busq_Dinam_Rec (v_nombre IN Recursos.Nombre%TYPE) 
IS  
    CURSOR C IS
        SELECT Nombre, Unidades, ReservaMinima, Almacen FROM Recursos WHERE Nombre LIKE v_nombre;
    v_Recursos C%ROWTYPE;
BEGIN   
    OPEN C;
    FETCH C INTO v_Recursos;
    DBMS_OUTPUT.PUT_LINE(RPAD('Nombre del Recurso:', 25) || RPAD('Unidades:', 25) || RPAD('Reserva Minima:', 25) || RPAD('Almacen:', 25));
    DBMS_OUTPUT.PUT_LINE(LPAD('-', 140, '-'));
     WHILE C%FOUND LOOP
          DBMS_OUTPUT.PUT_LINE(RPAD(v_Recursos.Nombre, 25) || RPAD(v_Recursos.Unidades, 25) || RPAD(v_Recursos.ReservaMinima, 25) || RPAD(v_Recursos.Almacen, 25)); 
    FETCH C INTO v_Recursos;
    END LOOP;
    CLOSE C;
END;
/

--RF 7
CREATE OR REPLACE PROCEDURE PR_Elm_Alm(v_almacen_TA IN Temperatura_Ambiente.Almacen%TYPE, v_almacen_EF IN Equipos_Frio.Almacen%TYPE) 
IS  
    v_Equip_Frio INTEGER;
     v_Temp_Amb INTEGER;
   

BEGIN   
     SELECT COUNT(*) INTO v_Temp_Amb FROM Temperatura_Ambiente WHERE Almacen LIKE v_almacen_TA;
     SELECT COUNT(*) INTO v_Equip_Frio FROM Equipos_Frio WHERE Almacen LIKE v_almacen_EF;
   
    DBMS_OUTPUT.PUT_LINE(RPAD('Numero estanterias:', 25) || RPAD('Numero equipos frio:', 25));
    DBMS_OUTPUT.PUT_LINE(LPAD('-', 140, '-'));
    DBMS_OUTPUT.PUT_LINE(RPAD(v_Temp_Amb, 25) || RPAD(v_Equip_Frio, 25)); 

END;
/

--RF 8
CREATE OR REPLACE PROCEDURE PR_Prov_Prod(v_recurso IN Proveedores_Recursos.Recurso%TYPE) 
IS  
    CURSOR C IS
        Select NOMBREEMPRESA , NOMBRECOMERCIAL , EMAIL FROM Proveedores WHERE ID_PR LIKE(SELECT Proveedor FROM Proveedores_Recursos WHERE Recurso LIKE v_recurso);
    v_Proveedores C%ROWTYPE;
BEGIN   
    OPEN C;
    FETCH C INTO v_Proveedores;
    DBMS_OUTPUT.PUT_LINE(RPAD('Nombre de empresa:', 25) || RPAD('Nombre del comercial:', 25) || RPAD('Email:', 25));
    DBMS_OUTPUT.PUT_LINE(LPAD('-', 140, '-'));
     WHILE C%FOUND LOOP
          DBMS_OUTPUT.PUT_LINE(RPAD(v_Proveedores.NOMBREEMPRESA, 25) || RPAD(v_Proveedores.NOMBRECOMERCIAL, 25) || RPAD(v_Proveedores.EMAIL, 25)); 
    FETCH C INTO v_Proveedores;
    END LOOP;
    CLOSE C;
END;
/