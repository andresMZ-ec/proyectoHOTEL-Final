<?php
    include '../conexion_db.php';

    $reserva = (isset($_POST['tipoID']) && !empty($_POST['tipoID'])) &&
                (isset($_POST['nombreCL']) && !empty($_POST['nombreCL'])) &&
                (isset($_POST['apellidoCL']) && !empty($_POST['apellidoCL'])) &&
                (isset($_POST['correo']) && !empty($_POST['correo'])) &&
                (isset($_POST['celular']) && !empty($_POST['celular'])) &&
                (isset($_POST['numeroID']) && !empty($_POST['numeroID'])) &&
                (isset($_POST['fechaIN']) && !empty($_POST['fechaIN'])) &&
                (isset($_POST['fechaOUT']) && !empty($_POST['numHab_r'])) &&
                (isset($_POST['tipoReserva']) && !empty($_POST['tipoReserva'])) &&
                (isset($_POST['abono']) && !empty($_POST['abono']));
    
    if($reserva){

        $tipoIdent = $_POST['tipoID'];
        $nombreCL = $_POST['nombreCL'];
        $apellidoCL = $_POST['apellidoCL'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $numeroID = $_POST['numeroID'];

        $fechaIN = $_POST['fechaIN'];
        $fechaOUT = $_POST['fechaOUT'];
        $numHab_r = $_POST['numHab_r'];
        $tipoReserva = $_POST['tipoReserva'];
        $abono = $_POST['abono']; 

        $insertCliente = mysqli_query($conexion, "INSERT INTO cliente(cli_tipodocumento_id,f_name, l_name, identificacion, mail, cell) VALUES('$tipoIdent','$nombreCL', '$apellidoCL', '$numeroID', '$correo', '$celular');");
            
        $clienteObt = mysqli_query($conexion, "SELECT cli_id as id_cl FROM cliente where identificacion = '$numeroID'");
        $valor = mysqli_fetch_assoc($clienteObt);
        $valorF = $valor['id_cl'];
            
        $insertReserva = mysqli_query($conexion, "INSERT INTO reserva(res_date_in, res_date_out, res_abono, res_tipo_id, res_hab_id, res_cliente_id) VALUES('$fechaIN', '$fechaOUT', '$abono','$tipoReserva','$numHab_r', '$valorF');");

        $updateHab = mysqli_query($conexion, "UPDATE habitacion SET hab_estado_hab_id = 2, hab_cliente_id = '$valorF' WHERE hab_id = '$numHab_r';");


        if(!$insertCliente && !$clienteObt &&  !$insertReserva && !$updateHab){
            die('Error al ingresar');
        }
        echo 'Reserva ingresada satisfactoriamente';

    }else{
        echo 'Ingrese todos los campos.';
    }
?>