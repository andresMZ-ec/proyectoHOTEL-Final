<?php
include '../../conexion_db.php';

$usuarios = $conexion->query('SELECT * FROM usuario ORDER BY usu_id DESC');
  

if(isset($_GET['id'])){

    $id=(int) $_GET['id'];
    $resultado = $conexion->query("SELECT * FROM usuario WHERE usu_id= {$id} LIMIT 1");
	$usuario= mysqli_fetch_array($resultado);

	}



	if(isset($_POST['btn_edit'])){

	
		$id=(int) $_GET['id'];	
		$name_empleado = utf8_decode($_POST['name_empleado']);
		$nui_empleado = utf8_decode($_POST['nui_empleado']);
		$mail_empleado = utf8_decode($_POST['mail_empleado']);
		$pass_empleado = utf8_decode($_POST['pass_empleado']);
		$apellido_empleado = utf8_decode($_POST['apellido_empleado']);
		$tel_empleado = utf8_decode($_POST['tel_empleado']);
		$date_nac_empleado = utf8_decode($_POST['date_nac_empleado']);
		
		$empleado = (isset($_POST['name_empleado']) && !empty($_POST['name_empleado'])) &&
					(isset($_POST['nui_empleado']) && !empty($_POST['nui_empleado'])) &&
					(isset($_POST['mail_empleado']) && !empty($_POST['mail_empleado'])) &&
					(isset($_POST['pass_empleado']) && !empty($_POST['pass_empleado']))&&
					(isset($_POST['apellido_empleado']) && !empty($_POST['apellido_empleado'])) &&
					(isset($_POST['tel_empleado']) && !empty($_POST['tel_empleado']))&&
					(isset($_POST['date_nac_empleado']) && !empty($_POST['date_nac_empleado']));
		
        if ( $empleado ) {
			
			$consulta_update = $conexion->query("UPDATE usuario SET  
			usu_nombre='{$name_empleado}',
			usu_nui='{$nui_empleado}',
			usu_correo='{$mail_empleado}',
			usu_contraseña='{$pass_empleado}',
			usu_apellidos='{$apellido_empleado}',
			usu_celular='{$tel_empleado}',
			usu_fecha_nacimiento='{$date_nac_empleado}'
			WHERE usu_id={$id}"
		);

		echo"<script>  window.location = '../empleados.html.php'</script>";


			
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	

	}

?>

	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - La Campiña</title>
    <link rel="stylesheet" href="../../CSS/estilos.css">
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/solid.css">
    <script src="../../JS/empleado.js"></script>
    
</head>
<body>
  

        <!--editar datos de empleado a la base de datos-->
        <div id="viewModalEditar" style="display: block;">
    <div class="overlay_vent active">
        <div class="window-edit-e">
            <div class="h_form">
                <h3>Editar Datos de Empleado</h3>
                <a href="../empleados.html.php"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-edit"> 
                <form action="" method="POST">
                    <div class="row">
                        <div class="column">
                            <label for="name_empleado">Nombres:</label>
                            <input type="text" name="name_empleado" id="name_empleado" value="<?php if($resultado && $usuario && $usuario['usu_nombre']) echo $usuario['usu_nombre']; ?>" > 
                            <label for="nui_empleado">Número de Cédula(NUI):</label>
                            <input type="tel" name="nui_empleado" id="nui_empleado" value="<?php if($resultado && $usuario && $usuario['usu_nui']) echo $usuario['usu_nui']; ?>">
                            <label for="mail_empleado">Correo Electrónico:</label>
                            <input type="text" name="mail_empleado" id="mail_empleado" value="<?php if($resultado && $usuario && $usuario['usu_correo']) echo $usuario['usu_correo']; ?>">
                            <label for="pass_empleado">Contraseña:</label>
                            <input type="text" name="pass_empleado" id="pass_empleado" value="<?php if($resultado && $usuario && $usuario['usu_contraseña']) echo $usuario['usu_contraseña']; ?>">
                        </div>
                        <div class="column">
                            <label for="tipo_hab">Apellidos:</label>
                            <input type="text" name="apellido_empleado" id="apellido_empleado" value="<?php if($resultado && $usuario && $usuario['usu_apellidos']) echo $usuario['usu_apellidos']; ?>">                            
                            <label for="tel_empleado">Teléfono:</label>
                            <input type="tel" name="tel_empleado" id="tel_empleado" value="<?php if($resultado && $usuario && $usuario['usu_celular']) echo $usuario['usu_celular']; ?>">
                            <label for="date_nac_empleado">Fecha de Nacimiento:</label>
                            <input type="date" name="date_nac_empleado" id="date_nac_empleado" value="<?php if($resultado && $usuario && $usuario['usu_fecha_nacimiento']) echo $usuario['usu_fecha_nacimiento']; ?>">                           
                        </div>
                    </div>  
                    <div class="editar_emp">
						<input class="btn_save" name="btn_edit" type="submit" value="Actualizar datos" style="cursor: pointer;"/>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <header class="header_admin">
        <div class="cont_h_admin">
            <div class="logo">
                <a href="#"><img src="../../images/campiña-logo.png" height="35px" alt="logo-campiña"></a>
            </div>
            <div class="infor_count">                
                <a href="#">lacampiña@web.com</a>
            </div>
        </div>
    </header>    
    <nav>
        <div class="container_menu">
            <!--informacion de perfil-->
            <div class="miperfil">
                <div class="container_perfil">
                    <div class="images">
                        <a href="#"><img height="100px" src="../../images/imagen de perfil.jpg" alt=""></a>
                    </div>
                    <div class="descrip">
                        <p class="tipo_user">Administrador</p>
                        <p class="name_user">Moncayo Zambrano Andrés Alejandro</p>
                    </div>
                </div>
            </div>
            <div class="opciones_menu">
                <a class="opcion" href="#"><i class="fas fa-hotel icon_opcion"></i><span class="text_opcion">General</span></a>
                <a class="opcion" href="#"><i class="fas fa-bed icon_opcion"></i><span class="text_opcion">Habitaciones</span></a>
                <a class="opcion" href="#"><i class="fas fa-headset icon_opcion"></i><span class="text_opcion">Servicios</span><i class="check_down fas fa-chevron-left"></i></a>
                <div class="subopcion" id="mostrar_subopcion">
                    <a class="opcion_down" href="#"><span class="text_opcion">Venta de Alimentos</span></a>
                </div>
                <a class="opcion" href="#"><i class="fas fa-calendar-alt icon_opcion"></i><span class="text_opcion">Reservas</span></a>
                <a class="opcion" href="#"><i class="fas fa-user-friends icon_opcion"></i><span class="text_opcion">Clientes</span></a>
                <a class="opcion" href="#"><i class="fas fa-cash-register icon_opcion"></i><span class="text_opcion">Check Out</span></a>
                <a class="opcion" href="#"><i class="fas fa-tools icon_opcion"></i><span class="text_opcion">Administración</span><i class="check_down fas fa-chevron-left"></i></a>
                <div class="subopcion active" id="mostrar_subopcion">
                    <a class="opcion_down" href="#"><span class="text_opcion">Categoría de Habitaciones</span></a>
                    <a class="opcion_down active" href="#"><span class="text_opcion">Empleados</span></a>
                    <a class="opcion_down" href="#"><span class="text_opcion">Niveles de Hotel</span></a>
                    <a class="opcion_down" href="#"><span class="text_opcion">Productos</span></a>
                    <a class="opcion_down" href="#"><span class="text_opcion">Puestos de Trabajo</span></a>
                </div>
            </div>
            <!--deslogear y creditos-->
            <div class="menu_footer">
                <div class="des_login">
                    <a href="#"><i class="fas fa-sign-in-alt icon_dl"></i> <span>Cerrar Sesión</span></a>
                </div>
                <div class="credits">
                    <p>Hotel La Campiña <br> Todos los Derechos Reservados</p>
                    <p>Cuarto "A"</p>
                </div>
            </div>
        </div>
    </nav>

    <main class="main_admin">
        <section class="container_main">
            <div class="container_contenido">
                <div class="header_main_emp">
                    <h2 class="title_apar">Lista de Empleados</h2>
                    <p>Empleados activos</p>
                </div>
                <div class="botones_bd">
                    <a class="btn_add_employ" href="#"><i class="fas fa-user-plus" onclick="ModalEmpleado()"></i>Agregar Nuevo Empleado</a>
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
                        <?php foreach($usuarios as $fila):?>
                        <div class="tbody">
                                <div class="row_emp">
                               <!-- DESCOMENTAR CUANDO SE CORRIJA LA RELACION ENTRE EMPLEADO Y CARGO -->
                                <!-- <p class="type-emp"> <?php echo $fila['cargo_nombre'];?></p> -->

                                <p class="type-emp"> <?php echo $fila['usu_cargo__id'];?></p>
                                <p class="num_id"> <?php echo $fila['usu_id']; ?></p>
                                <p class="names_emp"> <?php echo $fila['usu_nombre'].' '. $fila['usu_apellidos']; ?></p>
                                <p class="date_bthd"> <?php echo $fila['usu_fecha_nacimiento']; ?></p>
                                <p class="mail_emp"> <?php echo $fila['usu_correo']; ?></p>
                                <p class="cell_emp"> <?php echo $fila['usu_celular']; ?></p>
                                <div class="botones"><a href="#" class="btn_dlt_emp" ><i class="far fa-trash-alt"></i></a></div> 
                                <div class="botones"><a href="#" class="btn_edit_emp" name='btn-edit'><i class="fas fa-edit" ></i></a></div>
               
            <!-- </div> -->
        </div>
    </div>
            <?php endforeach ?>
                            
                </div>
            </article>
        </section>
    </main>
</body>
</html>
