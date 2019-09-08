DECLARE

OID_PROV_ACME INTEGER;
OID_PROV_935 INTEGER;

BEGIN

INSERTAR_USUARIO('irnas', 'qwerty','ancado2011@gmail.com', 'ADMINISTRADOR' );
INSERTAR_USUARIO('trabajador', 'qwerty','angelcado@hotmail.com', 'TRABAJADOR' );

INSERTAR_ALMACENES('Sótano', 22, '12W', 'Normal');
INSERTAR_ALMACENES('Invernadero', 24, 'Natural', 'Normal');
INSERTAR_ALMACENES('Cámara Frigorífica A', -10, '10W4B', 'Cámara Frío');
INSERTAR_ALMACENES('Cámara in-vitro', 19, '4B23R', 'Cámara In-Vitro');

INSERTAR_RECURSOS('Cloruro de sodio','NaCl',15,5.0,7,'Reactivo','Sótano');
INSERTAR_RECURSOS('Acido clorhidrico','HCl',10,1.0,3,'Reactivo','Cámara Frigorífica A');
INSERTAR_RECURSOS('Acido sulfurico','H2SO4',6,1.5,2,'Reactivo','Sótano');
INSERTAR_RECURSOS('Acido nitrico','HNO3',4,3.0,1,'Reactivo','Cámara Frigorífica A');
INSERTAR_RECURSOS('Hidroxido de magnesio','Mg(OH)2',7,2.0,2,'Reactivo','Sótano');
INSERTAR_RECURSOS('Fungible 1',NULL,10,1.0,5,'Fungible','Sótano');
INSERTAR_RECURSOS('Fungible 2',NULL,20,2.0,4,'Fungible','Sótano');
INSERTAR_RECURSOS('Fungible 3',NULL,30,3.0,3,'Fungible','Sótano');
INSERTAR_RECURSOS('Fungible 4',NULL,40,4.0,2,'Fungible','Sótano');
INSERTAR_RECURSOS('Fungible 5',NULL,50,5.0,1,'Fungible','Sótano');
INSERTAR_RECURSOS('Material 1',NULL,10,1.0,5,'Biológico','Invernadero');
INSERTAR_RECURSOS('Material 2',NULL,20,2.0,4,'Biológico','Sótano');
INSERTAR_RECURSOS('Material 3',NULL,30,3.0,3,'Biológico','Invernadero');
INSERTAR_RECURSOS('Material 4',NULL,40,4.0,2,'Biológico','Cámara in-vitro');
INSERTAR_RECURSOS('Material 5',NULL,50,5.0,1,'Biológico','Cámara in-vitro');

INSERTAR_PROVEEDORES('ACME', 'Paco', 'acme@gmail.com');
SELECT SEC_PROVEEDORES.CURRVAL INTO OID_PROV_ACME FROM DUAL;

INSERTAR_PROVEEDORES('935', 'Maxis', 'maxis@gmail.com');
SELECT SEC_PROVEEDORES.CURRVAL INTO OID_PROV_935 FROM DUAL;

COMMIT;

END;