--Borrado de Secuencias
DROP SEQUENCE sec_posiciones;
DROP SEQUENCE sec_temperatura;
DROP SEQUENCE sec_equipos;
DROP SEQUENCE sec_avisos;
DROP SEQUENCE sec_responsables;
DROP SEQUENCE sec_pedidos;
DROP SEQUENCE sec_proveedores;
DROP SEQUENCE sec_telefonos;

--Borrado de Tablas
DROP TABLE Posiciones;
DROP TABLE Temperatura_Ambiente;
DROP TABLE Equipos_Frio;
DROP TABLE Pedidos;
DROP TABLE Telefonos;
DROP TABLE Usuarios;
DROP TABLE Proveedores_Recursos;
DROP TABLE Avisos_Responsable;
DROP TABLE Avisos;
DROP TABLE Responsables_Compra;
DROP TABLE Proveedores;
DROP TABLE Recursos;
DROP TABLE Almacenes;

--Creacion de Tablas
CREATE TABLE Almacenes(
Nombre VARCHAR(50) NOT NULL,
Temperatura FLOAT,
TipoIluminacion VARCHAR(50),
TipoCamara VARCHAR(50));

CREATE TABLE Recursos(
Nombre VARCHAR(50) NOT NULL,
FormulaQuimica VARCHAR(50),
Unidades INTEGER,
Cantidad FLOAT,
ReservaMinima INTEGER, 
Tipo VARCHAR(50),
Almacen VARCHAR(50));

CREATE TABLE Posiciones(
ID_PS INTEGER,
Posicion VARCHAR(50) NOT NULL,
Recurso VARCHAR(50),
Almacen VARCHAR(50));

CREATE TABLE Temperatura_Ambiente(
ID_TA INTEGER,
Nombre VARCHAR(50) NOT NULL,
Tipo VARCHAR(50) NOT NULL,
Almacen VARCHAR(50));

CREATE TABLE Equipos_Frio(
ID_EF INTEGER,
Nombre VARCHAR(50) NOT NULL,
Temperatura CHAR(5) NOT NULL,
Almacen VARCHAR(50));

CREATE TABLE Avisos(
ID_AV INTEGER,
Mensaje VARCHAR(50) NOT NULL,
Recurso VARCHAR(50),
Almacen VARCHAR(50));

CREATE TABLE Responsables_Compra(
ID_RC INTEGER,
Nombre VARCHAR(50) NOT NULL,
Email VARCHAR(50) NOT NULL);

CREATE TABLE Pedidos(
ID_PD INTEGER,
Mensaje VARCHAR(50) NOT NULL,
Proveedor INTEGER,
ResponsableCompra INTEGER);

CREATE TABLE Proveedores(
ID_PR INTEGER,
NombreEmpresa VARCHAR(50),
NombreComercial VARCHAR(50) NOT NULL,
Email VARCHAR(50));

CREATE TABLE Telefonos(
ID_TF INTEGER,
Telefono CHAR(9) NOT NULL,
Proveedor INTEGER);

CREATE TABLE Usuarios(
Nombre VARCHAR(50) NOT NULL,
Pass VARCHAR(50) NOT NULL,
Email VARCHAR(50),
Tipo VARCHAR(50) NOT NULL);

CREATE TABLE Proveedores_Recursos(
Proveedor INTEGER,
Recurso VARCHAR(50),
Almacen VARCHAR(50));

CREATE TABLE Avisos_Responsable(
Responsable INTEGER,
Aviso INTEGER);

--A�adir Primary Keys
ALTER TABLE Recursos ADD PRIMARY KEY (Nombre, Almacen);
ALTER TABLE Almacenes ADD PRIMARY KEY (Nombre);
ALTER TABLE Posiciones ADD PRIMARY KEY (ID_PS);
ALTER TABLE Temperatura_Ambiente ADD PRIMARY KEY (ID_TA);
ALTER TABLE Equipos_Frio ADD PRIMARY KEY (ID_EF);
ALTER TABLE Avisos ADD PRIMARY KEY (ID_AV);
ALTER TABLE Responsables_Compra ADD PRIMARY KEY (ID_RC);
ALTER TABLE Pedidos ADD PRIMARY KEY (ID_PD);
ALTER TABLE Proveedores ADD PRIMARY KEY (ID_PR);
ALTER TABLE Telefonos ADD PRIMARY KEY (ID_TF);
ALTER TABLE Usuarios ADD PRIMARY KEY (Nombre);
ALTER TABLE Proveedores_Recursos ADD PRIMARY KEY (Proveedor,Recurso,Almacen);
ALTER TABLE Avisos_Responsable ADD PRIMARY KEY (Responsable, Aviso);

--A�adir Foreign Keys
ALTER TABLE Recursos ADD FOREIGN KEY (Almacen) REFERENCES Almacenes;
ALTER TABLE Posiciones ADD FOREIGN KEY (Recurso, Almacen) REFERENCES Recursos (Nombre, Almacen);
ALTER TABLE Temperatura_Ambiente ADD FOREIGN KEY (Almacen) REFERENCES Almacenes;
ALTER TABLE Equipos_Frio ADD FOREIGN KEY (Almacen) REFERENCES Almacenes;
ALTER TABLE Avisos ADD FOREIGN KEY (Recurso, Almacen) REFERENCES Recursos (Nombre, Almacen);
ALTER TABLE Pedidos ADD FOREIGN KEY (Proveedor) REFERENCES Proveedores;
ALTER TABLE Pedidos ADD FOREIGN KEY (ResponsableCompra) REFERENCES Responsables_Compra;
ALTER TABLE Telefonos ADD FOREIGN KEY (Proveedor) REFERENCES Proveedores;
ALTER TABLE Proveedores_Recursos ADD FOREIGN KEY (Proveedor) REFERENCES Proveedores;
ALTER TABLE Proveedores_Recursos ADD FOREIGN KEY (Recurso, Almacen) REFERENCES Recursos (Nombre, Almacen);
ALTER TABLE Avisos_Responsable ADD FOREIGN KEY (Responsable) REFERENCES Responsables_Compra;
ALTER TABLE Avisos_Responsable ADD FOREIGN KEY (Aviso) REFERENCES Avisos;

--A�adir restricciones de tablas
ALTER TABLE Almacenes ADD CONSTRAINT CK_TipoCamara CHECK (TipoCamara IN ('NORMAL', 'CAMARA FRIO', 'CAMARA IN-VITRO'));
ALTER TABLE Recursos ADD CONSTRAINT CK_Tipo_Recurso CHECK (Tipo IN('REACTIVO', 'FUNGIBLE', 'BIOLOGICO'));
ALTER TABLE Usuarios ADD CONSTRAINT CK_Tipo_Usuario CHECK (Tipo IN('TRABAJADOR', 'ADMINISTRADOR'));

--Declaracion Secuencias
CREATE SEQUENCE sec_posiciones;
CREATE SEQUENCE sec_temperatura;
CREATE SEQUENCE sec_equipos;
CREATE SEQUENCE sec_avisos;
CREATE SEQUENCE sec_responsables;
CREATE SEQUENCE sec_pedidos;
CREATE SEQUENCE sec_proveedores;
CREATE SEQUENCE sec_telefonos;

--Declaracion Triggers asociados a Secuencias

CREATE OR REPLACE TRIGGER crea_id_posiciones
BEFORE INSERT ON Posiciones
FOR EACH ROW
BEGIN
    SELECT sec_posiciones.NEXTVAL INTO
    :NEW.ID_PS FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_temperatura
BEFORE INSERT ON Temperatura_Ambiente
FOR EACH ROW
BEGIN
    SELECT sec_temperatura.NEXTVAL INTO
    :NEW.ID_TA FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_equipos
BEFORE INSERT ON Equipos_Frio
FOR EACH ROW
BEGIN
    SELECT sec_equipos.NEXTVAL INTO
    :NEW.ID_EF FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_avisos
BEFORE INSERT ON Avisos
FOR EACH ROW
BEGIN
    SELECT sec_avisos.NEXTVAL INTO
    :NEW.ID_AV FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_Nombresponsables
BEFORE INSERT ON Responsables_Compra
FOR EACH ROW
BEGIN
    SELECT sec_responsables.NEXTVAL INTO
    :NEW.ID_RC FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_pedidos
BEFORE INSERT ON Pedidos
FOR EACH ROW
BEGIN
    SELECT sec_pedidos.NEXTVAL INTO
    :NEW.ID_PD FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_proveedores
BEFORE INSERT ON Proveedores
FOR EACH ROW
BEGIN
    SELECT sec_proveedores.NEXTVAL INTO
    :NEW.ID_PR FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER crea_id_telefonos
BEFORE INSERT ON Telefonos
FOR EACH ROW
BEGIN
    SELECT sec_telefonos.NEXTVAL INTO
    :NEW.ID_TF FROM DUAL;
END;
/

--Creacion de Triggers asociados a reglas funcionales

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
    RAISE_APPLICATION_ERROR(-20003, 'No se puede insertar un almac�n con una temperatura inferior a -10�C');
    END IF;
END;
/