<?php
    include '../conexion_db.php';

    $resulHabOcupadas = mysqli_query($conexion, 
        "SELECT COUNT(estado_hab_nombre) as ocupadas
        FROM habitacion
        INNER JOIN estadohabitacion on estado_hab_id = hab_estado_hab_id
        where estado_hab_nombre='Ocupado';");  
        
    $reservaRealizada = mysqli_query($conexion,
        "SELECT COUNT(*) as reservas
        FROM reserva");

    $empleados = mysqli_query($conexion,
        "SELECT COUNT(*) AS total_empleado FROM usuario");

    if(!$resulHabOcupadas){
        die('Consulta Fallida'.mysqli_error($conexion));
    };    
    $json = array();
    while($habitaciones = mysqli_fetch_array($resulHabOcupadas) 
        AND $reserva = mysqli_fetch_array($reservaRealizada)
        AND $cantEmpleado = mysqli_fetch_array($empleados)){
        $json[] = array(
            'count' => $habitaciones['ocupadas'],
            'cant_res' => $reserva['reservas'],
            'cant_empl' => $cantEmpleado['total_empleado']
        );        
    }
    echo json_encode($json);
?>
