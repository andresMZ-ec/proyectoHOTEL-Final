<?php
    include '../../conexion_db.php';

    if(isset($_POST['user']) || !empty($_POST['user']) ||
        isset($_POST['password']) || !empty($_POST['password'])){

        $user = $_POST['user'];
        $password = $_POST['password'];

        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usu_correo = '".$user."' AND usu_contraseña = '".$password."'");
        $validacion = mysqli_num_rows($query);

        if(!isset($_SESSION['nameuser'])){
            if($validacion == 1){                
                echo('redirigiendo');
            }else{
                if($validacion == 0){
                    echo 'Usuario no registrado';
                }
            }
        }        
    }
?>