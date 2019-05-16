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
FichaSeguridad VARCHAR(50),
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
ALTER TABLE Usuarios ADD CONSTRAINT CK_Tipo_Usuario CHECK (Tipo IN('TRABAJADOR', 'ADMIISTRADOR'));

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
