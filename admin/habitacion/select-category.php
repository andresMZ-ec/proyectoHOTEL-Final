<?php
    include '../../conexion_db.php';


    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $catActual = mysqli_query($conexion, "SELECT tipo_hab_id, tipo_hab_nombre FROM tipohabitacion
            INNER JOIN habitacion on habitacion.hab_tipo_id = tipohabitacion.tipo_hab_id
            WHERE habitacion.hab_id = '$id'"); 

        $queryCat = mysqli_query($conexion, "SELECT tipo_hab_id, tipo_hab_nombre FROM tipohabitacion"); 

        $hab = mysqli_fetch_row($catActual);
        $categorias = "<option value='$hab[0]'>$hab[1]</option>";    
        while($row = mysqli_fetch_array($queryCat)){
            $categorias .= "<option value='$row[tipo_hab_id]'>$row[tipo_hab_nombre]</option>";
        }
        echo $categorias;
    }else{
        echo 'no seleccionado';
    }

?>