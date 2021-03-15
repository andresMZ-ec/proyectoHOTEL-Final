<?php
    include '../../conexion_db.php';

    $query = mysqli_query($conexion, "SELECT    
        tipo_hab_id as id,
        tipo_hab_nombre as nivelName
        FROM tipohabitacion");

    if(!$query){
        die('No encontrado...'.mysqli_error($conexion));
    }
    $json = array();
    while($view = mysqli_fetch_array($query)){
        $json[]  = array(
            'id' => $view['id'],
            'nivelName' => $view['nivelName']
        );
    }
    echo json_encode($json);
?>