<?php
    include '../../conexion_db.php';

    $result = (isset($_POST['id']) && !empty($_POST['id'])) &&
                (isset($_POST['num']) && !empty($_POST['num'])) &&
                (isset($_POST['precio']) && !empty($_POST['precio'])) &&
                (isset($_POST['huespedes']) && !empty($_POST['huespedes'])) &&
                (isset($_POST['categoria']) && !empty($_POST['categoria'])) &&
                (isset($_POST['nivel']) && !empty($_POST['nivel'])) &&
                (isset($_POST['descripcion']) && !empty($_POST['descripcion']));

    if($result){
        $id = $_POST['id'];
        $num = $_POST['num'];
        $precio = $_POST['precio'];
        $huespedes = $_POST['huespedes'];
        $categoria = $_POST['categoria'];
        $nivel = $_POST['nivel'];
        $descripcion = $_POST['descripcion'];

        $query = mysqli_query($conexion, "UPDATE habitacion SET 
            hab_num = '$num', 
            hab_precio = '$precio', 
            hab_huesped = '$huespedes', 
            hab_tipo_id = '$categoria', 
            hab_nivel_id = '$nivel', 
            hab_descrip = '$descripcion' 
            WHERE hab_id = '$id';");

        if(!$query){
            die('No se pudo actualizar la habitación'.mysqli_error($conexion));
        }
        echo('Habitación actualizada exitosamente.');        
    }else{
        echo('¡Error! Rellene todos los campos.');
    }
?>