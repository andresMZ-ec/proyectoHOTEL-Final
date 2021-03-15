<?php
    include '../conexion_db.php';

    /* session_start();
    if(isset($_SESSION['nameuser'])){
        $userLogin = $_SESSION['nameuser'];
    }else{
        header('location: login.php');
    } */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - La Campiña</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
    <script src="https://kit.fontawesome.com/34cf304f66.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
    <link rel="preconnect" href="https://fonts.gstatic.com">

</head>
<body>
    <!-- VENTANA PARA MODIFICAR UNA RESERVA -->
    <div id="ventanaEditarReserva" class="overlay_vent">
        <div class="window_edit">
            <div class="h_form">
                <h3>Editar Reserva</h3>
                <a id="btnCloseEdit" href="#" onclick="closeVentEmergente()"><i class="fas fa-times"></i></a>
            </div>
            <div class="form_edit_reserva">
                <form id="saveEdit_r" name="new_res_add" method="POST">                     
                    <div id="viewDataReserva_Edit" class="contenido">
                        <div class="registros"><span>Fecha de Entrada:</span><div class="caja-escrit"><input type="datetime-local" id="edt_dateIN"></div> </div>
                        <div class="registros"><span>Fecha de Salida:</span><div class="caja-escrit"><input type="datetime-local" id="edt_dateOUT"></div> </div>
                        <div class="registros reserva_input"><span>Número de Habitación:</span> 
                            <select name="tipo_hab" id="edt_habNUM" required>
                                <option value="">Seleccione número</option>
                            </select>
                        </div> 
                        <div class="registros"><span>Nombre Cliente:</span><div class="caja-escrit"><input type="text" id="edt_name"></div> </div>
                        <div class="registros"><span>Apellido Cliente:</span><div class="caja-escrit"><input type="text" id="edt_apell"></div> </div>
                        <div class="registros"><span>Abonado:</span><div class="caja-escrit"><input type="text" id="edt_abono"></div> </div>
                        
                        
                        <div class="registros reserva_indivut"><span>Tipo de Reserva:</span>
                            <select name="tipo_res" id="edt_typeRes">
                                <option value="">Ninguno</option>
                                <?php
                                    $opcion_type_r = mysqli_query($conexion, "SELECT * FROM tiporeserva"); 
                                    while($values = mysqli_fetch_row($opcion_type_r)){                                            
                                ?>                                        
                                <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                            </select>
                        </div>
                    </div>    

                    <div class="acciones">
                        <a href="#" onclick="closeVentEmergente()" class="cancel-res">Cancelar</a>
                        <button class="send-res" type="submit">Confirmar Reserva</button>                         
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
                <a class="opcion active" href="#"><i class="fas fa-hotel icon_opcion"></i><span class="text_opcion">General</span></a>
                <a class="opcion" href="habitacion.php"><i class="fas fa-bed icon_opcion"></i><span class="text_opcion">Habitaciones</span></a>
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
    <main class="main_admin main_general">       
        <div id="head_main">
            <h1>Hotel La Campiña</h1>
        </div> 
        <section class="add_reserva">
            <div class="general" id="detalle_general">
                <div class="g_dtlls">
                    <p id="cont_datas">Habitaciones Ocupadas: <span id="hab_dtll"></span></p>
                </div>
                <div class="g_dtlls">
                    <p >Reservas Realizadas: <span id="res_dtll"></span></p>
                </div>
                <div class="g_dtlls">
                    <p >Cantidad de Empleados: <span id="emp_dtll"></span></p>
                </div>
            </div>
            <article class="añadir_new_res">
                <div class="new_res">
                    <a href="#" id="new_reserva" class="btn_new_res"><i class="far fa-calendar-plus"></i> Nueva Reserva</a>
                </div>
                <div id="container_form" class="form_reserva">
                    <form id="formulario_r" name="new_res_add" method="POST">
                        <fieldset class="fieldset_data">
                            <legend>Datos del Cliente</legend>
                            <div class="column">     
                                <p class="registros"><span>Tipo de Identificación:</span>                                
                                    <select name="tipoDoc_cl" id="tipoDoc_cl" required>
                                        <option value="">Seleccione Tipo</option>
                                        <?php
                                            $options_doc = mysqli_query($conexion, "SELECT * FROM tipo_documento");  
                                            while($values = mysqli_fetch_row($options_doc)){                                            
                                        ?>                                        
                                        <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                                    </select>
                                </p> 
                                <div class="registros"><span>Nombres Cliente:</span><div class="caja-escrit"><input type="text" id="firstN_cli" placeholder="Ingrese nombres"></div> </div>                                                              
                                <div class="registros"><span>E-mail:</span><div class="caja-escrit"><input type="email" id="mail_cl" placeholder="campiña@web.com"></div> </div>
                            </div>
                            <div class="column">
                                <div class="registros"><span>Número Identificación:</span><div class="caja-escrit"><input type="text" id="numId_cl" placeholder="Número NUI o Pasaporte"></div> </div>
                                <div class="registros"><span>Apellidos Cliente:</span><div class="caja-escrit"><input type="text" id="lastN_cli" placeholder="Ingrese apellidos"></div> </div>
                                <div class="registros"><span>Número Celular:</span><div class="caja-escrit"><input type="cell" id="cell_cl" placerholder="ingrese"></div> </div>
                            </div>                            
                        </fieldset>
                        
                        <fieldset class="fieldset_data">
                            <legend>Reserva de Habitación</legend>
                            <div class="column">
                                <div class="registros"><span>Fecha de Entrada:</span><div class="caja-escrit"><input type="datetime-local" id="dateIn_r"></div> </div>
                                <p class="registros"><span>Número de Habitación:</span>                                
                                    <select name="tipo_hab" id="habit_tipo" required>
                                        <option value="">Seleccione Tipo</option>
                                        <?php
                                            $opcion_num = mysqli_query($conexion, "SELECT habitacion.hab_id as id, habitacion.hab_num as num FROM habitacion WHERE habitacion.hab_estado_hab_id = 1"); 
                                            while($values = mysqli_fetch_row($opcion_num)){                                            
                                        ?>                                        
                                        <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                                    </select>
                                </p> 
                                <div class="registros"><span>Abonado:</span><div class="caja-escrit"><input style="max-width: 70px;" type="text" value="0.00" id="abonado_price"></div> </div>
                                
                            </div>
                            <div class="column">
                            <div class="registros"><span>Fecha de Culminación:</span><div class="caja-escrit"><input type="datetime-local" id="dateOut_r"></div> </div>
                                <p class="registros"><span>Tipo de reserva:</span>                                
                                    <select name="reserva_tipo" id="reserva_est" required>
                                        <option value="">Seleccione Tipo</option>
                                        <?php
                                            $opcion_type_r = mysqli_query($conexion, "SELECT * FROM tiporeserva"); 
                                            while($values = mysqli_fetch_row($opcion_type_r)){                                            
                                        ?>                                        
                                        <option value="<?php echo $values[0] ?>"><?php echo $values[1] ?> </option><?php } ?>
                                    </select>
                                </p>
                            </div>                          
                            
                        </fieldset>

                        <div class="acciones">
                            <a href="#" id="cancel_res" class="cancel-res">Cancelar</a>
                            <button class="send-res" type="submit">Confirmar Reserva</button>                         
                        </div>
                    </form>
                </div>
            </article>
        </section>
        <section class="detalle_reservas">
            <div class="head-detalle">
                <h2 id="titulo_table">Listado de Reservas</h2>
            </div>
            <div class="dtll-lista">
                <div class="table_res">
                    <div class="thead_res">
                        <h4 class="hab_name_res"></h4>
                        <h4 class="est_reser_res">Estado Reserva</h4>
                        <h4 class="est_hab_res">Estado Habitación</h4>
                        <h4 class="limit"></h4>
                        <h4 class="date_res">Date In-Out</h4>
                        <h4 class="hour_res">Hora</h4>
                    </div>
                    <div id="list_reservas" class="tbody_res">
                        <div class="row_res">
                            <div class="hab_name_res"><p>Habitación<span id="num_hab_res">101</span></p></div>
                            <div class="est_reser_res">Confirmado</div>
                            <div class="est_hab_res ocupado">Ocupado</div>
                            <div class="limit"><p>Desde:</p><p>Hasta:</p></div>
                            <div class="date_res"><p id="date_in_res">12/03/21</p><p id="date_out_res">12/03/21</p></div>
                            <div class="hour_res"><p id="hour_in_res">12:00</p><p id="hour_out_res">12:00</p></div>
                            <div class="operacion_res">
                                <a class="modi_res" href="#">Modificar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../JS/general.js"></script>
    <script src="../JS/menu.js"></script>
    
</body>
</html>