<?php
    include '../../conexion_db.php';

    $result = (isset($_POST['nombreCL']) && !empty($_POST['nombreCL'])) &&
                (isset($_POST['apellidoCL']) && !empty($_POST['apellidoCL'])) &&
                (isset($_POST['numeroID']) && !empty($_POST['numeroID'])) &&
                (isset($_POST['correo']) && !empty($_POST['correo'])) &&
                (isset($_POST['celular']) && !empty($_POST['celular']));

    if($result){
        $id = $_POST['id'];
        $nombreCL = $_POST['nombreCL'];
        $apellidoCL = $_POST['apellidoCL'];
        $numeroID = $_POST['numeroID'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];

        $query = mysqli_query($conexion, "UPDATE cliente SET 
            f_name = '$nombreCL', 
            l_name = '$apellidoCL', 
            identificacion = '$numeroID', 
            mail = '$correo', 
            cell = '$celular' 
            WHERE cli_id = '$id';");

        if(!$query){
            die('No se pudieron realizar los cambios, intente mas tarde');
        }
        echo('Datos actualizados correctamente');        
    }else{
        echo('¡Error! Rellene todos los campos.');
    }
?>