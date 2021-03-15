<?php
    include '../conexion_db.php';

    $tipoIdent = $_POST['tipoDoc_cl'];
    $nombreCL = $_POST['firstN_cli'];
    $apellidoCL = $_POST['lastN_cli'];
    $correo = $_POST['mail_cl'];
    $celular = $_POST['cell_cl'];
    $numeroID = $_POST['numId_cl'];

    $fechaIN = $_POST['dateIn_r'];
    $fechaOUT = $_POST['dateOut_r'];
    $numHab_r = $_POST['tipo_hab'];
    $tipoReserva = $_POST['tipo_res'];
    $abono = $_POST['abonado_price'];   

    if(!empty($_POST)){
        if(empty($tipoIdent) || empty($nombreCL) || empty($apellidoCL) ||
        empty($correo) || empty($numeroID) || empty($celular) ||
        empty($fechaIN) || empty($fechaOUT) || empty($numHab_r) ||
        empty($tipoReserva) || empty($abono)){
            echo"Ingrese todos los campos";
        }else{
            $insertCliente = mysqli_query($conexion, "INSERT INTO cliente(cli_tipodocumento_id,f_name, l_name, identificacion, mail, cell) VALUES('$tipoIdent','$nombreCL', '$apellidoCL', 'numeroID', '$correo', '$celular');");
            
            $clienteObt = mysqli_query($conexion, "SELECT cli_id as id_cl FROM cliente where f_name = '$nombreCL';");
            $valor = mysqli_fetch_assoc($clienteObt);
            $valorF = $valor['id_cl'];
             
            $insertReserva = mysqli_query($conexion, "INSERT INTO reserva(res_date_in, res_date_out, res_abono, res_tipo_id, res_hab_id, res_cliente_id) VALUES('$fechaIN', '$fechaOUT', '$abono','$tipoReserva','$numHab_r', '$valorF');");
            
            if(!$insertCliente || !$insertReserva){
                echo "<script>window.location='insertar-reserva.php';</script>";
            }else{
                echo "<script>
                        alert('Error al ingresar : ');
                        window.location='insertar-reserva.php';
                    </script>";
            } 
            mysqli_close($conexion);
        } 
        echo "<script> alert('Los campos son requeridos')</script>";
        echo"<script>  window.location = 'insertar-reserva.php';</script>";
    }
    
   
?>