<?php
    include '../../conexion_db.php';

    $datos = (isset($_POST['number']) && !empty($_POST['number'])) &&
            (isset($_POST['price']) && !empty($_POST['price'])) &&
            (isset($_POST['roomer']) && !empty($_POST['roomer'])) &&
            (isset($_POST['descrip']) && !empty($_POST['descrip'])) &&
            (isset($_POST['category']) && !empty($_POST['category'])) &&
            (isset($_POST['heigthHTL']) && !empty($_POST['heigthHTL']));

    if($datos){
        $num = $_POST['number'];
        $descripcion = $_POST['descrip'];
        $precio = $_POST['price'];
        $huespedes = $_POST['roomer'];
        $categoria = $_POST['category'];
        $estadoHab = 1;
        $nivel = $_POST['heigthHTL'];

        $query = mysqli_query($conexion, "INSERT INTO habitacion(hab_num, hab_descrip, hab_precio, hab_huesped, hab_tipo_id, hab_estado_id, hab_nivel_id) VALUES('$num', '$descripcion', '$precio', '$huespedes', '$categoria', '$estadoHab', '$nivel');");

        if(!$query){
            die('No se pudo agregar la Habitación'.mysqli_error($conexion));
        }else{
            echo 'Habitación agregada satisfactoriamente';
        }
    }else{
        echo 'Para agregar rellene todos los campos.';
    }
?>