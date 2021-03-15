<?php
    include '../../conexion_db.php';

    if(isset($_POST['idLevel'])){
        $idLevel = $_POST['idLevel'];

        $lvlActual = mysqli_query($conexion, "SELECT nivel_id, nivel_nombre FROM nivel_hotel
        INNER JOIN habitacion ON habitacion.hab_nivel_id = nivel_hotel.nivel_id
        WHERE habitacion.hab_id = '$idLevel' GROUP BY nivel_id ASC"); 

        $queryLvl = mysqli_query($conexion, "SELECT nivel_id, nivel_nombre FROM nivel_hotel GROUP BY nivel_id ASC"); 

        $n = mysqli_fetch_row($lvlActual);
        $nivel = "<option value='$n[0]'>$n[1]</option>";    
        while($fila = mysqli_fetch_array($queryLvl)){
            $nivel .= "<option value='$fila[nivel_id]'>$fila[nivel_nombre]</option>";
        }
        echo $nivel;
    }else{
        echo 'No Seleccionado';
    }
    
?>