<?php
    include ('../../conexion_db.php');

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
        $query = mysqli_query($conexion, "DELETE FROM cliente WHERE cli_id = '$id'");

        if(!$query){
            die('Los datos del cliente están en uso, intente mas tarde.');
        }
        echo 'El cliente ha sido eliminado.';       
    }else{
        echo 'Cliente no seleccionado';
    }
?>