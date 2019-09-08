DECLARE

OID_PROV_ACME INTEGER;
OID_PROV_935 INTEGER;

BEGIN

INSERTAR_USUARIO('irnas', 'qwerty','ancado2011@gmail.com', 'ADMINISTRADOR' );
INSERTAR_USUARIO('trabajador', 'qwerty','angelcado@hotmail.com', 'TRABAJADOR' );

INSERTAR_ALMACENES('S�tano', 22, '12W', 'Normal');
INSERTAR_ALMACENES('Invernadero', 24, 'Natural', 'Normal');
INSERTAR_ALMACENES('C�mara Frigor�fica A', -10, '10W4B', 'C�mara Fr�o');
INSERTAR_ALMACENES('C�mara in-vitro', 19, '4B23R', 'C�mara In-Vitro');

INSERTAR_RECURSOS('Cloruro de sodio','NaCl',15,5.0,7,'Reactivo','S�tano');
INSERTAR_RECURSOS('Acido clorhidrico','HCl',10,1.0,3,'Reactivo','C�mara Frigor�fica A');
INSERTAR_RECURSOS('Acido sulfurico','H2SO4',6,1.5,2,'Reactivo','S�tano');
INSERTAR_RECURSOS('Acido nitrico','HNO3',4,3.0,1,'Reactivo','C�mara Frigor�fica A');
INSERTAR_RECURSOS('Hidroxido de magnesio','Mg(OH)2',7,2.0,2,'Reactivo','S�tano');
INSERTAR_RECURSOS('Fungible 1',NULL,10,1.0,5,'Fungible','S�tano');
INSERTAR_RECURSOS('Fungible 2',NULL,20,2.0,4,'Fungible','S�tano');
INSERTAR_RECURSOS('Fungible 3',NULL,30,3.0,3,'Fungible','S�tano');
INSERTAR_RECURSOS('Fungible 4',NULL,40,4.0,2,'Fungible','S�tano');
INSERTAR_RECURSOS('Fungible 5',NULL,50,5.0,1,'Fungible','S�tano');
INSERTAR_RECURSOS('Material 1',NULL,10,1.0,5,'Biol�gico','Invernadero');
INSERTAR_RECURSOS('Material 2',NULL,20,2.0,4,'Biol�gico','S�tano');
INSERTAR_RECURSOS('Material 3',NULL,30,3.0,3,'Biol�gico','Invernadero');
INSERTAR_RECURSOS('Material 4',NULL,40,4.0,2,'Biol�gico','C�mara in-vitro');
INSERTAR_RECURSOS('Material 5',NULL,50,5.0,1,'Biol�gico','C�mara in-vitro');

INSERTAR_PROVEEDORES('ACME', 'Paco', 'acme@gmail.com');
SELECT SEC_PROVEEDORES.CURRVAL INTO OID_PROV_ACME FROM DUAL;

INSERTAR_PROVEEDORES('935', 'Maxis', 'maxis@gmail.com');
SELECT SEC_PROVEEDORES.CURRVAL INTO OID_PROV_935 FROM DUAL;

COMMIT;

END;