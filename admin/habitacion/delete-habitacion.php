<?php
    include ('../../conexion_db.php');

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
        $query = mysqli_query($conexion, "DELETE FROM habitacion WHERE hab_id = '$id'");

        if(!$query){
            die('No encontrado...'.mysqli_error($conexion));
        }
        echo 'Habitación eliminada correctamente.';       
    }else{
        echo 'Seleccione una habitación';
    }
?>