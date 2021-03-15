<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias Habitación - La Campiña</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
</head>
<body>
    <!--ventana de agregar nueva habitacion-->
    <div id="overlay_ventAgregar" class="overlay_vent">
        <div class="window_add_hab">
            <div class="h_form">
                <h3>Agregar Categoria de Habitación</h3>
                <a href="#" onclick="openVentAgg()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form_add">
                <form id="formAddTipo">
                    <label for="numero_hab">Nombre:</label>
                    <input type="tel" id="nameNewtTipo" placeholder="Ingrese el Tipo de Habitación">
                    <button id="btnAddTipoNEW" class="btn_agregar" type="submit">Agregar</button>
                </form> 
                         
            </div>
        </div>
    </div>

    <!--ventana de editar habitacion-->
    <div id="overlay_ventModificar" class="overlay_vent">
        <div class="window_edit_hab">
            <div class="h_form">
                <h3>Editar Categoría</h3>
                <a href="#"><i class="fas fa-times" onclick="openVentUpdate()"></i></a>
            </div>
            <div class="form_edit">
                <form id="resulDBCat">
                    <div class="data">
                        <label for="type_hab">Nombre:</label>
                        <input type="tel" name="type_hab" value="type_hab">
                    </div>
                    <button class="btn_save" type="submit">Guardar Cambios</button>
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
                <a class="opcion" href="clientes.php"><i class="fas fa-user-friends icon_opcion"></i><span class="text_opcion">Clientes</span></a>
                <a class="opcion" href="empleados.html.php"><i class="fas fa-people-carry icon_opcion"></i><span class="text_opcion">Empleados</span></a>
                <a class="opcion" href="check-out.php"><i class="fas fa-cash-register icon_opcion"></i><span class="text_opcion">Check Out</span></a>
                <a id="btnAdmin" onclick="administracion()" class="opcion active" href="#"><i class="fas fa-tools icon_opcion"></i><span class="text_opcion">Administración</span><i id="btn_downAdm" class="check_down fas fa-chevron-left"></i></a>
                <div class="subopcion active" id="mostrarSubAdmin">
                    <a class="opcion_down active" href="#"><span class="text_opcion">Categoría de Habitaciones</span></a>
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
                    <h2 class="title_apar">Categoría de Habitaciones</h2>
                </div>                
            </div>
            <div class="tipo_habs">
                <div class="btn_conf">
                    <a onclick=" openVentAgg()" class="btn_add" href="#"><i class="fas fa-plus"></i>Agregar Tipo de Habitacion</a>
                </div>
                <div class="table_hab" id="table_hab">
                    <div class="thead">
                        <p class="id_hab">Nº</p>
                        <p class="name_hab">Nombre Habitación</p>
                    </div>
                    <div id="TableViewTipo">
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="../JS/menu.js"></script>
<script src="../JS/cat-habitacion.js"></script>
</html>

