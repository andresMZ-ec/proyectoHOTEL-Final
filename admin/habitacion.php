<?php include '../conexion_db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitación - La Campiña</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <script src="../JS/menu.js"></script>
    <script src="../JS/habitacion.js"></script>
</head>
<body>
    <!--ventana de agregar nueva habitacion-->
    <div id="insertNewRoom" class="overlay_vent">
        <div class="window_add">
            <div class="h_form">
                <h3>Agregar Habitación</h3>
                <a href="#" onclick="Windowinsert()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form_add">
                <form action="" method="add_hab">
                    <div class="row">
                        <div class="column">
                            <label for="numero_hab">Número de Habitación:</label>
                            <input type="tel" id="add_numero_hab" placeholder="Ej: 101">
                            <label for="precio_hab">Precio por Noche:</label>
                            <input type="text" id="add_precio_hab" placeholder="Ingrese Precio">
                            <label for="precio_hab">Cantidad de Huéspedes:</label>
                            <input type="text" id="add_huesp_hab" placeholder="Ingrese el máximo de huéspedes">
                            <label for="desc_hab">Descripción de Habitación:</label>
                            <textarea  id="add_desc_hab" cols="33" rows="5" placeholder="Ingrese su Descripción"></textarea>
                        </div>
                        <div class="column">
                            <label for="tipo_hab">Categoría de Habitación:</label>
                            <select id="add_tipo_hab">
                                <option value="">Escoga una Categoría</option>
                                <?php
                                    $categorias = mysqli_query($conexion, "SELECT tipo_hab_id, tipo_hab_nombre FROM tipohabitacion");  
                                    while($values = mysqli_fetch_row($categorias)){                                            
                                ?>                                        
                                <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                            </select>
                            <label for="nivel_hab">¿En qué nivel esta la Habitación?</label>
                            <select id="add_nivel_hab">
                                <option value="">Escoga el nivel del Hotel</option>
                                <?php
                                    $nivel = mysqli_query($conexion, "SELECT nivel_id, nivel_nombre FROM nivel_hotel");  
                                    while($values = mysqli_fetch_row($nivel)){                                            
                                ?>                                        
                                <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                            </select>                              
                        </div>
                    </div>
                    <div class="btn_accion">
                        <a class="btn_cancelar" onclick="Windowinsert()" href="#">Cancelar</a>
                        <a class="btn_agregar" id="btnAggNewHab" href="#">Agregar</a>
                    </div>
                </form> 
                         
            </div>
        </div>
    </div>

    <!--ventana de modificar datos de una habitacion-->
    <div id="editNewRoom" class="overlay_vent">
        <div class="window_edit">
            <div class="h_form">
                <h3>Editar Habitación</h3>
                <a href="#" onclick="WindownEdit()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form_edit">

                <form class="selection_hab" method="POST">
                    <div class="s_habt">
                        <label for="hab_edit">Seleccione la Habitación a Modificar:</label>
                        <select name="hab_edit" id="hab_edithab">
                            <option value="">Selecciona una habitación</option>
                            <?php
                                $habitacion = mysqli_query($conexion, "SELECT hab_id, hab_num FROM habitacion");  
                                while($values = mysqli_fetch_row($habitacion)){                                           
                            ?>                                        
                            <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                        </select>
                    </div>
                </form>               
                    
                <div id="wDatahab" style="display: none;">
                    <form class="hab_detect">
                        <fieldset>
                            <legend>Datos de la Habitación</legend>       
                            <div id="notRan"></div>
                            <p id="correctHab">Número de Habitación: <input type="tel" value=""></p>
                            <p id="correctPrecio">Precio de Habitación: <input type="tel" value=""></p>
                            <p id="correctHuesped">Cantidad de Huéspedes: <input type="tel" value=""></p>
                            <p>Categoría: <select name="edit_catHab" id="edit_catHab"></select></p>
                            <p>Nivel: <select name="edit_nivelHab" id="edit_nivelHab"></select></p>
                            <p id="correctDescrp" class="no_center">Descripción de Habitación: <textarea name="hab_descrip" id="hab_descrip" cols="30" rows="10"></textarea></p>
                            
                            <div class="btn_edit_complete">
                                <a class="btn_cancel_edit" onclick="WindownEdit()" href="#">Cancelar</a>
                                <a id="saveData_modf" class="btn_save_edit" href="#">Guardar Cambios</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--ventana de eliminar una habitacion-->
    <div id="deleteNewRoom" class="overlay_vent">
        <div class="window_delete">
            <div class="h_form">
                <h3>Eliminar Habitación</h3>
                <a href="#" onclick="Windowndelete()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form_delete">

                <form class="selection_hab" method="select_hab">
                    <div class="s_habt">
                        <label for="hab_delete">Seleccione la Habitación a Eliminar:</label>
                        <select name="hab_delete" id="idHabDelete">
                            <option value="">Seleccione Habitación</option>
                            <?php
                                $habitacion = mysqli_query($conexion, "SELECT hab_id, hab_num FROM habitacion WHERE hab_estado_hab_id = 1");  
                                while($values = mysqli_fetch_row($habitacion)){                                            
                            ?>                                        
                            <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                        </select>
                    </div>
                    <input id="sendID_dlt" class="hab_seleccionado" type="submit">
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
                <a class="opcion active" href="#"><i class="fas fa-bed icon_opcion"></i><span class="text_opcion">Habitaciones</span></a>
                <a id="servicios" onclick="servicios()" class="opcion" href="#"><i class="fas fa-headset icon_opcion"></i><span class="text_opcion">Servicios</span><i id="btn_downSer" class="check_down fas fa-chevron-left"></i></a>
                <div id="view_servicios" class="subopcion" id="mostrar_subopcion">
                    <a class="opcion_down" href="ventaAlimentos.php"><span class="text_opcion">Venta de Alimentos</span></a>
                </div>
                <a class="opcion" href="clientes.php"><i class="fas fa-user-friends icon_opcion"></i><span class="text_opcion">Clientes</span></a>
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
        <section class="contenido_main">
            <div class="container_contenido">
                <div class="header_main">
                    <h2 class="title_apar">Habitaciones</h2>
                    <p>Centro de control de habitaciones</p>
                </div>
                <div class="botones_bd">
                    <a class="btn_add" href="#" onclick="Windowinsert()"><i class="fas fa-plus"></i><span>Agregar</span></a>
                    <a class="btn_edit" href="#" onclick="WindownEdit()"><i class="far fa-edit"></i><span>Editar</span></a>
                    <a class="btn_delete" href="#" onclick="Windowndelete()""><i class="fas fa-eraser"></i><span>Eliminar</span></a>
                </div>
            </div>
            <article class="nav_habitaciones">
                
                <div style="padding-top: 25px;" class="contenido">
                    <div id="viewHab" class="hab_box">
                    </div>
                </div>
            </article>         
        </section>
    </main>
    
</body>
</html>

