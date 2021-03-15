<?php
    include '../../conexion_db.php';

    $query = mysqli_query($conexion, "SELECT    
        cliente.cli_id as id,
        tipo_documento.doc_nombre as tipoDoc,
        cliente.identificacion as numID,
        CONCAT(f_name, ' ', l_name) as nombreApellido,
        cliente.mail as correo,
        cliente.cell as celular
        FROM cliente
        INNER JOIN tipo_documento on tipo_documento.doc_id = cliente.cli_tipodocumento_id");

    if(!$query){
        die('No encontrado...'.mysqli_error($conexion));
    }
    $json = array();
    while($view = mysqli_fetch_array($query)){
        $json[]  = array(
            'id' => $view['id'],
            'tipoDoc' => $view['tipoDoc'],
            'numID' => $view['numID'],
            'nombreApellido' => $view['nombreApellido'],
            'correo' => $view['correo'],
            'celular' => $view['celular']
        );
    }
    echo json_encode($json);
?>