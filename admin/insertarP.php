
<?php
#Salir si alguno de los datos no está presente.
if (!isset($_POST["codigo_prod"]) || !isset($_POST["descrip_prod"])|| !isset($_POST["precio_prod"])
|| !isset($_POST["stock_prod"])) {
    exit();
}

#Si todo va bien, se ejecuta esta parte del código...

require '../conexion_db.php';
$codigp = $_POST["codigo_prod"];
$decripcion = $_POST["descrip_prod"];
$precio = $_POST["precio_prod"];
$stock = $_POST["stock_prod"];


$sentencia = ("INSERT INTO producto (prod_code, prod_nombre, prod_precio, prod_stock) VALUES ('$codigp', '$decripcion','$precio','$stock');");
$resultado = mysqli_query($conexion, $sentencia);

//$resultado = $sentencia->execute([$nombre, $edad]); # Pasar en el mismo orden de los ?
if ($resultado === true) {
    
  header("Location: productos.php");
   
  echo "<script>
             alert('Producto Agregado Correctamente');
             window.location= 'produtos.php'
       </script>";


} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}

#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso podemos evaluar



?>
