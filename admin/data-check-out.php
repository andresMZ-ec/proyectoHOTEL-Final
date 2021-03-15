<?php
    include '../conexion_db.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $queryDetalle = mysqli_query($conexion, "SELECT 
                habitacion.hab_num as numero,
                tipohabitacion.tipo_hab_nombre as tipoHab,
                habitacion.hab_precio as precioHab,

                CONCAT(cliente.f_name, ' ', cliente.l_name) as nombreCliente,
                cliente.identificacion as numID,
                cliente.mail as correo,

                reserva.res_date_in as entrada,
                reserva.res_date_out as salida,

                reserva.res_abono as valorAbonado,
                CONVERT(habitacion.hab_precio - reserva.res_abono, DECIMAL(10,2)) as t_hospedaje

            FROM reserva
            INNER JOIN habitacion on habitacion.hab_id = reserva.res_hab_id
            INNER JOIN tipohabitacion on tipo_hab_id = habitacion.hab_tipo_id
            INNER JOIN cliente on cliente.cli_id = reserva.res_cliente_id
            WHERE cliente.cli_id = (SELECT cliente.cli_id FROM cliente
                INNER JOIN habitacion on habitacion.hab_cliente_id = cliente.cli_id
                WHERE habitacion.hab_id = '$id')");

        $precioTotal = mysqli_query($conexion, "SELECT 
            habitacion.hab_precio +  SUM(pedidos.cantidad * producto.prod_precio) as totalNeto
            FROM cliente 
            INNER JOIN pedidos on pedidos.ped_cliente_id = cliente.cli_id
            INNER JOIN producto on producto.prod_code = pedidos.ped_prod__id
            INNER JOIN habitacion on habitacion.hab_cliente_id = cliente.cli_id
            where habitacion.hab_id = '$id';");

        if(!$queryDetalle){
            die('Recolección de Datos Fallida');
        }
        $json = array();
        while($data = mysqli_fetch_array($queryDetalle)
                AND $total = mysqli_fetch_array($precioTotal)){
            $json[] = array(
                'hab' => $data['numero'],
                'tipoH' => $data['tipoHab'],
                'precioH' => $data['precioHab'],
                'cliente' => $data['nombreCliente'],
                'NUI' => $data['numID'],
                'mail' => $data['correo'],
                'dateIN' => $data['entrada'],
                'dateOUT' => $data['salida'],

                'valorAbonado' => $data['valorAbonado'],
                'totalHospedaje' => $data['t_hospedaje'],
                'totalPagar' => $total['totalNeto']
            );
        }
        echo json_encode($json);
    }
    
    
?>