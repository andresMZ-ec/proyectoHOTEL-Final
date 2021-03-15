<?php
/*================================
Este archivo guarda los datos del formulario
en donde se editan
================================
*/
?>

<?php

#Salir si alguno de los datos no está presente
if (!isset($_POST["codigo_prod"]) || !isset($_POST["descrip_prod"])|| !isset($_POST["precio_prod"])
|| !isset($_POST["stock_prod"])) {
    exit();
}
    #Si todo va bien, se ejecuta esta parte del código...

    require '../conexion_db.php';
    $codigo = $_POST["codigo_prod"];
    $nombre = $_POST["descrip_prod"];     
    $precio = $_POST["precio_prod"];
    $stock = $_POST["stock_prod"];

    $sentencia = ("UPDATE producto SET prod_code = '$codigo', prod_nombre ='$nombre' , prod_precio = '$precio', prod_stock = '$stock' WHERE prod_code = '$codigo';");
    $resultado = mysqli_query($conexion, $sentencia);
    # Pasar en el mismo orden de los ?
    if ($resultado === true) {
        header("Location: productos.php");
    } else {
        echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
