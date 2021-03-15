<?php
    include '../conexion_db.php';


    $habit = "SELECT habitacion.hab_id as idHabitacion,
    habitacion.hab_num as numero,
    tipohabitacion.tipo_hab_nombre as tipo_habitacion,
    estadohabitacion.estado_hab_nombre as estado
FROM habitacion
INNER JOIN tipohabitacion on tipohabitacion.tipo_hab_id = habitacion.hab_tipo_id
INNER JOIN estadohabitacion on estadohabitacion.estado_hab_id = habitacion.hab_estado_hab_id
WHERE  estadohabitacion.estado_hab_nombre = 'Ocupado' OR estado_hab_nombre = 'Limpieza'";

    $resul = mysqli_query($conexion, $habit);
    
    if(!$habit){
        die('Consulta Fallida'.mysqli_error($conexion));
    }
    

    $json = array();
    while($row = mysqli_fetch_array($resul)) {
        $json[] = array(
            'id' => $row['idHabitacion'],
            'numero' => $row['numero'],
            'tipo' => $row['tipo_habitacion'],
            'estado' => $row['estado']
        );
    }
    echo json_encode($json);
?>