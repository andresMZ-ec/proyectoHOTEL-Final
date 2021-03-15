<?php
include '../../conexion_db.php';

$table = 'usuario';



$name_empleado = utf8_decode($_POST['name_empleado']);
$nui_empleado = utf8_decode($_POST['nui_empleado']);
$mail_empleado = utf8_decode($_POST['mail_empleado']);
$pass_empleado = utf8_decode($_POST['pass_empleado']);
$apellido_empleado = utf8_decode($_POST['apellido_empleado']);
$tel_empleado = utf8_decode($_POST['tel_empleado']);
$date_nac_empleado = utf8_decode($_POST['date_nac_empleado']);
$cargo = utf8_decode($_POST['select_cargo']);

$id_cargo = intval($cargo);
// validar campos vacios      

$empleado = (isset($_POST['name_empleado']) && !empty($_POST['name_empleado'])) &&
        (isset($_POST['nui_empleado']) && !empty($_POST['nui_empleado'])) &&
        (isset($_POST['mail_empleado']) && !empty($_POST['mail_empleado'])) &&
        (isset($_POST['pass_empleado']) && !empty($_POST['pass_empleado']))&&
        (isset($_POST['apellido_empleado']) && !empty($_POST['apellido_empleado'])) &&
        (isset($_POST['tel_empleado']) && !empty($_POST['tel_empleado']))&&
        (isset($_POST['date_nac_empleado']) && !empty($_POST['date_nac_empleado'])) &&
        (isset($_POST['select_cargo']) && !empty($_POST['select_cargo']));

    


        if ( $empleado ) {
           
      
       
     


$sql = 'INSERT INTO `' . $ddbb . '`.`'.$table.'` (`usu_cargo__id` , `usu_nombre` , `usu_apellidos`, `usu_nui` , `usu_celular` , `usu_fecha_nacimiento`, `usu_correo` , `usu_contraseña`) 
VALUES ("' . $id_cargo . '", "' . $name_empleado . '", "' . $apellido_empleado . '", "' . $nui_empleado . '", "' . $tel_empleado . '", "' . $date_nac_empleado . '", "' . $mail_empleado . '", "' . $pass_empleado . '")';


if (mysqli_query($conexion, $sql)) {
      echo"<script>  window.location = '../empleados.html.php'</script>";

} else {
      echo "<script> alert(Error:  . $sql . '<br>' . mysqli_error($conexion)</script>";
}
mysqli_close($conexion);  

} else {

      echo "<script> alert('Los campos son requeridos')</script>";
      echo"<script>  window.location = '../empleados.html.php'</script>";

}

            
            
