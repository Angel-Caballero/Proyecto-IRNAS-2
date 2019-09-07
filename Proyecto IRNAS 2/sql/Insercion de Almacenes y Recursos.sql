BEGIN

INSERTAR_ALMACENES('Sotano', 22, '12W', 'NORMAL');
INSERTAR_ALMACENES('Invernadero', 24, 'Natural', 'NORMAL');
INSERTAR_ALMACENES('Camara Frigorifica A', -10, '10W4B', 'CAMARA FRIO');
INSERTAR_ALMACENES('Camara in-vitro', 19, '4B23R', 'CAMARA IN-VITRO');


INSERTAR_RECURSOS('Cloruro de sodio','NaCl',15,5.0,7,'REACTIVO','Sotano');
INSERTAR_RECURSOS('Acido clorhidrico','HCl',10,1.0,3,'REACTIVO','Camara Frigorifica A');
INSERTAR_RECURSOS('Acido sulfurico','H2SO4',6,1.5,2,'REACTIVO','Sotano');
INSERTAR_RECURSOS('Acido nitrico','HNO3',4,3.0,1,'REACTIVO','Camara Frigorifica A');
INSERTAR_RECURSOS('Hidroxido de magnesio','Mg(OH)2',7,2.0,2,'REACTIVO','Sotano');
INSERTAR_RECURSOS('Fungible 1',NULL,10,1.0,5,'FUNGIBLE','Sotano');
INSERTAR_RECURSOS('Fungible 2',NULL,20,2.0,4,'FUNGIBLE','Sotano');
INSERTAR_RECURSOS('Fungible 3',NULL,30,3.0,3,'FUNGIBLE','Sotano');
INSERTAR_RECURSOS('Fungible 4',NULL,40,4.0,2,'FUNGIBLE','Sotano');
INSERTAR_RECURSOS('Fungible 5',NULL,50,5.0,1,'FUNGIBLE','Sotano');
INSERTAR_RECURSOS('Material 1',NULL,10,1.0,5,'BIOLOGICO','Invernadero');
INSERTAR_RECURSOS('Material 2',NULL,20,2.0,4,'BIOLOGICO','Sotano');
INSERTAR_RECURSOS('Material 3',NULL,30,3.0,3,'BIOLOGICO','Invernadero');
INSERTAR_RECURSOS('Material 4',NULL,40,4.0,2,'BIOLOGICO','Camara in-vitro');
INSERTAR_RECURSOS('Material 5',NULL,50,5.0,1,'BIOLOGICO','Camara in-vitro');

COMMIT;

END;