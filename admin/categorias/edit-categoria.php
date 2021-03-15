<?php
    include '../../conexion_db.php';

    if(isset($_POST['id']) || isset($_POST['nombre'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];

        $query = mysqli_query($conexion, "UPDATE tipohabitacion SET tipo_hab_nombre = '$nombre' WHERE tipo_hab_id = '$id'");     

        if(!$query){
            die('Error al agregar cmabios.');
        }else{
            echo 'Cambios guardados correctamente'; 
        }
        
    }else{
        echo '¡Error! Rellene todos los campos.';
    } 
?>