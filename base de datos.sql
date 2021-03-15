CREATE DATABASE `hotel_web`;

CREATE TABLE cargo(
    cargo_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cargo_nombre varchar(20) NOT NULL
);
CREATE TABLE tipo_documento(
    doc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    doc_nombre VARCHAR(20) NOT NULL
);
CREATE TABLE estado_pago(
    estado_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    estado_nombre VARCHAR(20) NOT NULL
);
CREATE TABLE tipohabitacion(
    tipo_hab_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo_hab_nombre varchar(20) NOT NULL
);
CREATE TABLE estadohabitacion(
    estado_hab_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    estado_hab_nombre varchar(20) NOT NULL,
    estado_hab_icon BLOB
);
CREATE TABLE nivel_hotel(
    nivel_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nivel_nombre varchar(20) NOT NULL
); 
CREATE table tiporeserva(
    tipo_res_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo_res_nombre varchar(20) NOT NULL
);
CREATE TABLE producto(
    prod_code varchar(10) PRIMARY KEY,
    prod_nombre varchar(75) NOT NULL,
    prod_precio real NOT NULL,  
    prod_stock smallint NOT NULL
);

CREATE TABLE cliente(
    cli_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cli_tipodocumento_id int NOT NULL,
    f_name varchar(50) NOT NULL,
    l_name varchar(50) NOT NULL,
    identificacion varchar(15) NOT NULL,
    mail varchar(30) NOT NULL,
    cell varchar(20),
    contraseña varchar(16),
    cli_estado_id int,

    FOREIGN KEY (cli_tipodocumento_id) REFERENCES tipo_documento(doc_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (cli_estado_id) REFERENCES estado_pago(estado_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE habitacion(
    hab_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    hab_cliente_id int,
    hab_num int NOT NULL,
    hab_descrip varchar(700),
    hab_huesped int NOT NULL,
    hab_precio real NOT NULL,
    hab_tipo_id int NOT NULL,
    hab_estado_hab_id int,
    hab_nivel_id int NOT NULL,

    FOREIGN KEY (hab_cliente_id) REFERENCES cliente(cli_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,
    
    FOREIGN KEY (hab_tipo_id) REFERENCES tipohabitacion(tipo_hab_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (hab_estado_hab_id) REFERENCES estadohabitacion(estado_hab_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (hab_nivel_id) REFERENCES nivel_hotel(nivel_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE reserva(
    res_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    res_date_in datetime NOT NULL,
    res_date_out datetime NOT NULL,
    res_abono real,
    res_tipo_id int NOT NULL,
    res_hab_id int NOT NULL,
    res_cliente_id int NOT NULL,

    FOREIGN KEY (res_tipo_id) REFERENCES tiporeserva(tipo_res_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (res_hab_id) REFERENCES habitacion(hab_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (res_cliente_id) REFERENCES cliente(cli_id)
    ON DELETE RESTRICT ON UPDATE CASCADE 
);

CREATE TABLE pedidos(
    pedido_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ped_cliente_id int NOT NULL,
    ped_prod__id varchar(10) NOT NULL,
    fecha_hora date NOT NULL,
    cantidad int NOT NULL,
    ped_hab_id int NOT NULL,

    FOREIGN KEY (ped_cliente_id) REFERENCES cliente(cli_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (ped_hab_id) REFERENCES habitacion(hab_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (ped_prod__id) REFERENCES producto(prod_code)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE pedido_price(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ped_order_cli_id int,
    precio_total real NOT NULL,

    FOREIGN KEY (ped_order_cli_id) REFERENCES cliente(cli_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE usuario(
    usu_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usu_cargo__id int NOT NULL,
    usu_nombre varchar(25) NOT NULL,
    usu_apellidos varchar(25) NOT NULL,
    usu_nui varchar(10) NOT NULL,
    usu_celular varchar(10),
    usu_fecha_nacimiento date NOT NULL,
    usu_correo varchar(30) NOT NULL,
    usu_contraseña varchar(16) NOT NULL,
    usu_photo BLOB,

    FOREIGN KEY (usu_cargo__id) REFERENCES cargo(cargo_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE hotel(
    hotel_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    hotel_usu_id int NOT NULL,

    FOREIGN KEY (hotel_usu_id) REFERENCES usuario(usu_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE check_out(
    id_out INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    out_hab_id int,
    out_cliente_id int NOT NULL,
    fyh_envio date NOT NULL,
    out_reserva_id int NOT NULL,
    out_pedidos_id int NOT NULL,
    total_out real NOT NULL,

    FOREIGN KEY (out_hab_id) REFERENCES habitacion(hab_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (out_cliente_id) REFERENCES cliente(cli_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (out_reserva_id) REFERENCES reserva(res_id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

    FOREIGN KEY (out_pedidos_id) REFERENCES pedidos(pedido_id)
    ON DELETE RESTRICT ON UPDATE CASCADE
);