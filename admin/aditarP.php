<?php
if (!isset($_GET["codigo_prod"])) {
    exit();
}

    
    $codigo = $_GET["prod_code"];
    require '../conexion_db.php';
    $sentencia = ("SELECT prod_code, prod_nombre, prod_precio, prod_stock FROM producto WHERE prod_code = ?;");
    $resultado = mysqli_query($conexion, $sentencia);
    $producto = $resultado->fetchObject();
    if (!$producto) {
        #No existe
        echo "¡No existe alguna mascota con ese ID!";
        exit();
    }
    
    #Si la mascota existe, se ejecuta esta parte del código
   
?>