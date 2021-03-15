<?php
    include '../../conexion_db.php';

    $query = mysqli_query($conexion, "SELECT
        habitacion.hab_num as numero,
        tipohabitacion.tipo_hab_nombre as tipo,
        habitacion.hab_huesped as huespedes,
        estadohabitacion.estado_hab_nombre as estado
        FROM habitacion
        INNER JOIN tipohabitacion on tipohabitacion.tipo_hab_id = habitacion.hab_tipo_id
        INNER JOIN estadohabitacion on estadohabitacion.estado_hab_id = habitacion.hab_estado_hab_id
        GROUP by hab_num ASC");

    if(!$query){
        die('No encontrado...'.mysqli_error($conexion));
    }
    $json = array();
    while($view = mysqli_fetch_array($query)){
        $json[]  = array(
            'numero' => $view['numero'],
            'tipo' => $view['tipo'],
            'huespedes' => $view['huespedes'],
            'estado' => $view['estado']
        );
    }
    echo json_encode($json);
?>