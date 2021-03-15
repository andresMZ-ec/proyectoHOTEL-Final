<?php
    include '../../conexion_db.php';

    if(isset($_POST['id'])){
        $idHab = $_POST['id'];

        $updateHab = mysqli_query($conexion, "UPDATE habitacion SET hab_cliente_id = null, hab_estado_hab_id = 1 WHERE hab_id = '$idHab'");

        if(!$updateHab){
            die('No se pudo procesar la habitacion');
        }else{
            echo 'Datos procesados correctamente';
        }
    }else{
        echo 'Error';
    }
?>