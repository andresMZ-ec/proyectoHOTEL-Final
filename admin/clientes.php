<?php
    include '../conexion_db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - La Campiña</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/solid.css">
</head>
<body>
    <!--agregar nuevo cliente a la base de datos-->
    <div id="overlay_ventAgregar" class="overlay_vent">
        <div class="window-add-cl">
            <div class="h_form">
                <h3>Agregar Cliente</h3>
                <a onclick="openVentAgg()" href="#"><i class="fas fa-times"></i></a>
            </div>
            <div class="f-add-cli">
                <form action="" method="POST">
                    <div class="row">
                        <div class="column">
                            <label for="nui_empleado">NUI o Pasaporte:</label>
                            <input type="tel" id="nui_clienteo" placeholder="Ingrese número de cédula">
                            <label for="name_empleado">Nombres:</label>
                            <input type="text" id="nameNewCLiente" placeholder="Ingrese Nombre">
                            <label for="mail_empleado">Correo Electrónico:</label>
                            <input type="text" id="mailNewLliente">                            
                        </div>

                        <div class="column">
                            <label for="tipo_hab">Tipo de Identificación:</label>
                            <select id="tipoIDNewCliente">
                                <option value="">Seleccioone...</option>
                                <?php
                                    $cliente = mysqli_query($conexion, "SELECT doc_id, doc_nombre FROM tipo_documento");  
                                    while($values = mysqli_fetch_row($cliente)){                                            
                                ?>                                        
                                <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                            </select>
                            <label for="tipo_hab">Apellidos:</label>                            
                            <input type="text" id="apellNewLliente" placeholder="Ingrese Nombre">                            
                            <label for="tel_empleado">Teléfono:</label>
                            <input type="tel" id="cellNewLliente" placeholder="Ingrese número de teléfono">                            
                        </div>
                    </div>   
                    <div class="botones_accionados">
                        <a onclick="openVentAgg()" class="btn_volver" href="#">Volver</a>
                        <a id="btnAddClienteNEW" class="btn_add_employ" href="#">Agregar Cliente</a>
                    </div>
                </form> 
            </div>  
        </div>
    </div>
    <!--VENTANA EMERGENTE PARA EDITAR DATOS DE CLIENTE-->
    <div id="overlay_ventModificar" class="overlay_vent">
        <div class="window-edit-cl">
            <div class="h_form">
                <h3>Editar datos <del></del> Cliente</h3>
                <a onclick="openVentUpdate()" href="#"><i class="fas fa-times"></i></a>
            </div>
            <div class="f-edit-cli">
                <form>
                    <div id="dataCLienteEdit" class="row">
                        <div class="column">
                            <label for="name_cliente">Nombres:</label>
                            <input type="text" id="nameCLienteEdit" value="name_cliente">
                            <label for="nui_cliente">Número de Cédula(NUI):</label>
                            <input type="tel" id="nuiCLienteEdit" value="nui_cliente">
                            <label for="mail_cliente">Correo Electrónico:</label>
                            <input type="text" id="mailCLienteEdit" value="mail_cliente">                            
                        </div>

                        <div class="column">
                            <label for="tipo_hab">Apellidos:</label>
                            <input type="text" id="apellidosCLienteEdit" value="apellidos_cliente">   
                            <label for="tel_cliente">Teléfono:</label>
                            <input type="tel" id="cellCLienteEdit" value="tel_cliente">                            
                        </div>
                    </div>   
                    <div class="botones_accionados">
                        <a onclick="openVentUpdate()" class="btn_volver" href="#">Volver</a>
                        <a id="btnUpdateCliente" class="btn_add_employ" href="#">Agregar Cliente</a>
                    </div>
                </form> 
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
                <a class="opcion active" href="#"><i class="fas fa-user-friends icon_opcion"></i><span class="text_opcion">Clientes</span></a>
                <a class="opcion" href="empleados.html.php"><i class="fas fa-people-carry icon_opcion"></i><span class="text_opcion">Empleados</span></a>
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
                    <h2 class="title_apar">Clientes</h2>
                    <p>Lista de Clientes</p>
                </div>
                <div class="botones_bd">
                    <a class="btn_add" onclick="openVentAgg()" href="#"><i class="fas fa-user-plus"></i>Añadir Cliente</a>
                </div>
            </div>
            <article class="cliente_data">
                <div class="search_cl">
                    <div class="buscador">
                        <input type="text" placeholder="Busque por Nombre, CI o Pasaporte">
                        <a href="#">Buscar</a>
                    </div>
                </div>
                <div class="data_cl">
                    <div class="table_cliente">
                        <div class="thead">
                            <h3 class="type-doc">Tipo Doc.</h3>
                            <h3 class="num_id">Num. Identificación</h3>
                            <h3 class="names_cli">Nombre y Apellido</h3>
                            <h3 class="mail_cli">Correo Electrónico</h3>
                            <h3 class="cell_cli">Teléfono</h3>
                            <h3 class="estado_out">Estado</h3>
                        </div>
                        <div id="mostrarCliente" class="tbody">
                            <div style="width: 100%; height: 200px; text-align:center; padding: 70px 0; opacity: 70%;"><h2>No se encontraron clientes que mostrar</h2></div>                           
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>
</body>
<script src="../JS/clientes.js"></script> 
<script src="../JS/menu.js"></script> 
</html>