<?php

    include '../conexion_db.php';

    if(isset($_POST['num'])){
        $recibido = $_POST['num'];;
        
        $optionHab = mysqli_query($conexion, "SELECT habitacion.hab_id as id_disp, habitacion.hab_num as num_disp FROM habitacion WHERE habitacion.hab_estado_hab_id = 1");
        
        $resultado = mysqli_query($conexion, "SELECT 
            habitacion.hab_id as hab_id,
            habitacion.hab_num as hab_num,
            reserva.res_id as res_id,
            CONVERT(reserva.res_date_in, varchar(20)) as entrada,
            reserva.res_date_out as salida,
            cliente.f_name as nameCl,
            cliente.l_name as apellidoCL,
            reserva.res_abono as abonado,
            tiporeserva.tipo_res_id as tipoReserva_id,
            tiporeserva.tipo_res_nombre as tipoReserva_name
            FROM reserva
            INNER JOIN habitacion on habitacion.hab_id = reserva.res_hab_id
            INNER JOIN cliente on cliente.cli_id = reserva.res_cliente_id
            INNER JOIN tiporeserva on tiporeserva.tipo_res_id = reserva.res_tipo_id
            WHERE habitacion.hab_id = (SELECT habitacion.hab_id as id FROM habitacion WHERE hab_num = '$recibido');");

        if(!$resultado){
            die('fallo');
        }
        $json = array();
        while($mostrar = mysqli_fetch_array($resultado)){
            $json[] = array(
                'id' => $mostrar['hab_id'],
                'reservaID' => $mostrar['res_id'],
                'hab_num' => $mostrar['hab_num'],
                'entrada' => $mostrar['entrada'],
                'salida' => $mostrar['salida'],
                'nameCl' => $mostrar['nameCl'],
                'apellidoCL' => $mostrar['apellidoCL'],
                'abono' => $mostrar['abonado'],
                'tipoReserva_id' => $mostrar['tipoReserva_id'],
                'tipoReserva_name' => $mostrar['tipoReserva_name']
            );
        }
        echo json_encode($json);
    }

?>