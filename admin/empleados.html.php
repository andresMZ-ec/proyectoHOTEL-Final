<?php
include '../conexion_db.php';


    // metodo buscar
    
    //DESCOMENTAR CUANDO SE CORRIJA LA RELACION ENTRE EMPLEADO Y CARGO

	if(isset($_POST['btn_buscar'])&& !empty($_POST['buscar'])){
		$buscar_text=$_POST['buscar'];
		
        $select_buscar = $conexion->query("SELECT * FROM usuario INNER JOIN cargo ON usu_cargo__id = cargo.cargo_id WHERE usu_nombre LIKE '{$buscar_text}' OR usu_apellidos LIKE '{$buscar_text}' OR usu_nui LIKE '{$buscar_text}' ");
        $usuarios = $select_buscar;

	}else{
        // mostrar tablas
        $usuarios = $conexion->query('SELECT * FROM usuario INNER JOIN cargo ON usu_cargo__id = cargo.cargo_id ORDER BY usu_id DESC'  );
    }

    $cargos = $conexion->query('SELECT * FROM cargo'  );

    // ELIMINAR CUANDO SE CORRIJA LA RELACION ENTRE EMPLEADO Y CARGO
    // if(isset($_POST['btn_buscar'])&& !empty($_POST['buscar'])){
	// 	$buscar_text=$_POST['buscar'];
		
    //     $select_buscar = $conexion->query("SELECT * FROM usuario  WHERE usu_nombre LIKE '{$buscar_text}' OR usu_apellidos LIKE '{$buscar_text}' OR usu_nui LIKE '{$buscar_text}' ");
    //     $usuarios = $select_buscar;

	// }else{
    //     // mostrar tablas
    //     $usuarios = $conexion->query('SELECT * FROM usuario ORDER BY usu_id DESC'  );
    // }

    //
    

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - La Campiña</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/solid.css">
    <script src="../JS/empleado.js"></script>
    <script src="../JS/menu.js"></script>
</head>
<body>
    <!--agregar nuevo empleado a la base de datos-->
<div id="viewModal" style="display: none;">
    <div class="overlay_vent active" >
        <div class="window_insert">
            <div class="h_form">
                <h3>Agregar Nuevo Empleado</h3>
                <a href="#"><i class="fas fa-times" onclick="ModalEmpleado()"></i></a>
            </div>
            <div class="form_add_emp">
                <form action="./empleado/insert_empleado.php" method="POST">
                    <div class="row">
                        <div class="column">
                            <label for="name_empleado">Nombres:</label>
                            <input type="text" name="name_empleado" placeholder="Ingrese Nombre">
                            <label for="nui_empleado">Número de Cédula(NUI):</label>
                            <input type="tel" name="nui_empleado" maxlength="10" placeholder="Ingrese número de cédula">
                            <label for="mail_empleado">Correo Electrónico:</label>
                            <input type="email" name="mail_empleado" placeholder="Ingrese correo electronico">
                            <label for="pass_empleado">Contraseña:</label>
                            <input type="text" name="pass_empleado" placeholder="Ingrese contraseña">
                        </div>
                        <div class="column">
                            <label for="tipo_hab">Apellidos:</label>
                            <input type="text" name="apellido_empleado" placeholder="Ingrese Nombre">                            
                            <label for="tel_empleado">Teléfono:</label>
                            <input type="number" name="tel_empleado" placeholder="Ingrese número de teléfono">
                            <label for="date_nac_empleado">Fecha de Nacimiento:</label>
                            <input type="date" name="date_nac_empleado" placeholder="día/mes/año">  

                            <label for="date_nac_empleado1">Cargo:</label>
                            
                            <select name="select_cargo">
                                <?php foreach($cargos as $cargo):?>
                            <option name="cargo_emp" value=<?php echo $cargo['cargo_id'];?>><?php echo $cargo['cargo_nombre'];?></option>
                            <?php endforeach ?>
                            </select> 
                       
                        </div>
                    </div>   
                    <div id="botones_accionados">
                        <a class="btn_volver" onclick="ModalEmpleado()" style="cursor: pointer;">Volver</a>
                        <input class="btn_add_employ" name="submit" type="submit" value="Agregar Empleado" style="cursor: pointer;"/>
                    </div>
                </form> 
            </div>  
        </div>
    </div>
</div>

        <!--editar datos de empleado a la base de datos-->
        <div id="viewModalEditar" style="display: none;">
    <div class="overlay_vent active">
        <div class="window-edit-e">
            <div class="h_form">
                <h3>Editar Datos de Empleado</h3>
                <a href="#"onclick="CerrarModalEditarEmpleado()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-edit"> 
                <form action="" method="POST">
                    <div class="row">
                        <div class="column">
                            <label for="name_empleado">Nombres:</label>
                            <input type="text" name="name_empleado" id="name_empleado">
                            <label for="nui_empleado">Número de Cédula(NUI):</label>
                            <input type="tel" name="nui_empleado" id="nui_empleado">
                            <label for="mail_empleado">Correo Electrónico:</label>
                            <input type="text" name="mail_empleado" id="mail_empleado">
                            <label for="pass_empleado">Contraseña:</label>
                            <input type="text" name="pass_empleado" id="pass_empleado">
                        </div>
                        <div class="column">
                            <label for="tipo_hab">Apellidos:</label>
                            <input type="text" name="apellido_empleado" id="apellido_empleado">                            
                            <label for="tel_empleado">Teléfono:</label>
                            <input type="tel" name="tel_empleado" id="tel_empleado">
                            <label for="date_nac_empleado">Fecha de Nacimiento:</label>
                            <input type="date" name="date_nac_empleado" id="date_nac_empleado">                           
                        </div>
                    </div>  
                    <div class="editar_emp">
                        <a class="btn_save" href="#">Guardar Datos</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <header class="header_admin">
        <div class="cont_h_admin">
            <div class="logo">
                <a href="#"><img src="../images/campiña-logo.png" height="35px" alt="logo-campiña"></a>
            </div>
            <div id="btnOpenMenu" onclick="abrirMenu()" class="btnOpenMenu"><i class="fas fa-bars"></i></div>
            <div id="mailEmp" class="infor_count">                
                <a href="#">lacampiña@web.com</a>
            </div>
        </div>
    </header>    
    <nav>
        <div id="navHotelCont" class="container_menu">

            <div class="miperfil">
                <div class="container_perfil">
                    <div class="images">
                        <a href="#"><img height="100px" src="../images/imagen de perfil.jpg" alt=""></a>
                    </div>
                    <div id="dataEmp" class="descrip">
                        <p class="tipo_user">Administrador</p>
                        <p class="name_user">Moncayo Zambrano Andrés Alejandro</p>
                    </div>
                </div>
            </div>
            <div id="opciones_menu" class="opciones_menu">
                <a class="opcion" href="admin.php"><i class="fas fa-hotel icon_opcion"></i><span class="text_opcion">General</span></a>
                <a class="opcion" href="habitacion.php"><i class="fas fa-bed icon_opcion"></i><span class="text_opcion">Habitaciones</span></a>
                <a id="servicios" onclick="servicios()" class="opcion" href="#"><i class="fas fa-headset icon_opcion"></i><span class="text_opcion">Servicios</span><i id="btn_downSer" class="check_down fas fa-chevron-left"></i></a>
                <div id="view_servicios" class="subopcion" id="mostrar_subopcion">
                    <a class="opcion_down" href="ventaAlimentos.php"><span class="text_opcion">Venta de Alimentos</span></a>
                </div>
                <a class="opcion" href="clientes.php"><i class="fas fa-user-friends icon_opcion"></i><span class="text_opcion">Clientes</span></a>
                <a class="opcion active" href="#"><i class="fas fa-people-carry icon_opcion"></i><span class="text_opcion">Empleados</span></a>
                <a class="opcion" href="check-out.php"><i class="fas fa-cash-register icon_opcion"></i><span class="text_opcion">Check Out</span></a>
                <a id="btnAdmin" onclick="administracion()" class="opcion" href="#"><i class="fas fa-tools icon_opcion"></i><span class="text_opcion">Administración</span><i id="btn_downAdm" class="check_down fas fa-chevron-left"></i></a>
                <div class="subopcion" id="mostrarSubAdmin">
                    <a class="opcion_down" href="categoria-habitaciones.php"><span class="text_opcion">Categoría de Habitaciones</span></a>
                    <a class="opcion_down" href="niveles-hotel.php"><span class="text_opcion">Niveles de Hotel</span></a>
                    <a class="opcion_down" href="productos.php"><span class="text_opcion">Productos</span></a>
                    <a class="opcion_down" href="puestos-trabajo.html.php"><span class="text_opcion">Puestos de Trabajo</span></a>
                </div>
            </div>
            <div class="container-footer">
                <div class="menu_footer">
                    <div class="des_login">
                        <a href="#"><i class="fas fa-sign-in-alt icon_dl"></i> <span>Cerrar Sesión</span></a>
                    </div>
                    <div class="credits">
                        <p>Hotel La Campiña <br> Todos los Derechos Reservados</p>
                        <p>Quinto "A"</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="main_admin">
        <section class="container_main">
            <div class="container_contenido">
                <div class="header_main">
                    <h2 class="title_apar">Lista de Empleados</h2>
                    <p>Lista de Empleados Contratados</p>
                </div>
                <div class="botones_bd">
                    <a class="btn_add_employ" href="#" onclick="ModalEmpleado()"><i class="fas fa-user-plus" ></i>Agregar Nuevo Empleado</a>
                </div>
            </div>

            <article class="employ_data">
                <div class="search_employ">
                    <form action="" method="post">
                    <div class="buscador">
                        <input type="text" placeholder="Busque por Nombre, CI o Pasaporte" name="buscar" 
                        >
                        <input type="submit" class="input-buscador" name="btn_buscar" value="Buscar Empleado">
                    </div>
                </form>
                </div>
                <div class="data_employ">
                    <div class="table_employ">
                        <div class="thead">
                            <h3 class="type-emp">Cargo</h3>
                            <h3 class="num_id">Num. Identificación</h3>
                            <h3 class="names_emp">Nombre y Apellido</h3>
                            <h3 class="date_bthd">Fecha Nacimiento</h3>
                            <h3 class="mail_emp">Correo Electrónico</h3>
                            <h3 class="cell_emp">Teléfono</h3>
                        </div>

                        <!-- TABLA EMPLEADO -->
                        <?php foreach($usuarios as $fila):?>
                        <div class="tbody">
                                <div class="row_emp">

                                    <!-- DESCOMENTAR CUANDO SE CORRIJA LA RELACION ENTRE EMPLEADO Y CARGO -->
                                <p class="type-emp"> <?php echo $fila['cargo_nombre'];?></p>

                                <!-- <p class="type-emp"> <?php echo $fila['usu_cargo__id'];?></p> -->
                                <p class="num_id"> <?php echo $fila['usu_nui']; ?></p>
                                <p class="names_emp"> <?php echo $fila['usu_nombre'].' '. $fila['usu_apellidos']; ?></p>
                                <p class="date_bthd"> <?php echo $fila['usu_fecha_nacimiento']; ?></p>
                                <p class="mail_emp"> <?php echo $fila['usu_correo']; ?></p>
                                <p class="cell_emp"> <?php echo $fila['usu_celular']; ?></p>
                                <div class="botones"><a href="./empleado/delete_empleado.php?id=<?php echo $fila['usu_id']; ?>" class="btn_dlt_emp" ><i class="far fa-trash-alt"></i></a></div> 
                                <div class="botones"><a href="./empleado/edit_empleado.php?id=<?php echo $fila['usu_id']; ?>" class="btn_edit_emp" name='btn-edit'><i class="fas fa-edit" ></i></a></div>
               
        </div>
    </div>
            <?php endforeach ?>
                            
                </div>
            </article>
        </section>
    </main>
</body>
</html>