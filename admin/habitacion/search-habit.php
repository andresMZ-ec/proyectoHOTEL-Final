<?php
    include '../../conexion_db.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = mysqli_query($conexion, "SELECT
            hab_id as id,
            hab_num as num,
            hab_precio as precio,
            hab_huesped as huesped,
            hab_descrip as descripcion
            FROM habitacion
            WHERE hab_id = '$id'");        

        if(!$query){
            die('Error al buscar habitación.');
        }
        $json = array();
        $category = array();
        while($colocar = mysqli_fetch_array($query)){
            $json[] = array(
                'id' => $colocar['id'],
                'num_h' => $colocar['num'],
                'precio' => $colocar['precio'],
                'huesped' => $colocar['huesped'],
                'descripcion' => $colocar['descripcion'],
            );            
        }
        echo json_encode($json); 
    }
?>
