<?php
    include '../../conexion_db.php';

    $reserva = (isset($_POST['tipoID']) && !empty($_POST['tipoID'])) &&
                (isset($_POST['nombreCL']) && !empty($_POST['nombreCL'])) &&
                (isset($_POST['apellidoCL']) && !empty($_POST['apellidoCL'])) &&
                (isset($_POST['correo']) && !empty($_POST['correo'])) &&
                (isset($_POST['celular']) && !empty($_POST['celular'])) &&
                (isset($_POST['numeroID']) && !empty($_POST['numeroID']));
    
    if($reserva){

        $nombreCL = $_POST['nombreCL'];
        $apellidoCL = $_POST['apellidoCL'];
        $numeroID = $_POST['numeroID'];
        $tipoIdent = $_POST['tipoID'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];

        $insertCliente = mysqli_query($conexion, "INSERT INTO cliente(cli_tipodocumento_id,f_name, l_name, identificacion, mail, cell) VALUES('$tipoIdent','$nombreCL', '$apellidoCL', '$numeroID', '$correo', '$celular');");
            
        
        if(!$insertCliente){
            die('Error al ingresar');
        }
        echo 'Cliente ingresado satisfactoriamente';

    }else{
        echo 'Ingrese todos los campos.';
    }
?>