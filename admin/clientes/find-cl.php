<?php
    include '../../conexion_db.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = mysqli_query($conexion, "SELECT
            cli_id as id,
            f_name as name_cliente,
            identificacion as nui_cliente,
            mail as mail_cliente,
            l_name as apellidos_cliente,
            cell as cell_cliente,

            tipo_documento.doc_nombre as typeDOC
            FROM cliente
            INNER JOIN tipo_documento on tipo_documento.doc_id = cliente.cli_tipodocumento_id
            WHERE cli_id = '$id'");        

        if(!$query){
            die('Error al buscar cliente.');
        }
        $json = array();
        while($cliente = mysqli_fetch_array($query)){
            $json[] = array(
                'id'                  => $cliente['id'],
                'name_cliente'        => $cliente['name_cliente'],
                'nui_cliente'         => $cliente['nui_cliente'],
                'mail_cliente'        => $cliente['mail_cliente'],
                'apellidos_cliente'   => $cliente['apellidos_cliente'],
                'cell_cliente'        => $cliente['cell_cliente'],
                'typeDOC'             => $cliente['typeDOC']
            );            
        }
        echo json_encode($json); 
    }else{
        echo 'Inserte Numero de Identificacion del cliente';
    }
?>
