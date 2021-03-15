<?php 

include '../../conexion_db.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$conexion->query("DELETE FROM usuario WHERE usu_id={$id}");
	
		header('Location: ../empleados.html.php');
	}else{
		header('Location: ../empleados.html.php');
	}
 ?>