<?php
    include '../conexion_db.php';

    $query = mysqli_query($conexion, 
    "SELECT 
    CONCAT(usuario.usu_nombre, ' ', usuario.usu_apellidos) as nombres,
    usuario.usu_correo as correo,
    cargo.cargo_nombre as tipoUsuario
    FROM usuario
    INNER JOIN cargo on cargo.cargo_id = usuario.usu_cargo__id
    where usuario.usu_id =1");

    $json=array();
    while($menu = mysqli_fetch_array($query)){
        $json = array(
            'nombre' => $menu['nombres'],
            'mail' => $menu['correo'],
            'typeUser' => $menu['tipoUsuario']
        );
    }
    echo json_encode($json);
?>
