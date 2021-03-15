<?php
    include '../../conexion_db.php';

    if(isset($_POST['estado']) || isset($_POST['num'])){
        $estado = $_POST['estado'];
        $num = $_POST['num'];

        $query = mysqli_query($conexion, "UPDATE habitacion SET habitacion.hab_estado_hab_id = 
            (SELECT estado_hab_id FROM estadohabitacion WHERE estado_hab_nombre = '$estado') WHERE habitacion.hab_num = '$num'");
        
        if(!$query){
            echo('Modificado con exito');
        }else{
            die('error al modificar');
        }
    }else{
        echo 'No recibido';
    }
?>