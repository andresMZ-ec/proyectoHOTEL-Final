<?php
    include '../conexion_db.php';

    $result = (isset($_POST['id']) && !empty($_POST['id'])) &&
                (isset($_POST['dateIN']) && !empty($_POST['dateIN'])) &&
                (isset($_POST['dateOUT']) && !empty($_POST['dateOUT'])) &&
                (isset($_POST['habID']) && !empty($_POST['habID'])) &&
                (isset($_POST['nameCL']) && !empty($_POST['nameCL'])) &&
                (isset($_POST['apellCL']) && !empty($_POST['apellCL'])) &&
                (isset($_POST['abonado']) && !empty($_POST['abonado'])) &&
                (isset($_POST['typeRes']) && !empty($_POST['typeRes']));

    if($result){

        $id = $_POST['id'];
        $entrada = $_POST['dateIN'];
        $salida = $_POST['dateOUT'];
        $habID = $_POST['habID'];
        $nameCL = $_POST['nameCL'];
        $apellCL = $_POST['apellCL'];
        $abonado = $_POST['abonado'];
        $typeRes = $_POST['typeRes'];

        $modReserva = mysqli_query($conexion, "UPDATE reserva SET res_date_in = '$entrada', res_date_out = '$salida', res_abono = '$abonado', res_tipo_id = '$typeRes' WHERE res_id = '$id';");

        $modCliente = mysqli_query($conexion, "UPDATE cliente SET f_name = '$nameCL', l_name = '$apellCL' WHERE cli_id = (
                                                SELECT res_cliente_id as id FROM reserva
                                                INNER JOIN habitacion ON habitacion.hab_id = reserva.res_hab_id
                                                WHERE habitacion.hab_num = 103)");

        if(!$modReserva && !$modCliente){
            die('Error al actualizar la reserva');
        }
        echo 'Datos actualizados satisfcatoriamente';
        
    }else{
        echo('Todos los campos son requeridos');
    }
    



?>