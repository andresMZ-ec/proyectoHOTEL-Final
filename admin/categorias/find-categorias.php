<?php
    include '../../conexion_db.php';

    if(isset($_POST['categoria'])){
        $id = $_POST['categoria'];

        $query = mysqli_query($conexion, "SELECT    
            tipo_hab_id as id,
            tipo_hab_nombre as nombre
            FROM tipohabitacion WHERE tipo_hab_id = '$id'");        

        if(!$query){
            die('Error al buscar la categoria.');
        }
        $json = array();
        while($cliente = mysqli_fetch_array($query)){
            $json[] = array(
                'id' => $cliente['id'],
                'nombre' => $cliente['nombre']
            );            
        }
        echo json_encode($json); 
    }else{
        echo 'No escogido';
    }    
?>