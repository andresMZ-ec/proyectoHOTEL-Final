/*
    INSERTAR DATOS
*/

/*CARGO - opciones*/
INSERT INTO cargo(cargo_nombre) VALUES('Administrador');
INSERT INTO cargo(cargo_nombre) VALUES('Recepcionista');
INSERT INTO cargo(cargo_nombre) VALUES('Recursos Humanos');
INSERT INTO cargo(cargo_nombre) VALUES('Conserje');
INSERT INTO cargo(cargo_nombre) VALUES('Personal de Mantenimiento');
INSERT INTO cargo(cargo_nombre) VALUES('Personal de Seguridad');


/*CLIENTE - opciones*/
INSERT INTO tipo_documento(doc_nombre) VALUES('Pasaporte');
INSERT INTO tipo_documento(doc_nombre) VALUES('Cédula de Identidad');

INSERT INTO estado_pago(estado_nombre) VALUES('Pagado');
INSERT INTO estado_pago(estado_nombre) VALUES('No Pagado');

/*HABITACION - opciones*/
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Single');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Single Superior');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Doble');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Triple');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Cuádruple');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Junior Suite');
INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('Apartament');

INSERT INTO estadohabitacion(estado_hab_nombre) VALUES('Disponible');
INSERT INTO estadohabitacion(estado_hab_nombre) VALUES('Ocupado');
INSERT INTO estadohabitacion(estado_hab_nombre) VALUES('Limpieza');
INSERT INTO estadohabitacion(estado_hab_nombre) VALUES('No Disponible');

INSERT INTO nivel_hotel(nivel_nombre) VALUES('PRIMER NIVEL');
INSERT INTO nivel_hotel(nivel_nombre) VALUES('SEGUNDO NIVEL');
INSERT INTO nivel_hotel(nivel_nombre) VALUES('TERCER NIVEL');
INSERT INTO nivel_hotel(nivel_nombre) VALUES('CUARTO NIVEL');
INSERT INTO nivel_hotel(nivel_nombre) VALUES('QUINTO NIVEL');


/* RESERVA - opciones*/
INSERT INTO tiporeserva(tipo_res_nombre) VALUES('Confirmado');
INSERT INTO tiporeserva(tipo_res_nombre) VALUES('Por Confirmar');
INSERT INTO tiporeserva(tipo_res_nombre) VALUES('Cancelado');


/*PRODUCTO - opciones*/
INSERT INTO producto(prod_code ,prod_nombre, prod_precio, prod_stock) VALUES('GAS-001','Coca-Cola Lata original', 1.59, 25);
INSERT INTO producto(prod_code ,prod_nombre, prod_precio, prod_stock) VALUES('SWE-005','Chocolates M&M 49G', 1.39, 60);
INSERT INTO producto(prod_code ,prod_nombre, prod_precio, prod_stock) VALUES('SWE-0010','Chocolates Rocklests 15G', 0.50, 30);
INSERT INTO producto(prod_code ,prod_nombre, prod_precio, prod_stock) VALUES('SNK-002','Doritos 120G Chessier', 1.29, 45);
INSERT INTO producto(prod_code ,prod_nombre, prod_precio, prod_stock) VALUES('ALC-040','Whisky Old Time 750 CC Black', 14.99, 35);