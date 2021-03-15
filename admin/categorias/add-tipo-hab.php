<?php
    include '../../conexion_db.php';

    $reserva = (isset($_POST['nombre']) && !empty($_POST['nombre']));
    
    if($reserva){
        $nombre = $_POST['nombre'];

        $insertTipo = mysqli_query($conexion, "INSERT INTO tipohabitacion(tipo_hab_nombre) VALUES('$nombre');");
            
        
        if(!$insertTipo){
            die('No se pudo ingresar');
        }
        echo 'Tipo de habitacion ingresado correctamente';

    }else{
        echo 'Ingrese el nombre.';
    }
?>