DROP database campamenteoVerano;
create database campamenteoVerano;
USE campamenteoVerano;



create table USUARIS(
						usuari VARCHAR(100),
                        contrasenya VARCHAR(50),
                        PRIMARY KEY(usuari)
                        
)ENGINE=INNODB;

insert into usuaris values 
('soci', 'psoci'),
('admin', 'padmin');




create table INSCRPCIONES(
						codi_Ins VARCHAR(10),
                        fecha_Ins DATE,
                        forma_pago VARCHAR(50),
                        PRIMARY KEY(codi_Ins)
                        
)ENGINE=INNODB;




create table PARTICIPANTES(
						dni VARCHAR(9),
                        nombre VARCHAR(50),
                        apellidos VARCHAR(100),
                        direccion VARCHAR(100),
                        telefono VARCHAR(15),
                        correo VARCHAR(50),
                        fecha_nacimiento date,
                        tarjeta_sanitaria VARCHAR(14),
                        codi_Ins  VARCHAR(10),
                        PRIMARY KEY(dni),
                        foreign key(codi_Ins) references INSCRPCIONES(codi_Ins)
                        
)ENGINE=INNODB;


create table SUPERVISORES(
						dni VARCHAR(9),
                        nombre VARCHAR(50),
                        apellidos VARCHAR(100),
                        direccion VARCHAR(100),
                        telefono VARCHAR(15),
                        correo VARCHAR(50),
                        fecha_nacimiento date,
                        tarjeta_sanitaria VARCHAR(14),
                        roleS VARCHAR(50),
                        PRIMARY KEY(dni)
                        
)ENGINE=INNODB;



create table SUPERVISAR(
						dni_P VARCHAR(9),
                        dni_S VARCHAR(9),
                        PRIMARY KEY(dni_P,dni_S),
                        foreign key(dni_P) references PARTICIPANTES(dni),
                        foreign key(dni_S) references SUPERVISORES(dni)
          
)ENGINE=INNODB;



CREATE TABLE UBICACIONES(
						CODIGO  integer,
						CALLE VARCHAR(50),
						CODIGO_POSTAL VARCHAR (5),
						PUERTA integer,
						PROVINCIA VARCHAR (70),
						PRIMARY KEY (CODIGO)
) ENGINE=INNODB;
CREATE TABLE ACTIVIDADES(
							CODIGO INTEGER,
							DISCRIPCION VARCHAR (50),
							NOMBRE VARCHAR (50),
							COSTOADDICIONAL DOUBLE,
							DURACION VARCHAR (50),
							ESTADO BOOLEAN,
							MATERIAL VARCHAR (200),
                            CODIGO_U INTEGER,
							PRIMARY KEY (CODIGO),
							foreign key(CODIGO_U) REFERENCES UBICACIONES (CODIGO)

)ENGINE=INNODB;



create table ASISTIR(
						dni_P VARCHAR(9),
                        codigo_A integer,
                        fecha date,
                        PRIMARY KEY(dni_P,codigo_A),
                        foreign key(dni_P) references PARTICIPANTES(dni),
                        foreign key(codigo_A) references ACTIVIDADES(codigo)
          
)ENGINE=INNODB;



CREATE TABLE DIRIGIR(  
						DNI_S VARCHAR (9),
						codigo_A INTEGER,
						PRIMARY KEY (DNI_S, codigo_A),
						foreign key (DNI_S) references SUPERVISORES(dni),
                        foreign key (codigo_A) references ACTIVIDADES(codigo)

) ENGINE=INNODB;



CREATE TABLE ALOJARSUPERVISORES(
							CODIGO_U INTEGER,
							CODIGO_S VARCHAR (9),
							FECHA_ENTRADA DATE,
							FECHA_SALIDA DATE ,
                            SALA_HABITACION VARCHAR (50),
							PRIMARY KEY(CODIGO_U, CODIGO_S,SALA_HABITACION),
							foreign key(CODIGO_U) REFERENCES UBICACIONES(CODIGO),
                            foreign key(CODIGO_S) REFERENCES SUPERVISORES(DNI)
                            
)ENGINE=INNODB;



CREATE TABLE ALOJARPARTICIPANTES(
							CODIGO_U INTEGER,
							CODIGO_P VARCHAR (9),
							FECHA_ENTRADA DATE,
							FECHA_SALIDA DATE ,
							SALA_HABITACION VARCHAR (50),
							PRIMARY KEY(CODIGO_U, CODIGO_P,SALA_HABITACION),
							foreign key(CODIGO_U) REFERENCES UBICACIONES(CODIGO),
                            foreign key(CODIGO_p) REFERENCES PARTICIPANTES(DNI)
)ENGINE=INNODB;




/*-----------------Inserció de dades-----------------*/

insert into INSCRPCIONES values ("inscrip0",'2023-11-08',"effectivo"),
								("inscrip1",'2023-11-10',"tarjeta"),
								("inscrip2",'2023-11-08',"tarjeta"),
                                ("inscrip3",'2023-11-20',"tarjeta"),
                                ("inscrip4",'2023-11-18',"tarjeta"),
                                ("inscrip5",'2023-11-07',"effectivo"),
                                ("inscrip6",'2023-11-15',"effectivo"),
                                ("inscrip7",'2023-11-14',"tarjeta"),
                                ("inscrip8",'2023-11-20',"tarjeta"),
                                ("inscrip9",'2023-11-20',"tarjeta");


insert into participantes values
("L42156455", "keyla", "lopez", "Carrer de Girona, 45", "+34 123456489", "keylalopez@gmail.com", '2002-07-25', "keyl5474509412", "inscrip9"),
("N12453675","Manuel","Garcia","Passeig de la Vall d'Hebron, 254","+34 645217589","manuelgarcia@gmail.com", '1999-10-20',"manu1425684326","inscrip0"),
("A64123578", "Maria", "Lopez", "Carrer de la Marina, 123", "+34 678954321", "marialopez@gmail.com", '1998-08-15', "mari987654321", "inscrip1"),
("C71352445", "Carlos", "Martinez", "Avinguda Diagonal, 789", "+34 712345678", "carlosmartinez@gmail.com", '1997-03-07', "carl123456789", "inscrip2"),
("H99542215", "Laura", "Rodriguez", "Rambla de Catalunya, 456", "+34 654789012", "laurarodriguez@gmail.com", '2001-12-03', "laur654321098", "inscrip3"),
("J14765241", "Alejandro", "Fernandez", "Gran Via, 567", "+34 789012345", "alejandrofernandez@gmail.com", '1998-05-22', "alej123098765", "inscrip4"),
("K34551212", "Ana", "Gomez", "Carrer de Sants, 890", "+34 890123456", "anagomez@gmail.com", '2000-09-18', "anaa0987654321", "inscrip5"),
("M74514578", "Javier", "Perez", "Plaça de Catalunya, 123", "+34 901234567", "javierperez@gmail.com", '2000-07-11', "javi987654321", "inscrip6"),
("F95748563", "Elena", "Sanchez", "Passeig de Gracia, 456", "+34 012345678", "elenasanchez@gmail.com", '2001-11-26', "elen8765432109", "inscrip7"),
("S14235265", "Diego", "Hernandez", "Carrer de Balmes, 789", "+34 123456789", "diegohernandez@gmail.com", '2002-04-14', "dieg1234509876", "inscrip8");



insert into supervisores VALUES
("A52445874","Isabel","Fernandez","carrer del Carme, 91","+34 658217589","isabelfernandez@gmail.com", '1982-03-23',"isab1425684326","Robótica y Ingeniería"),
("B65478901", "Samuel", "Martínez", "Avinguda Diagonal, 123", "+34 612345678", "carlosmartinez@gmail.com", '1990-05-15', "carl123456789", "Programación y Desarrollo"),
("C78901234", "Laura", "Gómez", "Plaça de Catalunya, 45", "+34 678901234", "lauragomez@gmail.com", '1995-09-28', "laur567890123", "Diseño Gráfico y Multimedia"),
("D90123456", "jose", "Pérez", "Rambla de Catalunya, 67", "+34 789012345", "javierperez@gmail.com", '1988-11-07', "javi901234567", "Ciberseguridad y Redes"),
("E12345678", "Elena", "Hernández", "Carrer de Balmes, 89", "+34 890123456", "elenahernandez@gmail.com", '1993-02-10', "elen1234567890", "Realidad Virtual y Videojuegos");



insert into SUPERVISAR VALUES
("L42156455","A52445874"),
("N12453675","B65478901"),
("A64123578","C78901234"),
("C71352445","D90123456"),
("H99542215","E12345678"),
("J14765241","A52445874"),
("K34551212","C78901234"),
("M74514578","D90123456"),
("F95748563","A52445874"),
("S14235265","B65478901");


INSERT INTO UBICACIONES ( CODIGO, CALLE, CODIGO_POSTAL, PUERTA, PROVINCIA)
VALUES 
(100, 'Avenida Central', '67890', '4', 'Barcelona'),
(101, 'Calle Tranquila', '09876', '3',  'Girona'),
(102, 'Calle Luminosa', '11111', '2', 'Tarragona');


INSERT INTO ACTIVIDADES
 VALUES
(10, 'Programación y Videojuegos', 'Programación de Videojuegos', '0.0', '1', False, 'Portatil', '100'),
(11, 'Robots en Acción', 'Robótica', '0.0', '2', False , 'Robots', '101'),
(12, 'Diseño Web Creativo', 'Diseño de Páginas Web', '0.0', '2', False, 'Portatil', '102'),
(13, 'App Master', 'Desarrollo de Aplicaciones Móviles', '0.00', '1', False, 'Ordenadores', '101'),
(14, 'Mundo 3D', 'Taller de Impresión 3D', '0.00', '3', False, 'Impresora 3D', '101'),
(15, 'Defensores Cibernéticos', 'Ciberseguridad y Hacking Ético', '0.0', '1', False, 'Portatil', '101'),
(16, 'IA para Principiantes', 'Inteligencia Artificial y Aprendizaje Automatico', '0.0', '2.30', False, 'Portatil', '101'),
(17, 'Electrónica Divertida', 'Electrónica y Circuitos', '0.0', '2', False, 'Kits de Electrónica', '102'),
(18, 'Mundos Virtuales', 'Realidad Virtual (VR) y Realidad Aumentada (AR)', '0', '2', False, 'Gafas VR', '101'),
(19, 'Desafío Tecnológico', 'Competencias Tecnologicas', '0.0', '2', False, 'Portatil', '101'),
(20, 'Drones en el Cielo', 'Taller de Drones', '8', '1.30', False, 'Drones', '102');          



INSERT INTO ASISTIR VALUES

/*participan a todas la actividades*/
("L42156455",10,'2024-06-23'),
("L42156455",11,'2024-06-23'),
("L42156455",12,'2024-06-24'),
("L42156455",13,'2024-06-24'),
("L42156455",14,'2024-06-25'),
("L42156455",15,'2024-06-25'),
("L42156455",16,'2024-06-25'),
("L42156455",17,'2024-06-26'),
("L42156455",18,'2024-06-27'),
("L42156455",19,'2024-06-28'),
("L42156455",20,'2024-06-28'),


("A64123578",10,'2024-06-23'),
("A64123578",11,'2024-06-23'),
("A64123578",12,'2024-06-24'),
("A64123578",13,'2024-06-24'),
("A64123578",14,'2024-06-25'),
("A64123578",15,'2024-06-25'),
("A64123578",16,'2024-06-25'),
("A64123578",17,'2024-06-26'),
("A64123578",18,'2024-06-27'),
("A64123578",19,'2024-06-28'),
("A64123578",20,'2024-06-28'),

("S14235265",10,'2024-06-23'),
("S14235265",11,'2024-06-23'),
("S14235265",12,'2024-06-24'),
("S14235265",13,'2024-06-24'),
("S14235265",14,'2024-06-25'),
("S14235265",15,'2024-06-25'),
("S14235265",16,'2024-06-25'),
("S14235265",17,'2024-06-26'),
("S14235265",18,'2024-06-27'),
("S14235265",19,'2024-06-28'),
("S14235265",20,'2024-06-28'),

("F95748563",10,'2024-06-23'),
("F95748563",11,'2024-06-23'),
("F95748563",12,'2024-06-24'),
("F95748563",13,'2024-06-24'),
("F95748563",14,'2024-06-25'),
("F95748563",15,'2024-06-25'),
("F95748563",16,'2024-06-25'),
("F95748563",17,'2024-06-26'),
("F95748563",18,'2024-06-27'),
("F95748563",19,'2024-06-28'),
("F95748563",20,'2024-06-28'),


("M74514578",10,'2024-06-23'),
("M74514578",11,'2024-06-23'),
("M74514578",12,'2024-06-24'),
("M74514578",13,'2024-06-24'),
("M74514578",14,'2024-06-25'),
("M74514578",15,'2024-06-25'),
("M74514578",16,'2024-06-25'),
("M74514578",17,'2024-06-26'),
("M74514578",18,'2024-06-27'),
("M74514578",19,'2024-06-28'),
("M74514578",20,'2024-06-28'),


("K34551212",10,'2024-06-23'),
("K34551212",11,'2024-06-23'),
("K34551212",12,'2024-06-24'),
("K34551212",13,'2024-06-24'),
("K34551212",14,'2024-06-25'),
("K34551212",15,'2024-06-25'),
("K34551212",16,'2024-06-25'),
("K34551212",17,'2024-06-26'),
("K34551212",18,'2024-06-27'),
("K34551212",19,'2024-06-28'),
("K34551212",20,'2024-06-28'),


/*ausencias por lo tanto no participan a todas las actividades*/

("C71352445",10,'2024-06-23'),
("C71352445",11,'2024-06-23'),
("C71352445",12,'2024-06-24'),
("C71352445",13,'2024-06-24'),
("C71352445",14,'2024-06-25'),
("C71352445",15,'2024-06-25'),
("C71352445",16,'2024-06-25'),
("C71352445",17,'2024-06-26'),
("C71352445",18,'2024-06-27'),

("H99542215",15,'2024-06-25'),
("H99542215",16,'2024-06-25'),
("H99542215",17,'2024-06-26'),
("H99542215",18,'2024-06-27'),
("H99542215",19,'2024-06-28'),
("H99542215",20,'2024-06-28'),

("J14765241",12,'2024-06-24'),
("J14765241",13,'2024-06-24'),
("J14765241",14,'2024-06-25'),
("J14765241",15,'2024-06-25'),
("J14765241",16,'2024-06-25'),
("J14765241",17,'2024-06-26'),
("J14765241",18,'2024-06-27'),

("N12453675",10,'2024-06-23'),
("N12453675",12,'2024-06-24'),
("N12453675",14,'2024-06-25'),
("N12453675",18,'2024-06-27'),
("N12453675",20,'2024-06-28');


insert into  DIRIGIR values
("A52445874",10),
("A52445874",11),
("A52445874",12),
("B65478901",13),
("B65478901",14),
("B65478901",15),
("D90123456",16),
("D90123456",17),
("D90123456",18),
("E12345678",19),
("E12345678",20);

insert into ALOJARSUPERVISORES values 
(100,"A52445874",'2024-06-23','2024-06-25',170),
(101,"A52445874",'2024-06-25','2024-06-28',250),
(102,"A52445874",'2024-06-28','2024-06-29',111),

(100,"B65478901",'2024-06-23','2024-06-25',170),
(101,"B65478901",'2024-06-25','2024-06-28',250),
(102,"B65478901",'2024-06-28','2024-06-29',112),

(100,"C78901234",'2024-06-23','2024-06-25',170),
(101,"C78901234",'2024-06-25','2024-06-28',252),
(102,"C78901234",'2024-06-28','2024-06-29',113),

(100,"D90123456",'2024-06-23','2024-06-25',171),
(101,"D90123456",'2024-06-25','2024-06-28',253),
(102,"D90123456",'2024-06-28','2024-06-29',114),

(100,"E12345678",'2024-06-23','2024-06-25',171),
(101,"E12345678",'2024-06-25','2024-06-28',254),
(102,"E12345678",'2024-06-28','2024-06-29',115);


insert into ALOJARPARTICIPANTES values 
(100,"L42156455",'2024-06-23','2024-06-25',100),
(101,"L42156455",'2024-06-25','2024-06-28',300),
(102,"L42156455",'2024-06-28','2024-06-29',8),

(100,"N12453675",'2024-06-23','2024-06-25',100),
(101,"N12453675",'2024-06-25','2024-06-28',300),
(102,"N12453675",'2024-06-28','2024-06-29',8),

(100,"A64123578",'2024-06-23','2024-06-25',100),
(101,"A64123578",'2024-06-25','2024-06-28',301),
(102,"A64123578",'2024-06-28','2024-06-29',8),

(100,"C71352445",'2024-06-23','2024-06-25',100),
(101,"C71352445",'2024-06-25','2024-06-28',301),
(102,"C71352445",'2024-06-28','2024-06-29',9),

(100,"H99542215",'2024-06-23','2024-06-25',103),
(101,"H99542215",'2024-06-25','2024-06-28',302),
(102,"H99542215",'2024-06-28','2024-06-29',9),


(100,"J14765241",'2024-06-23','2024-06-25',103),
(101,"J14765241",'2024-06-25','2024-06-28',302),
(102,"J14765241",'2024-06-28','2024-06-29',11),

(100,"K34551212",'2024-06-23','2024-06-25',103),
(101,"K34551212",'2024-06-25','2024-06-28',303),
(102,"K34551212",'2024-06-28','2024-06-29',11),

(100,"M74514578",'2024-06-23','2024-06-25',103),
(101,"M74514578",'2024-06-25','2024-06-28',303),
(102,"M74514578",'2024-06-28','2024-06-29',12),

(100,"F95748563",'2024-06-23','2024-06-25',103),
(101,"F95748563",'2024-06-25','2024-06-28',304),
(102,"F95748563",'2024-06-28','2024-06-29',15),

(100,"S14235265",'2024-06-23','2024-06-25',103),
(101,"S14235265",'2024-06-25','2024-06-28',304),
(102,"S14235265",'2024-06-28','2024-06-29',12);


