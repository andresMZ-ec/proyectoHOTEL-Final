<?php
require '../conexion_db.php';
 
$id = $_GET['id'];

$sql = "DELETE FROM producto WHERE prod_code = '$id'";
$resultado = mysqli_query($conexion,$sql);
header('Location: productos.php');

?>
